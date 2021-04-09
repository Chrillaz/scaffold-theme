<?php

namespace WpTheme\Scaffold\Framework\Container;

use Psr\Container\ContainerInterface;

use WpTheme\Scaffold\Framework\Services\Storage;

use WpTheme\Scaffold\Framework\Exceptions\NotRegisteredException;

use WpTheme\Scaffold\Framework\Exceptions\NotInstantiableException;

class Container extends Resolver implements ContainerInterface {

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

  public function has ( string $key ): bool {

    return ( $this->singletons->contains( $key ) || $this->definitions->contains( $key ) );
  }

  public function get ( string $key ) {
    
    if ( ! $this->has( $key ) ) {

      throw new NotRegisteredException( $key );
    }

    if ( $this->singletons->contains( $key ) ) {

      return $this->singletons->get( $key )::getInstance();
    }
    
    if ( ! isset( $this->resolved[$key] ) ) {

      $this->resolved[$key] = $this->resolve( $this->definitions->get( $key ) );
    }

    return $this->resolved[$key];
  }

  public function resolve ( string $name ) {
    
    if ( ! class_exists( $name ) ) {

      return;
    }

    $reflector = new \ReflectionClass( $name );

    if ( $reflector->isInstantiable() ) {

      if ( is_null( $constructor = $reflector->getConstructor() ) ) {
        
        return $reflector->newInstanceWithoutConstructor();
      }

      return is_null( $parameters = $constructor->getParameters() )
        ? $reflector->newInstance()
        : $reflector->newInstanceArgs( $this->resolveParameters( $parameters ) );
    }

    if ( $reflector->hasMethod( 'getInstance' ) ) {

      return $this->get( $reflector->getShortName() );
    }

    throw new NotInstantiableException( $name );
  }

  public static function getInstance ( 
    Storage $definitions = null,
    Storage $singletons = null
  ) {

    if ( is_null( self::$container ) ) self::$container = new Container(
      $definitions,
      $singletons
    );

    return self::$container;
  }
}