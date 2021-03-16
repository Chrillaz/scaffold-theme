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

    $instance = $this->storage->get( $dependency );

    if ( ! $instance ) {

      throw new DependencyNotRegisteredException( $dependency );
    }

    return $this->resolve( $instance );
  }

  public function set ( string $dependency, $instance = null ) {

    if ( ! $this->storage->contains( $dependency ) ) {

      if ( $instance === null ) {

        $instance = $dependency;
      }

      $this->storage->update( $dependency, $instance );
    }
  }

  public function use ( string $instance ) {

    return $this->resolve( $instance );
  }

  public function has ( string $dependency ): bool {

    return $this->storage->contains( $dependency );
  }
}