<?php

namespace WpTheme\Scaffold\Exceptions;

use Psr\Container\ContainerExceptionInterface;

class DependencyNoDefaultValueException extends \Exception implements ContainerExceptionInterface {

  public function __construct($dependency, $code = 0, Exception $previous = null) {
        
    $message = "Dependency {$dependency} can't be instatiated and yet has no default value";
    
    parent::__construct($message, $code, $previous);
  }
}