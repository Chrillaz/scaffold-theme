<?php

namespace Chrillaz\WPScaffold\Includes;

if ( ! defined( 'ABSPATH' ) ) exit;

use Chrillaz\WPScaffold\Includes\Loader;

class Hooks extends Loader {

  public function addAction( $hook, $callback, $component = null, $priority = 10, $accepted_args = 1 ) {

    $this->actions = $this->queue( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
  }

  public function addFilter( $hook, $callback, $component = null, $priority = 10, $accepted_args = 1 ) {

    $this->filters = $this->queue( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
  }

  public function queue( ...$args ) {
    
    list( $queue, $hook, $component, $callback, $priority, $acceptedArgs ) = $args;
    
    $args = new \stdClass;

    $args->hook = $hook;
    $args->callback = ( $component !== null ? [ $component, $callback ] : $callback );
    $args->priority = $priority;
    $args->accepted = $acceptedArgs;

    $queue[] = $args;

    return $queue;
  }

  public function load(): void {

    array_map( function ( $args ) {

      add_action( $args->hook, $args->callback, $args->priority, $args->accepted );
    }, $this->actions );
    
    array_map( function ( $args ) {

      add_filter( $args->hook, $args->callback, $args->priority, $args->accepted  );
    }, $this->filters );
  }
}