<?php

namespace WpTheme\Scaffold\Services;

use WpTheme\Scaffold\Wrappers\Hook;

use WpTheme\Scaffold\Services\FlatStorage;

class Subscriber {

  private $storage;

  public function __construct ( FlatStorage $storage ) {

    $this->storage = $storage;
  }

  public function add ( string $key, Hook $hook ) {

    $queue = $this->storage->get( $key );
    
    $queue[] = $hook;

    $this->storage->update( $key, $queue );
  }

  public function subscribe (): void {

    array_map( function ( $hook ) {

      add_action( $hook->event, $hook->callback, $hook->priority, $hook->numargs );

      unset( $hook );
    }, $this->storage->get( 'actions' ) );

    array_map( function ( $hook ) {

      add_filter( $hook->event, $hook->callback, $hook->priority, $hook->numargs );

      unset( $hook );
    }, $this->storage->get( 'filters' ) );
  }
}