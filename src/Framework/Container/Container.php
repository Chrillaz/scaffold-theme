<?php

namespace WpTheme\Scaffold\Framework\Container;

use Psr\Container\ContainerInterface;

use WpTheme\Scaffold\Framework\Container\Reflector;

class Container implements ContainerInterface {

  protected $reflector;
  
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

  public function getProvider ( string $abstract ) {

    if ( $provider = $this->get( $abstract . 'Provider' ) && ! is_string( $provider ) ) {
      
      return $provider( $this )->register();
    }

    return [];
  }

  public function get ( string $abstract ) {

    if ( $this->isPersisted( $abstract ) ) {

      return $this->persisted[$abstract];
    }

    if ( $this->isBound( $abstract ) ) {

      return $this->bindings[$abstract];
    }

    return $abstract;
  }

  public function resolve ( string $abstract, array $parameters = [] ) {

    $object = $this->get( $abstract );

    $hasDetails = ! empty( $parameters );

    if ( $object instanceof \Closure ) {

      return $object( $this );
    }

    if ( $this->isPersisted( $object ) && ! $hasDetails ) {

      return $this->persisted[$object];
    }

    $concrete = $this->reflector->concretize( $object, $parameters );

    if ( isset( $object['persist'] ) ) {

      $this->persisted[$object] = $concrete;
    }

    return $concrete;
  }

  public function make ( string $key, array $args = [] ) {
    
    return $this->resolve( $key, $args );
  }

  public function bind ( string $abstract, $concrete = null, $persist = false ) {
    
    if ( is_null( $concrete ) ) {

      $concrete = $abstract;
    }

    if ( ! $concrete instanceof \Closure ) {

      $concrete = function ( $container ) use ( $concrete ) {

        return $concrete;
      };
    }

    $this->bindings[$abstract] = compact( 'concrete', 'persist' );
  }

  public static function create ( ...$params ): Container {

    return new static( ...$params );
  }
}