<?php

namespace WpTheme\Scaffold\Framework\Container;

use WpTheme\Scaffold\Framework\Services\Storage;

class Container extends ServiceResolver {

  private static $container;

  private $definitions;

  private $singletons;

  private $resolved;

  private function __construct (
    Storage $definitions,
    Storage $singletons
  ) {

    $this->definitions = $definitions;

    $this->singletons = $singletons;

    $this->resolved = [];
  }

  protected function has ( string $key ): bool {

    return ( $this->singletons->contains( $key ) || $this->definitions->contains( $key ) );
  }

  public function get ( string $key ) {
    
    if ( ! $this->has( $key ) ) {

      // Exception
      return;
    }

    if ( $this->singletons->contains( $key ) ) {
      
      return $this->singletons->get( $key );
    }
    
    if ( ! isset( $this->resolved[$key] ) ) {

      return $this->resolved[$key] = $this->resolve( $this->definitions->get( $key ) );
    }

    return $this->resolved[$key];
  }

  public static function getInstance ( 
    Storage $definitions,
    Storage $singletons
  ) {

    if ( is_null( self::$container ) ) self::$container = new Container(
      $definitions,
      $singletons
    );

    return self::$container;
  }
}