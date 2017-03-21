<?php

namespace Drupal\sandbox_entities\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Recipe entities.
 *
 * @ingroup sandbox_entities
 */
interface RecipeInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Recipe name.
   *
   * @return string
   *   Name of the Recipe.
   */
  public function getName();

  /**
   * Sets the Recipe name.
   *
   * @param string $name
   *   The Recipe name.
   *
   * @return \Drupal\sandbox_entities\Entity\RecipeInterface
   *   The called Recipe entity.
   */
  public function setName($name);

  /**
   * Gets the Recipe creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Recipe.
   */
  public function getCreatedTime();

  /**
   * Sets the Recipe creation timestamp.
   *
   * @param int $timestamp
   *   The Recipe creation timestamp.
   *
   * @return \Drupal\sandbox_entities\Entity\RecipeInterface
   *   The called Recipe entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Recipe published status indicator.
   *
   * Unpublished Recipe are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Recipe is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Recipe.
   *
   * @param bool $published
   *   TRUE to set this Recipe to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\sandbox_entities\Entity\RecipeInterface
   *   The called Recipe entity.
   */
  public function setPublished($published);

}
