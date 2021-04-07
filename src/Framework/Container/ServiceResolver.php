<?php

namespace WpTheme\Scaffold\Framework\Container;

use WpTheme\Scaffold\Framework\Interfaces\ProviderInterface;

abstract class ServiceResolver {

  protected function hasProvider ( \ReflectionParameter $parameter ) {

    if ( ! is_null( $class = $parameter->getDeclaringClass() ) ) {

      if ( ! is_null( $provider = $this->getProvider( $class ) ) ) {

        return $provider;
      }
      
      if ( ! is_null( $parent = $class->getParentClass() ) ) {

        if ( $parent instanceof \ReflectionClass && $parent->isAbstract() && $class->isSubclassOf( $parent ) ) {
  
          if ( ! is_null( $provider = $this->getProvider( $parent ) ) ) {

            return $provider;
          }
        }
      }
    }
  }

  protected function getProvider ( \ReflectionClass $class ) {

    if ( $this->has( $provider = $class->getShortName() . 'Provider'::class ) ) {

      return $this->get( $provider );
    }
  }

  protected function resolveParameters ( array $parameters ): array {

    return array_map( function ( $parameter ) {

      if ( ! is_null( $provider = $this->hasProvider( $parameter ) ) ) {

        return $this->resolveProvider( $provider, $parameter );
      }

      if ( ! is_null( $class = $parameter->getClass() ) && $class->inNamespace() ) {
        
        return $this->resolve( $class->name );
      }
      
      return $this->resolveDefault( $parameter );
    }, $parameters );
  }

  protected function resolveProvider ( ProviderInterface $provider, \ReflectionParameter $parameter ) {
    
    $return = null;

    foreach ( $provider->register() as $param ) {
      
      if ( 'string' === gettype( $param ) ) {

        if ( class_exists( $param ) ) {
          
          $return = $this->resolve( $param );

          break;
        }
      }
      
      if ( ! is_null( $instance = $parameter->getClass() ) ) {
        
        if ( $param instanceof $instance->name ) {
        
          $return = $param;

          break;
        }

        $return = $this->resolve( $instance->name );

        break;
      }

      if ( gettype( $param ) === $parameter->getType()->getName() ) {
        
        $return = $param;

        break;
      }

      if ( 'integer' === gettype( $param ) && 'int' === $parameter->getType()->getName() ) {

        $return = $param;

        break;
      }
    }

    return $return;
  }

  protected function resolveDefault ( \ReflectionParameter $parameter ) {
    
    if ( $parameter->isDefaultValueAvailable() ) {

      return $parameter->getDefaultValue();
    }

    throw new \Exception( 'Nope' );
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
  }
}