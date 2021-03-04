<?php

namespace WpTheme\Scaffold;

use WpTheme\Scaffold\Services\Logger;

use WpTheme\Scaffold\Services\FlatStorage;

use WpTheme\Scaffold\Contracts\Container;

class ServiceContainer implements Container {

  private $storage;

  public function __construct ( FlatStorage $storage ) {

    $this->storage = $storage;
  }

  public function new ( string $name, $params = null ) {

    try {

      return new $name( $params );
    } catch ( \Exception $error ) {

      new Logger( 'container_exception', $error );
    }
  }

  public function use ( string $service ) {

    try {

      if ( $object = $this->storage->get( $service ) ) {
      
        return $object;
      }

      throw new \Exception( "Service not defined." );
    } catch ( \Exception $error ) {
      
      new Logger( 'container_exception', $error );
    }
  }

  public function register ( string $name, \Closure $callback ) {

    try {
      if ( ! $this->storage->get( $name ) ) {

        return $this->storage->update( $name, new $name( $callback( $this ) ) );
      }

      throw new \Exception( "Service already defined." );
    } catch ( \Exception $error ) {

      new Logger( 'container_exception', $error );
    }
  }
}