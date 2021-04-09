<?php

namespace WpTheme\Scaffold\Framework\Container;

use WpTheme\Scaffold\Framework\Exceptions\NoDefaultValueException;

use WpTheme\Scaffold\Framework\Interfaces\ProviderInterface;

abstract class Resolver {

  protected function resolveParameters ( array $parameters ): array {

    return array_map( function ( $parameter ) {

      if ( ! is_null( $provider = $this->hasProvider( $parameter ) ) ) {

        if ( $provided = $this->isProvided( $provider, $parameter ) ) {

          return $provided;
        }
      }

      if ( ! is_null( $class = $parameter->getClass() ) && $class->inNamespace() ) {
        
        return $this->resolve( $class->name );
      }
      
      return $this->resolveDefault( $parameter );
    }, $parameters );
  }

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

  protected function isProvided ( ProviderInterface $provider, \ReflectionParameter $parameter ) {

    $type = $parameter->getType()->getName();

    foreach ( $provider->register() as $provide ) {

      if ( \is_string( $provide ) && $type === gettype( $provide ) ) {
        
        return $provide;
      }

      if ( \is_array( $provide ) && $type === gettype( $provide ) ) {

        return $provide;
      }

      if ( \is_integer( $provide ) && 'int' === $type ) {

        return $provide;
      }

      if ( \is_object( $provide ) ) {
        
        if ( ! is_null( $class = $parameter->getClass() ) ) {
        
          if ( $provide instanceof $class->name ) {

            return $provide;
          }
        }

        if ( is_callable( $provide ) && ! $parameter->isCallable() ) {

          return $provide();
        }
      }
    }
  }

  protected function resolveDefault ( \ReflectionParameter $parameter ) {
    
    if ( $parameter->isDefaultValueAvailable() ) {

      return $parameter->getDefaultValue();
    }

    throw new NoDefaultValueException( $parameter );
  }
}