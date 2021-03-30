<?php

namespace WpTheme\Scaffold;

use Psr\Container\ContainerInterface;

use WpTheme\Scaffold\Abstracts\DependencyResolver;

use WpTheme\Scaffold\Exceptions\DependencyNotRegisteredException;

class Container extends DependencyResolver implements ContainerInterface {

  protected $storage;

  public function __construct ( Services\Storage $storage ) {

    $this->storage = $storage;
  }

  public function get ( string $service ) {

    if ( $instance = $this->storage->get( $service ) ) {

      if ( $instance instanceof \Closure ) {

        return $instance( $this );
      }

      return $instance;
    }

    throw new ServiceNotRegisteredException( $service );
  }

  public function set ( string $service, $instance = null ) {

    if ( ! $this->has( $service ) ) {

      if ( $instance === null ) {

        $instance = $this->resolve( $service );

        $this->storage->set( $instance['name'], $instance['instance'] );
      } else {

        $this->storage->set( $service, $instance );
      }
    }
  }

  public function use ( string $service ) {

    $service = $this->resolve( $service );

    return $service['instance'];
  }

  public function has ( string $service ): bool {

    return $this->storage->contains( $service );
  }
}