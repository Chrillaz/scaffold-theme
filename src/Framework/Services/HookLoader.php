<?php

namespace WpTheme\Scaffold\Framework\Services;

use WpTheme\Scaffold\Framework\Abstracts\Loader;

class HookLoader extends Loader {

  public function addAction ( ...$args ): void {

    $this->add( 'actions', $this->container->get( 'Hook' )->set(
      $args
    ));
  }

  public function addFilter ( ...$args ): void {

    $this->add( 'filters', $this->container->get( 'Hook' )->set(
      $args
    ));
  }

  public function load (): void {

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