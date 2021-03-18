<?php

namespace WpTheme\Scaffold\Exceptions;

use Psr\Container\NotFoundExceptionInterface;

class ServiceNotRegisteredException extends \Exception implements NotFoundExceptionInterface {
    
  public function __construct( $service, $code = 0, Exception $previous = null ) {

    $message = "Service {$service} is not registered";
    
    parent::__construct( $message, $code, $previous );
  }
}