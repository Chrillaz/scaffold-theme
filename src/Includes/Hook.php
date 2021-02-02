<?php

namespace Chrillaz\WPScaffold\Includes;

class Hook {

  public $event;

  public $callback;

  public $priority;

  public $numargs;

  public function __construct ( $args ) {
    
    list ( $event, $callback, $component, $priority, $numargs ) = array_pad( $args, 5, null );

    if ( $event === '' ) return;

    $this->event = $event;

    $this->callback = ( $component !== null ? [$component, $callback] : $callback );

    $this->priority = ( $priority === null ? 10 : $priority );

    $this->numargs = ( $numargs === null ? 1 : $numargs );

    return $this;
  }
}