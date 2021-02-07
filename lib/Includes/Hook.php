<?php

namespace Theme\Scaffold\Includes;

if ( ! defined( 'ABSPATH' ) ) exit;

class Hook {

  public $event;

  public $callback;

  public $priority;

  public $numargs;

  public function __construct ( array $args ) {
    
    list ( $event, $callback, $component, $priority, $numargs ) = array_pad( $args, 5, null );
    
    if ( $event === '' ) return;

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