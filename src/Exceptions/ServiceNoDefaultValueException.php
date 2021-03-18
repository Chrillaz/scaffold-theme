<?php

namespace WpTheme\Scaffold\Exceptions;

use Psr\Container\ContainerExceptionInterface;

class ServiceNoDefaultValueException extends \Exception implements ContainerExceptionInterface {

  public function __construct( $sercive, $code = 0, Exception $previous = null ) {
        
    $message = "Dependency {$service} can't be instatiated and yet has no default value";
    
    parent::__construct( $message, $code, $previous) ;
  }
}