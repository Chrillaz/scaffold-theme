<?php

namespace WpTheme\Scaffold\Abstracts;

use WpTheme\Scaffold\Exceptions\DependencyNotInstantiableException;

use WpTheme\Scaffold\Exceptions\DependencyNoDefaultValueException;

class DependencyResolver {

  protected function resolve ( string $service ) {
    
    $reflector = new \ReflectionClass( $service );

    if ( $reflector->isInstantiable() ) {
      
      $name = $reflector->getShortName();

      $constructor = $reflector->getConstructor();

      $parameters = $constructor->getParameters();

      if ( is_null( $parameters ) ) {

        return [
          'name' => $name,
          'instance' => $reflector->newInstance()
        ];
      } 

      return [
        'name' => $name,
        'instance' => $reflector->newInstanceArgs( $this->resolveDependencies( $parameters ) )
      ];
    }

    throw new \ServiceNotInstantiableException( $reflector->name );
  }

  protected function resolveDependencies ( array $parameters ) {

    return array_map( function ( $parameter ) {

      if ( $parameter->getClass() !== null ) {

        $dependency = $this->resolve( $parameter->getType()->getName() );
        
        return $dependency['instance'];
      } else {

        return $this->resolveDefaultValue( $parameter );
      }
    }, $parameters );
  }

  protected function resolveDefaultValue ( \ReflectionParameter $parameter ) {

    if ( $parameter->isDefaultValueAvailable() ) {

      return $parameter->getDefaultValue();
    }
  
    throw new ServiceHasNoDefaultValueException( $parameter->name );
  }
}