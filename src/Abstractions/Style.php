<?php

namespace WPTheme\Scaffold\Abstractions;

use WPTheme\Scaffold\Interfaces\AbstractResource;

class Style extends AbstractResource {

  private $media = 'all';

  public function __construct ( $handle, $src ) {
    
    $this->init( $handle, $src );
  }

  public function media ( $media ) {

    $this->media = trim( $media );

    return $this;
  }

  public function enqueue () {

    $wp = wp_styles();

    if ( $this->dequeue ) {

      $wp->dequeue( $this->handle );

      return;
    }

    if ( ! isset( $wp->registered[$this->handle] ) ) {

      $wp->add( $this->handle, $this->src, $this->dependencies, $this->version, $this->media );
    }

    if ( isset( $this->inline ) && $wp->registered[$this->handle] ) {

      $wp->add_inline_style( $this->handle, $this->inline );
    }

    $wp->enqueue( $this->handle );
  }
}