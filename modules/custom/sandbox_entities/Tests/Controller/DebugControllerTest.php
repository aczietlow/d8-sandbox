<?php

namespace Drupal\sandbox_entities\Tests;

use Drupal\simpletest\WebTestBase;
use Drupal\Core\Entity\EntityManager;

/**
 * Provides automated tests for the sandbox_entities module.
 */
class DebugControllerTest extends WebTestBase {

  /**
   * Drupal\Core\Entity\EntityManager definition.
   *
   * @var \Drupal\Core\Entity\EntityManager
   */
  protected $entityManager;

  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "sandbox_entities DebugController's controller functionality",
      'description' => 'Test Unit for module sandbox_entities and controller DebugController.',
      'group' => 'Other',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests sandbox_entities functionality.
   */
  public function testDebugController() {
    // Check that the basic functions of module sandbox_entities.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
