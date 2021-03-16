<?php

namespace WpTheme\Scaffold\Exceptions;

use Psr\Container\ContainerExceptionInterface;

class DependencyNotInstantiableException extends \Exception implements ContainerExceptionInterface {

  public function __construct($dependency, $code = 0, Exception $previous = null) {

    $message = "Dependency {$dependency} is not instantiable";

    parent::__construct($message, $code, $previous);
  }
}