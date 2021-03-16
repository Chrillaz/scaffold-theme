<?php

namespace WpTheme\Scaffold\Abstracts;

use WpTheme\Scaffold\Exceptions\DependencyNotInstantiableException;

use WpTheme\Scaffold\Exceptions\DependencyNoDefaultValueException;

class DependencyResolver {

  protected function resolve ( string $dependency ) {
    
    $reflector = new \ReflectionClass( $dependency );

    if ( ! $reflector->isInstantiable() ) throw new \DependencyNotInstantiableException( $reflector->name );

    $constructor = $reflector->getConstructor();

    $parameters = $constructor->getParameters();

    if ( is_null( $parameters ) ) return $reflector->newInstance();

    foreach ( $parameters as $parameter ) {

      $dependencies[] = $this->resolveDependency( $parameter );
    }

    return $reflector->newInstanceArgs( $dependencies );
  }

  protected function resolveDependency ( \ReflectionParameter $parameter ) {

    if ( $parameter->getClass() !== null ) {

      $name = $parameter->getType()->getName();
      
      if ( ! $parameter->getType()->isBuiltin() ) {

        $this->set( $name );
      }

      return $this->get( $name );
    } else {

      if ( $parameter->isDefaultValueAvailable() ) {

        return $parameter->getDefaultValue();
      } else {

        throw new DependencyHasNoDefaultValueException( $parameter->name );
      }
    }
  }
}