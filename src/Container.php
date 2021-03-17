<?php

namespace WpTheme\Scaffold;

use Psr\Container\ContainerInterface;

use WpTheme\Scaffold\Abstracts\DependencyResolver;

use WpTheme\Scaffold\Exceptions\DependencyNotRegisteredException;

class Container extends DependencyResolver implements ContainerInterface {

  protected $storage;

  public function __construct ( Services\FlatStorage $storage ) {

    $this->storage = $storage;
  }

  public function get ( string $dependency ) {

    if ( $instance = $this->storage->get( $dependency ) ) {

      if ( $instance instanceof \Closure ) {

        return $instance( $this );
      }

      return $instance;
    }

    throw new DependencyNotRegisteredException( $dependency );
  }

  public function set ( string $dependency, $instance = null ) {

    if ( ! $this->has( $dependency ) ) {

      if ( $instance === null ) {

        $instance = $this->resolve( $dependency );

        $this->storage->set( $instance['name'], $instance['instance'] );
      } else {

        $this->storage->set( $dependency, $instance );
      }
    }
  }

  public function use ( string $instance ) {

    $instance = $this->resolve( $instance );

    return $instance['instance'];
  }

  public function has ( string $dependency ): bool {

    return $this->storage->contains( $dependency );
  }
}