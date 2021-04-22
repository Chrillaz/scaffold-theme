<?php

namespace WpTheme\Scaffold\Framework\Container;

use WpTheme\Scaffold\Framework\Container\ContextResolution;

class Reflector {

  public function __construct ( ContextResolution $context ) {

    $this->context = $context;
  }

  public function concretize ( string $abstract, array $contextParameters ) {
    
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

    if ( ! empty( $contextParameters ) || $this->context->getProvider( $parameters ) ) {

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
    
      if ( ! is_null( $class = $parameter->getClass() ) && $class->inNamespace()) {
        
        return $this->concretize( $class->name, [] );
      }
      
      return $this->resolveDefault( $parameter );
    }, $parameters );
  }

  protected function resolveDefault ( \ReflectionParameter $parameter ) {

    if ( $parameter->isDefaultValueAvailable() ) {

      return $parameter->getDefaultValue();
    }

    throw new \Exception( $parameter );
  }
}