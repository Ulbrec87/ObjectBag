<?php

/**
 * @author Ulbrec
 */

namespace BagTest;

use Bag\ObjectBag;

class ObjectBagTest extends \PHPUnit_Framework_TestCase {

  protected $bag;

  protected function createBag() {
    $this->bag = new \Bag\ObjectBag();
  }

  private function isSameObject($object1, $object2) {
    return (spl_object_hash($object1) === spl_object_hash($object2));
  }

  public function testCreateInstanceWithoutDependencies() {
    $this->createBag();
    $b = $this->bag->getInstance('\BagTest\B');
    $this->assertTrue($b instanceof \BagTest\B);
  }

  public function testCreateInstanceWithTwoDependencies() {
    $this->createBag();
    $a = $this->bag->getInstance('\BagTest\A');
    $this->assertTrue($a instanceof \BagTest\A);
    $this->assertTrue($a->b instanceof \BagTest\B);
    $this->assertTrue($a->c instanceof \BagTest\C);
  }

  public function testCreateInstanceWithThreeOrMoreDependencies() {
    $this->createBag();
    $e = $this->bag->getInstance('BagTest\E', array("arg1", "arg2"));
    $this->assertTrue(
      $e instanceof \BagTest\E &&
      $e->a instanceof \BagTest\A &&
      $e->b instanceof \BagTest\B &&
      $e->c instanceof \BagTest\C &&
      $e->d instanceof \BagTest\D);

    $this->assertEquals("arg1", $e->t1);
    $this->assertEquals("arg2", $e->t2);

    $this->assertTrue(
      $e->t3 == null &&
      $e->t4 == null &&
      $e->t5 == null);
  }

  public function testReturnTheSameInstance() {
    $this->createBag();
    $a1 = $this->bag->getInstance('\BagTest\A');
    $a2 = $this->bag->getInstance('\BagTest\A');
    $this->assertTrue($this->isSameObject($a1, $a2));
  }

}
