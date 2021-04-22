<?php

namespace WpTheme\Scaffold\Framework\Exceptions;

use Psr\Container\ContainerExceptionInterface;

class NoDefaultValueException extends \Exception implements ContainerExceptionInterface {

  public function __construct( $service, $code = 0, \Exception $previous = null ) {
        
    $message = "Dependency {$service} can't be instatiated and yet has no default value";
    
    parent::__construct( $message, $code, $previous) ;
  }
}