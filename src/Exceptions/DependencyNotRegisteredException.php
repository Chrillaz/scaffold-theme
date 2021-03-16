<?php

namespace WpTheme\Scaffold\Exceptions;

use Psr\Container\NotFoundExceptionInterface;

class DependencyNotRegisteredException extends \Exception implements NotFoundExceptionInterface {
    
  public function __construct($dependency, $code = 0, Exception $previous = null) {

    $message = "Dependency {$dependency} is not registered";
    
    parent::__construct($message, $code, $previous);
  }
}