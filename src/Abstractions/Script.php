<?php

namespace WPTheme\Scaffold\Abstractions;

use WPTheme\Scaffold\Interfaces\AbstractResource;

class Script extends AbstractResource {

  private $context = true;

  private $execution;

  private $localized;

  public function __construct ( $handle, $src ) {

    $this->init( $handle, $src );
  }

  public function load ( $exec ) {

    $exec = trim( $exec );

    if ( in_array( $exec, array( 'defer', 'async' ) ) ) {

      $this->execution = $exec;
    }

    return $this;
  }

  public function localize ( $name, $data ) {

    $this->localized = array(
      'name'   => $name,
      'data'   => $data
    );

    return $this;
  }

  public function context ( $context ) {

    $this->context = trim( $context ) === 'footer';

    return $this;
  }

  public function enqueue () {

    $wp = wp_scripts();

    if ( $this->dequeue ) {

      $wp->dequeue( $this->handle );

      return;
    }

    if ( ! isset( $wp->registered[$this->handle] ) ) {

      $wp->add( $this->handle, $this->src, $this->dependencies, $this->version );

      if ( $this->context ) {

        $wp->add_data( $this->handle, 'group', 1 );
      }
    }

    if ( isset( $this->inline ) && $wp->registered[$this->handle] ) {

      $wp->add_inline_script( $this->handle, $this->inline );
    }

    if ( isset( $this->localized ) && ! empty( $this->localized ) ) {

      $wp->localize( $this->handle, $this->localized['name'], $this->localized['data'] );
    }

    if ( isset( $this->execution ) && $wp->registered[$this->handle] ) {

      $wp->add_data( $this->handle, 'script_execution', $this->execution );
    }
    
    $wp->enqueue( $this->handle );
  }
}