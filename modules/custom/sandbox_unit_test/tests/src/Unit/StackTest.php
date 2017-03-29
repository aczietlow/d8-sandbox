<?php

namespace Drupal\Tests\sandbox_unit_test\Unit;

use Drupal\Tests\UnitTestCase;

/**
 * Tests PHP standard stack functions.
 * @group sandbox
 */
class StackTest extends UnitTestCase {

  public function testPushAndPop() {
    $stack = [];
    $this->assertEquals(0, count($stack));

    array_push($stack, 'foo');
    $this->assertEquals('foo', $stack[count($stack) - 1]);
    $this->assertEquals(1, count($stack));
  }

  public function testEmpty() {
    $array = [];
    $this->assertEmpty($array);

    return $array;
  }

  /**
   * @depends testEmpty
   */
  public function testPush(array $array) {
    array_push($array, 'bar');
    $this->assertEquals('bar', $array[count($array)-1]);
    $this->assertNotEmpty($array);

    return $array;
  }

  /**
   * @depends testPush
   */
  public function testPop(array $array) {
    $this->assertEquals('bar', array_pop($array));
    $this->assertEmpty($array);
  }

}