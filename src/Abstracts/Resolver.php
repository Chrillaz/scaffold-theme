<?php

namespace WPTheme\Scaffold\Abstracts;

abstract class Resolver {

  abstract public function use ( string $service );

  protected function resolve ( string $service ) {

    try {

      $reflector = new \ReflectionClass( $service );

      if ( ! $reflector->isInstantiable() ) return;

      $constructor = $reflector->getConstructor();

      $parameters = $constructor->getParameters();

      if ( is_null( $parameters ) ) {

        return new $service;
      }

      return $reflector->newInstanceArgs( $this->resolveDeps( $parameters ) );
    } catch ( \ReflectionException $error ) {

      \wp_die( 
        '<h2>' . $error->getMessage() . '</h2> \n' . $error->getTraceAsString(),
        'Container exception',
        [
          'response'  => 501,
          'back_link' => true,
          'code'      => 'container_exception'
        ]
      );
    }
  }

  protected function resolveDeps ( $parameters ) {

    $dependencies = array();

    foreach ( $parameters as $parameter ) {

      $dependency = $parameter->getClass();

      if ( is_null( $dependency ) ) {

      } else {

        $dependencies[] = $this->resolve( $dependency->name );
      }
    }

    return $dependencies;
  }
}