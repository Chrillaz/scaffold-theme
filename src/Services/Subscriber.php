<?php

namespace WPTheme\Scaffold\Services;

use WPTheme\Scaffold\Wrappers\Hook;

use WPTheme\Scaffold\Services\FlatStorage;

final class Subscriber {

  private $storage;

  public function __construct ( FlatStorage $storage ) {

    $this->storage = $storage;

    $this->storage->create([
      'actions' => [],
      'filters' => []
    ]);
  }

  public function addAction ( ...$args ) {

    $this->add( 'actions', new Hook( $args ) );
  }

  public function addFilter ( ...$args ) {

    $this->add( 'filters', new Hook( $args ) );
  }

  private function add ( string $key, Hook $hook ) {

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