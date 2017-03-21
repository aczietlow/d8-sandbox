<?php
namespace Drupal\sandbox_validation_plugin\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
* Checks if a field is unique.
*
* @Constraint(
*   id = "RecipePrepTime",
*   label = @Translation("Sandboxing validation constraints.", context = "Validation"),
* )
*/
class RecipePrepTimeConstraint extends Constraint {

public $message = 'Invalid Prep Time.';

}
