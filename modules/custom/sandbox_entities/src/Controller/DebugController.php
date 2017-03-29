<?php

namespace Drupal\sandbox_entities\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityManager;

/**
 * Class DebugController.
 *
 * @package Drupal\sandbox_entities\Controller
 */
class DebugController extends ControllerBase {

  /**
   * Drupal\Core\Entity\EntityManager definition.
   *
   * @var \Drupal\Core\Entity\EntityManager
   */
  protected $entityManager;

  /**
   * {@inheritdoc}
   */
  public function __construct(EntityManager $entity_manager) {
    $this->entityManager = $entity_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.manager')
    );
  }

  /**
   * Debugpage.
   *
   * @return string
   *   Return Hello string.
   */
  public function DebugPage() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: DebugPage')
    ];
  }

}
