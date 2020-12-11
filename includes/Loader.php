<?php

namespace Chrillaz;

class Loader {

  private $actions;

  private $filters;

  public function __construct () {

    $this->actions = [];

    $this->filters = [];
  }

  public function addAction( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {

    $this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
  }

  public function addFilter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {

    $this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
  }

  private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

    $hooks[] = [
      'hook'          => $hook,
      'component'     => $component,
      'callback'      => $callback,
      'priority'      => $priority,
      'accepted_args' => $accepted_args
    ];

    return $hooks;
  }

  public function run() {

    foreach ( $this->filters as $hook ) {

      add_filter( $hook['hook'], [ $hook['component'], $hook['callback'] ], $hook['priority'], $hook['accepted_args'] );
    }

    foreach ( $this->actions as $hook ) {

      add_action( $hook['hook'], [ $hook['component'], $hook['callback'] ], $hook['priority'], $hook['accepted_args'] );
    }
  }
}