<?php

namespace WpTheme\Scaffold\Framework\Container;

use Psr\Container\ContainerInterface;

use WpTheme\Scaffold\Framework\Container\Reflector;

class Container implements ContainerInterface {

  protected $context;
  
  protected $bindings = [];
  
  protected $persisted = [];

  protected function __construct ( ContextResolution $context ) {

    $this->context = $context;
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

  public function resolve ( string $abstract, $parameters = null ) {
var_dump('<pre>', $parameters, '</pre>');
    $object = $this->get( $abstract );

    $hasDetails = ! is_null( $parameters );

    if ( is_array( $object ) ) {

      if ( isset( $object['concrete'] ) ) {
        
        return $object['concrete']( $this );
      }
    }

    if ( $object instanceof \Closure ) {

      return $object( $this );
    }
    
    if ( $this->isPersisted( $abstract ) && ! $hasDetails ) {

      return $this->persisted[$abstract];
    }
    
    $concrete = $this->concretize( $object, $parameters );
    
    if ( isset( $object['persist'] ) ) {

      $this->persisted[$object] = $concrete;
    }

    return $concrete;
  }

  public function make ( string $key, $args = null ) {
    
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

    if ( $persist ) {

      $this->persisted[$abstract] = compact( 'concrete', 'persist' );
    }

    $this->bindings[$abstract] = compact( 'concrete', 'persist' );
  }

  public function concretize ( string $abstract, $contextParameters ) {
    
    try {

      $reflector = new \ReflectionClass( $abstract );
    } catch ( \ReflectionException $error ) {

    }

    if ( ! $reflector->isInstantiable() ) {
      
      if ( $this->get( $reflector->getShortName() ) ) {

        return $this->bindings[$reflector->getShortName()]['concrete']( $this );
      }

      throw new \Exception( 'Not instantiable' );
    }

    if ( is_null( $constructor = $reflector->getConstructor() ) ) {
        
      return $reflector->newInstanceWithoutConstructor();
    }

    if ( is_null( $parameters = $constructor->getParameters() ) ) {

      return $reflector->newInstance();
    }
    var_dump('<pre>', $contextParameters, '</pre>');
    if ( ! is_null( $contextParameters ) ) {
      
      if ( $contextParameters instanceof \Closure ) {

        $contextParameters = $contextParameters( $this );
      }

      $parameters = $this->context->parseParameters( $parameters, $contextParameters );
      
      return $reflector->newInstanceArgs( array_merge(
        $this->concretizeParameters( $parameters ),
        array_values( $contextParameters )
      ));
    } 

    return $reflector->newInstanceArgs( $this->concretizeParameters( $parameters ) );
  }

  protected function concretizeParameters ( array $parameters ): array {

    return array_map( function ( $parameter ) {

      if ( ! is_null( $provider = $this->context->getProvider( $parameter ) ) ) {
        
        if ( array_key_exists( $parameter->name, $contextParameters = (new $provider())->register() ) ) {

          return $contextParameters[$parameter->name];
        }
      }
      
      if ( ! is_null( $abstract = $parameter->getClass() ) && $abstract->inNamespace()) {
        
        return $this->resolve( $abstract->name );
      }
      
      return $this->resolveDefault( $parameter );
    }, $parameters );
  }

  protected function resolveDefault ( \ReflectionParameter $parameter ) {
    
    if ( $contextParameter = $this->context->hasConfig( $parameter ) ) {

      return $contextParameter;
    }

    if ( $parameter->isDefaultValueAvailable() ) {

      return $parameter->getDefaultValue();
    }

    throw new \Exception( $parameter );
  }

  public static function create ( ...$params ): Container {

    return new static( ...$params );
  }
}