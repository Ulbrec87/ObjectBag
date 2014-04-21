<?php

namespace BagTest;

class A {

  public $b;
  public $c;

  public function __construct(B $b, C $c) {
    $this->b = $b;
    $this->c = $c;
  }

}

class B {
  /* public function __construct() {

    } */
}

class C {

  public $b;

  public function __construct(B $b) {
    $this->b = $b;
  }

}

class D {

  public $c;
  public $t1;
  public $t2;

  public function __construct(C $c, $type1, $type2) {
    $this->c = $c;
    $this->t1 = $type1;
    $this->t2 = $type2;
  }

}

class E {

  public $a, $b, $c, $d;
  public $t1, $t2, $t3, $t4, $t5;

  public function __construct(A $a, B $b, C $c, D $d, $t1, $t2, $t3, $t4, $t5) {
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
