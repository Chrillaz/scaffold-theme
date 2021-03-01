<?php

namespace WPTheme\Scaffold;

use WPTheme\Scaffold\Abstracts\Resolver;

use WPTheme\Scaffold\Services\FlatStorage;

use WPTheme\Scaffold\Contracts\Container;

class ServiceContainer extends Resolver implements Container {

  private $storage;

  public function __construct ( FlatStorage $storage ) {

    $this->storage = $storage;
  }

  public function use ( string $service ) {
    
    if ( $object = $this->storage->get( $service ) ) {
    
      return $object;
    }
    
    return $this->storage->update( $service, self::resolve( $service ) );
  }
}