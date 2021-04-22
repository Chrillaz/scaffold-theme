<?php

namespace WpTheme\Scaffold\Framework\Container;

use WpTheme\Scaffold\Framework\Resources\Storage;

class ContextResolution {

  protected $config;

  public function __construct ( Storage $config ) {

    $this->config = $config;
  }

  public function parseParameters ( array $parameters, array $contextParameters ) {

    return array_filter( $parameters, function ( \ReflectionParameter $parameter ) use ( $contextParameters ) {

      return ! array_key_exists( $parameter->name, $contextParameters ) 
        || ( ! is_null( $parameter->getType() ) && isset( $this->config[$parameter->getType()] ) );
    });
  }

  public function getProvider ( \ReflectionClass $reflector ) {

    $provider = $reflector->getShortName . 'Provider';

    if ( ! is_null( $provider->getType() ) {
      
    }
  }

  public function getConfig () {

    return $this->config->all();
  }
}