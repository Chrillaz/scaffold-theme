<?php

namespace WpTheme\Scaffold\Framework\Services;

use WpTheme\Scaffold\Framework\Services\Storage;

use WpTheme\Scaffold\Framework\Interfaces\HookInterface;

use WpTheme\Scaffold\Framework\Interfaces\HookLoaderInterface;

class HookLoader implements HookLoaderInterface {

  private static $hooks;

  private $queue;

  public function __construct ( Storage $storage ) {

    $this->queue = $storage;
  }

  private function reset () {

    foreach ( $this->queue->all() as $key => $hooks ) {

      $this->queue->delete( $key );
    }
  }

  private function add ( string $queue, HookInterface $hook ): void {

    if ( ! $this->queue->contains( $queue ) ) {

      $this->queue->set( $queue, [] );
    }

    $this->queue->set( $queue, array_push( 
      $this->queue->get( $queue ), 
      $hook 
    ));
  }

  public function addAction ( ...$args ): void {

  }

  public function addFilter ( ...$args ): void {

  }

  public function run (): void {

    if ( $actions = $this->queue->get( 'actions' ) ) {

      array_map( function ( $hook ) {
  
        \add_action( $hook->event, $hook->callback, $hook->priority, $hook->numargs );
  
        unset( $hook );
      }, $actions );
    }

    if ( $filters = $this->queue->get( 'filters' ) ) {

      array_map( function ( $hook ) {
  
        \add_filter( $hook->event, $hook->callback, $hook->priority, $hook->numargs );
  
        unset( $hook );
      }, $filters );
    }

    $this->reset();
  }
}