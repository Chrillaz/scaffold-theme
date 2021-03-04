<?php

namespace WpTheme\Scaffold\Wrappers;

class Hook {

  public $event;

  public $callback;

  public $priority;

  public $numargs;

  public function __construct ( array $args ) {

    list ( $event, $callback, $object, $priority, $numargs ) = array_pad( $args, 5, null );

    if ( empty( $event ) ) return;

    $this->event = $event;

    $this->callback = ( $object !== null ? [$object, $callback] : $callback );

    $this->priority = ( $priority === null ? 10 : $priority );

    $this->numargs = ( $numargs === null ? 1 : $numargs );
  }
}