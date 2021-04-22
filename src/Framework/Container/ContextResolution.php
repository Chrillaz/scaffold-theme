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
        || isset( $this->config->all()[$parameter->name] );
    });
  }

  public function getProvider ( \ReflectionParameter $parameter ) {
    
    if ( ! is_null( $instance = $parameter->getDeclaringClass() ) ) {

      if ( ! is_null( $provider = 'WpTheme\\Scaffold\\App\\Providers\\' . $instance->getShortName() . 'Provider'::class ) ) {

        if ( class_exists( $provider ) ) {

          return $provider;
        }
      }

      if ( ! is_null( $abstractParent = $instance->getParentClass() ) ) {

        if ( $abstractParent instanceof \ReflectionClass && $abstractParent->isAbstract() && $instance->isSubclassof( $abstractParent ) ) {

          if ( ! is_null( $provider = 'WpTheme\\Scaffold\\App\\Providers\\' . $abstractParent->getShortName() . 'Provider'::class ) ) {

            if ( class_exists( $provider ) ) {

              return $provider;
            }
          }
        }
      }
    }
  }

  public function hasConfig ( \ReflectionParameter $parameter ) {

    return $this->config->get( $parameter->getType()->getName() );
  }

  public function getConfig () {

    return $this->config->all();
  }
}