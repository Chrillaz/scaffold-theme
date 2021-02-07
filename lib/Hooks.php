<?php

namespace Theme\Scaffold;

use Theme\Scaffold\Queue;

use Theme\Scaffold\Includes\Hook;

class Hooks extends Queue {

  /**
   * addAction
   * 
   * @param string $hook wp hook to execute on
   * 
   * @param string $callback to execute
   * 
   * @param object|null $component
   * 
   * @param int|null $priority
   * 
   * @param int|null $acceptedArgs
   * 
   * @return void
   */
  public function addAction( ...$args ): void {

    $this->queue( 'actions', new Hook( $args ) );
  }

  /**
   * addAction
   * 
   * @param string $hook wp hook to execute on
   * 
   * @param string $callback to execute
   * 
   * @param object|null $component
   * 
   * @param int|null $priority
   * 
   * @param int|null $acceptedArgs
   * 
   * @return void
   */
  public function addFilter( ...$args ) {
    
    $this->queue( 'filters', new Hook( $args ) );
  }

  /**
   * load
   * 
   * @return void
   */
  public function load(): void {

    array_map( function ( $hook ) {

      add_action( $hook->event, $hook->callback, $hook->priority, $hook->numargs );

      unset( $hook );
    }, $this->actions );
    
    array_map( function ( $hook ) {

      add_filter( $hook->event, $hook->callback, $hook->priority, $hook->numargs  );
      
      unset( $hook );
    }, $this->filters );
  }
}