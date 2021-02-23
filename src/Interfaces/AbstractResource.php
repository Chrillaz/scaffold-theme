<?php

namespace WPTheme\Scaffold\Interfaces;

abstract class AbstractResource {

  protected $handle;

  protected $src;

  protected $version;

  protected $inline;

  protected $dependencies = [];

  protected $dequeue = false;

  protected function init ( $handle, $src ) {

    $this->handle = $handle;

    if ( $src !== null ) {

      $caller = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS, 3 );

      $this->src = get_stylesheet_directory_uri() . $this->directory( $caller ) . trim( $src );
  
      $this->version = filemtime( get_stylesheet_directory() . $this->directory( $caller ) . trim( $src ) );
    }
  }

  protected function directory ( $caller ) {

    return end( $caller )['function'] === 'style' ? '/assets/css/' : '/assets/js/';
  }

  public function dependencies ( ...$dependencies ) {

    $this->dependencies = $dependencies;

    return $this;
  }

  public function inline ( $inline ) {

    $this->inline = $inline;

    return $this;
  }

  public function remove () {

    $this->dequeue = true;

    return $this;
  }

  abstract public function enqueue ();
}