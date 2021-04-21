<?php

namespace WpTheme\Scaffold\Framework\Container;

use Psr\Container\ContainerInterface;

use WpTheme\Scaffold\Framework\Container\Reflector;

class Container implements ContainerInterface {

  protected $reflector;
  
  protected $config = [];
  
  protected $bindings = [];
  
  protected $persisted = [];

  protected function __construct ( Reflector $reflector ) {

    $this->reflector = $reflector;
  }

  protected function isBound ( string $abstract ): bool {

    return isset( $this->bindings[$abstract] );
  }

  protected function isPersisted ( string $abstract ): bool {

    return isset( $this->persisted[$abstract] );
  }

  public function has ( string $abstract ): bool {

    return $this->isBound( $abstract ) || $this->isPersisted( $abstract );
  }

  public function get ( string $abstract ) {

    return $this->resolve( $abstract );
  }

  public function resolve ( string $abstract, array $parameters = [] ) {

    $object = $this->isBound( $abstract ) ? $this->bindings[$abstract] : $abstract;

    $hasDetails = ! empty( $parameters );

    if ( $this->isPersisted( $object ) && ! $hasDetails ) {

      return $this->persisted[$object];
    }

    if ( $object instanceof \Closure ) {

      return $object( $this );
    }

    $concrete = $this->reflector->concretize( $object, $parameters );

    if ( $this->isBound( $this->bindings[$abstract] ) && $this->bindings[$abstract]['persist'] ) {

      $this->persisted[$object] = $concrete;
    }

    return $concrete;
  }

  public function make ( string $key, array $args = [] ) {
    
    return $this->get( $key, $args );
  }

  public function bind ( string $abstract, $concrete = null, $shared = false ) {
    
    if ( is_null( $concrete ) ) {

      $concrete = $abstract;
    }

    if ( ! $concrete instanceof \Closure ) {

      $concrete = function ( $container ) use ( $concrete ) {

        return $concrete;
      };
    }

    $this->bindings[$abstract] = compact('concrete', 'persist' );
  }

  public static function create ( ...$params ) {

    return new static( ...$params );
  }
}