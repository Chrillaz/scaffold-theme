<?php

namespace WpTheme\Scaffold\Framework\Container;

use WpTheme\Scaffold\Framework\Interfaces\ProviderInterface;

abstract class ServiceResolver {

  public function resolve ( string $name ) {

    if ( ! class_exists( $name ) ) {

      return;
    }

    $reflector = new \ReflectionClass( $name );

    if ( $reflector->isInstantiable() ) {

      $constructor = $reflector->getConstructor();

      if ( is_null( $constructor ) ) {

        return $reflector->newInstanceWithoutConstructor();
      }

      $parameters = $constructor->getParameters();

      return is_null( $parameters )
        ? $reflector->newInstance()
        : $reflector->newInstanceArgs( $this->resolveParameters( $parameters ) );
    }
  }

  protected function resolveParameters ( array $parameters ) {

    return array_map( function ( $parameter ) {
      
      if ( ! is_null( $parameter->getClass() ) && $parameter->getClass()->inNamespace() ) {

        return $this->resolve( $parameter->getType()->getName() );
      }

      if ( $this->has( $provider = $parameter->getDeclaringClass()->getShortName() . 'Provider'::class ) ) {

        return $this->resolveProvider( $this->get( $provider ), $parameter );
      } 
      
      return $this->resolveDefault( $parameter );
    }, $parameters );
  }

  protected function resolveDefault ( \ReflectionParameter $parameter ) {

    if ( $parameter->isDefaultValueAvailable() ) {

      return $parameter->getDefaultValue();
    }

    throw new Exception( 'Nope' );
  }

  protected function resolveProvider ( ProviderInterface $provider, \ReflectionParameter $parameter ) {

    foreach ( $provider->register() as $param ) {

      if ( ! is_null( $instancearg = $parameter->getClass() ) ) {

        if ( $param instanceof $instancearg->name ) {

          return $param;
        }

        break;
      }
        
      if ( gettype( $param ) === $parameter->getType()->getName() ) {

        return $param;

        break;
      }
    }
  }
}