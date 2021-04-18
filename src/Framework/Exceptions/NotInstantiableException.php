<?php

namespace WpTheme\Scaffold\Framework\Exceptions;

use Psr\Container\ContainerExceptionInterface;

class NotInstantiableException extends \Exception implements ContainerExceptionInterface {

  public function __construct( $service, $code = 0, \Exception $previous = null ) {

    $message = "Service or dependency {$service} is not instantiable";

    parent::__construct( $message, $code, $previous );
  }
}