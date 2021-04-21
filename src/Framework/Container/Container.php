<?php 

namespace WpTheme\Scaffold\Framework\Container;

use Exception;

class Container {

  protected $bindings = [];

  protected $instances = [];

  protected $providers = [];

  public static function create () {

    return new Static();
  }

  public function has ( string $key ) {

    return ( isset( $this->bindings[$key] ) || isset( $this->instances[$key] ) );
  }

  protected function hasDefinition ( string $key ) {

    return array_key_exists( $key, $this->providers );
  }

  public function get ( string $key, array $args = [] ) {

    $abstract = $this->isBound( $key ) ? $this->bindings[$key]($this) : $key;

    $withOverride = ! empty( $args );

    if ( $this->has( $key ) && ! $withOverride ) {

      return $this->instances[$abstract];
    }
    
    $concrete = $this->resolve( $abstract, $args );

    if ( $this->isSingleton( $abstract ) ) {

      $this->instances[$abstract] = $concrete;
    }

    return $concrete;
  }

  public function getDefinition ( string $key ) {

    if ( isset( $this->providers[$key] ) ) {

      return $this->providers[$key];
    }
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

    $this->bindings[$abstract] = compact('concrete', 'shared' );
  }

  public function bindDefinition ( string $key, string $definition ) {

    $this->providers[$key] = $this->make( $definition )->register();
  }

  public function make ( string $key, array $args = [] ) {
    
    return $this->get( $key, $args );
  }

  protected function isBound ( string $key ) {

    return array_key_exists( $key, $this->bindings ) || in_array( $key, $this->bindings );
  }

  protected function isSingleton ( string $key ) {

    return ( $this->isBound( $key ) && $this->bindings[$key]['shared'] );
  }

  protected function resolve ( string $abstract, array $definitions ) {

    if ( $abstract instanceof \Closure ) {

      return $abstract( $this );
    }

    try {

      $reflector = new \ReflectionClass( $abstract );
    } catch ( \ReflectionException $error ) {
      
    }

    if ( ! $reflector->isInstantiable() ) {

      throw new \Exception( 'Not instantiable' );
    }

    if ( is_null( $constructor = $reflector->getConstructor() ) ) {
        
      return $reflector->newInstanceWithoutConstructor();
    }

    if ( is_null( $parameters = $constructor->getParameters() ) ) {

      return $reflector->newInstance();
    }

    if ( ! empty( $definitions ) ) {

      $diff = array_filter( $parameters, function ( $parameter ) use ( $definitions ) {

        return ! array_key_exists( $parameter->name, $definitions );
      });

      $dependencies = $this->resolveDependencies( $diff );
      
      $dependencies = array_merge( $dependencies, array_values($definitions) );

      return $reflector->newInstanceArgs( $dependencies );
    }

    return $reflector->newInstanceArgs( $this->resolveDependencies( $parameters ) );
  }

  protected function hasOverrides ( \ReflectionParameter $parameter ) {

    if ( ! is_null( $class = $parameter->getDeclaringClass() ) ) {

      return $this->getDefinition( $class->getShortName() );
      
      if ( ! is_null( $parent = $class->getParentClass() ) ) {

        if ( $parent instanceof \ReflectionClass && $parent->isAbstract() && $class->isSubclassOf( $parent ) ) {
  
          return $this->getDefinition( $parent->getShortName() );
        }
      }
    }
  }

  protected function resolveDependencies ( array $parameters ) {
    
    return array_map( function ( $parameter ) {

      if ( ! is_null( $overrides = $this->hasOverrides( $parameter ) ) ) {

        if ( array_key_exists( $parameter->name, $overrides ) ) {

          $override = $overrides[$parameter->name];

          unset( $overrides[$parameter->name] );

          return $override;
        }
      }

      if ( ! is_null( $class = $parameter->getClass() ) ) {
        
        return $class->inNamespace()
          ? $this->make( $class->name )
          : $this->resolveWpMappings( $class->getName() );
      }
      
      return $this->resolveDefault( $parameter );
    }, $parameters );
  }

  protected function resolveWpMappings ( string $class ) {

    if ( array_key_exists( $class, $wpMappings = require 'WpBindings.php' ) ) {

      return $wpMappings[$class];
    }

    throw new \Exception( 'No WP mappings' );
  }

  protected function resolveDefault ( \ReflectionParameter $parameter ) {

    if ( $parameter->isDefaultValueAvailable() ) {

      return $parameter->getDefaultValue();
    }

    throw new \Exception( $parameter );
  }
}