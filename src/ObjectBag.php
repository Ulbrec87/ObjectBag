<?php

/**
 * Simple Dependency Injection Container
 * @author Ulbrec
 */

namespace Bag;

class ObjectBag {

  public $objects = array();

  /**
   * Return true if class {$className} exists, else false
   * @param type $className
   * @return boolean
   */
  private function isClassExists($className) {
    if (!class_exists($className)) {
      return false;
    }
    return true;
  }

  /**
   * Return true if exists an instance of {$className} in the Bag
   * @param type $className
   * @return boolean
   */
  private function checkInstance($className) {
    if (!empty($this->objects[$className])) {
      return true;
    }
    return false;
  }

  private function replaceNullWithArgs($arrayWithNull = array(), $args = array()) {
    foreach ($arrayWithNull as $index => $value) {
      if ($value == null) {
        $arrayWithNull[$index] = array_shift($args);
        if (count($args) == 0) {
          break;
        }
      }
    }
    $arrayWithoutNull = $arrayWithNull;
    return $arrayWithoutNull;
  }

  public function getInstance($className, array $args = array()) {
    if (!$this->isClassExists($className)) {
      throw new \Exception("Class {$className} does not exists");
    }

    $obj = $this->checkInstance($className) == true ? $this->objects[$className] : null;
    if ($obj != null && $obj instanceof $className) {
      return $obj;
    }
    $construct_parameters = $this->getConstructParameters($className);
    $instance_parameters = $this->getInstanceParameters($construct_parameters);
    $params = $this->replaceNullWithArgs($instance_parameters, $args);
    $reflect = new \ReflectionClass($className);
    $obj = $reflect->newInstanceArgs($params);
    $this->objects[$className] = $obj;
    return $obj;
  }

  private function getInstanceParameters(array $parameters) {
    $instance_parameter = array();
    foreach ($parameters as $param) {
      $classParam = $param->getClass();
      if (!empty($classParam)) {
        $classParameterName = $param->getClass()->getName();
        $object = $this->getInstance($classParameterName);
        $instance_parameter[] = $object;
      } else {
        $instance_parameter[] = null;
      }
    }
    return $instance_parameter;
  }

  private function getConstructParameters($className) {
    try {
      $reflectionMethod = new \ReflectionMethod($className, '__construct');
      $parameters = $reflectionMethod->getParameters();
    } catch (\ReflectionException $ex) {
      $parameters = array();
    }
    return $parameters;
  }

}
