<?php

namespace Drupal\sandbox_validation_plugin\Plugin\Validation\Constraint;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\content_moderation\ModerationInformationInterface;
use Drupal\content_moderation\StateTransitionValidation;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class SandboxModerationStateConstraintValidator extends ConstraintValidator implements ContainerInjectionInterface {

  /**
   * The state transition validation.
   *
   * @var \Drupal\content_moderation\StateTransitionValidation
   */
  protected $validation;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  private $entityTypeManager;

  /**
   * The moderation info.
   *
   * @var \Drupal\content_moderation\ModerationInformationInterface
   */
  protected $moderationInformation;

  /**
   * Creates a new ModerationStateConstraintValidator instance.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\content_moderation\StateTransitionValidation $validation
   *   The state transition validation.
   * @param \Drupal\content_moderation\ModerationInformationInterface $moderation_information
   *   The moderation information.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, StateTransitionValidation $validation, ModerationInformationInterface $moderation_information) {
    $this->validation = $validation;
    $this->entityTypeManager = $entity_type_manager;
    $this->moderationInformation = $moderation_information;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('content_moderation.state_transition_validation'),
      $container->get('content_moderation.moderation_information')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function validate($value, Constraint $constraint) {
    /** @var \Drupal\Core\Entity\EntityInterface $entity */
    $entity = $value->getEntity();

    // Ignore entities that are not subject to moderation anyway.
    if (!$this->moderationInformation->isModeratedEntity($entity)) {
      return;
    }

    $workflow = $this->moderationInformation->getWorkflowForEntity($entity);

    if (!$workflow->hasState($entity->moderation_state->value)) {
      $this->context->addViolation($constraint->invalidStateMessage, [
        '%state' => $entity->moderation_state->value,
        '%workflow' => $workflow->label(),
      ]);
    }

    // If a new state is being set and there is an existing state, validate
    // there is a valid transition between them.
    if (!$entity->isNew() && !$this->isFirstTimeModeration($entity)) {

      $original_entity = $this->moderationInformation->getLatestRevision($entity->getEntityTypeId(), $entity->id());
      if (!$entity->isDefaultTranslation() && $original_entity->hasTranslation($entity->language()->getId())) {
        $original_entity = $original_entity->getTranslation($entity->language()->getId());
      }

      $new_state = $workflow->getState($entity->moderation_state->value) ?: $workflow->getInitialState();
      $original_state = $workflow->getState($original_entity->moderation_state->value);

      if (!$original_state->canTransitionTo($new_state->id())) {
        $this->context->addViolation($constraint->message, [
          '%from' => $original_state->label(),
          '%to' => $new_state->label()
        ]);
      }
    }
  }

  /**
   * Determines if this entity is being moderated for the first time.
   *
   * If the previous version of the entity has no moderation state, we assume
   * that means it predates the presence of moderation states.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity being moderated.
   *
   * @return bool
   *   TRUE if this is the entity's first time being moderated, FALSE otherwise.
   */
  protected function isFirstTimeModeration(EntityInterface $entity) {
    $original_entity = $this->moderationInformation->getLatestRevision($entity->getEntityTypeId(), $entity->id());

    $original_id = $original_entity->moderation_state;

    return !($entity->moderation_state && $original_entity && $original_id);
  }

}