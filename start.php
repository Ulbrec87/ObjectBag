<?php

require_once 'src/ObjectBag.php';

class A {

  protected $b;
  protected $c;

  public function __construct(B $b, C $c) {
    $this->b = $b;
    $this->c = $c;
  }

}

class B {

  public function __construct() {

  }

}

Class C {

  protected $b;

  public function __construct(B $b) {
    $this->b = $b;
  }

}

class D {

  protected $c;
  protected $t1;
  protected $t2;

  public function __construct(C $c, $type1, $type2) {
    $this->c = $c;
    $this->t1 = $type1;
    $this->t2 = $type2;
  }

}

class E {

  protected $a, $b, $c, $d;
  protected $t1, $t2, $t3, $t4;

  public function __construct(A $a, $t1, $t2, B $b, C $c, D $d, $t3, $t4, $t5) {
    $this->a = $a;
    $this->b = $b;
    $this->c = $c;
    $this->d = $d;
    $this->t1 = $t1;
    $this->t2 = $t2;
    $this->t3 = $t3;
    $this->t4 = $t4;
    $this->t5 = $t5;
  }

}

$bag = new Bag\ObjectBag();
$obj = $bag->getInstance('D', array("arg1", "arg2"));
$obj2 = $bag->getInstance('A');
