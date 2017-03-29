<?php

namespace Drupal\sandbox_validation_plugin\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Checks if an entity is using a valid state
 *
 * @Constraint(
 *   id = "SandboxModerationState",
 *   label = @Translation("Checking entities moderation states", context = "Validation"),
 * )
 */
class SandboxModerationStateConstraint extends Constraint {
  public $message = 'Invalid entity state.';
}