<?php

namespace WpTheme\Scaffold\Framework\Services;

final class Hook {

  public $event;

  public $callback;

  public $priority;

  public $numargs;

  public function set ( array $args ) {

    list ( $event, $callback, $component, $priority, $numargs ) = array_pad( $args, 5, null );
    
    if ( $event === '' ) return $this;

    $this->event = $event;

    $this->callback = ( is_object( $component ) ? [$component, $callback] : $callback );

    if ( is_int( $component ) ) {

      $this->priority = $component;

      $this->numargs = $priority;
    } else {

      $this->priority = ( $priority === null ? 10 : $priority );
  
      $this->numargs = ( $numargs === null ? 1 : $numargs );
    }

    return $this;
  }
}