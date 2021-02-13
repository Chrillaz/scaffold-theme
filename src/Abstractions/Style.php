<?php

namespace WPTheme\Scaffold\Abstractions;

class Style {

  private $src;

  private $handle;

  private $version;

  private $dependencies = [];

  private $media = 'all';

  private $dequeue = false;

  public function __construct ( $handle, $src ) {

    $this->handle = $handle;

    $this->src = get_stylesheet_directory_uri() . '/assets/css/' . trim( $src );

    $this->version = filemtime( get_stylesheet_directory() . '/assets/css/' . trim( $src ) );
  }

  public function dependencies ( ...$dependencies ) {

    $this->dependencies = $dependencies;

    return $this;
  }

  public function inline ( $inline, $handle = null ) {

    $this->inline = array(
      'handle' => ( $handle === null ? $this->handle : $handle ),
      'inline' => $inline
    );

    return $this;
  }

  public function media ( $media ) {

    $this->media = trim( $media );

    return $this;
  }

  public function remove () {

    $this->dequeue = true;

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

    if ( isset( $this->inline ) && is_array( $this->inline ) && $wp->registered[$this->inline['handle']] ) {

      $wp->add_inline_style( $this->inline['handle'], $this->inline['inline'] );
    }

    $wp->enqueue( $this->handle );
  }
}