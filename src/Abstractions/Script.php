<?php

namespace WPTheme\Scaffold\Abstractions;

class Script {

  private $src;

  private $handle;

  private $version;

  private $dependencies = [];

  private $context = 'footer';

  private $execution;

  private $localized;

  private $dequeue = false;

  public function __construct ( $handle, $src ) {

    $this->handle = $handle;

    $this->src = get_stylesheet_directory_uri() . '/assets/js/' . trim( $src );

    $this->version = filemtime( get_stylesheet_directory() . '/assets/js/' . trim( $src ) );
  }

  public function dependencies ( ...$dependencies ) {

    $this->dependencies = $dependencies;

    return $this;
  }

  public function load ( $exec ) {

    $exec = trim( $exec );

    if ( in_array( $exec, array( 'defer', 'async' ) ) ) {

      $this->execution = $exec;
    }

    return $this;
  }

  public function localize ( $handle, $data ) {

    $this->localize = array(
      'handle' => $handle,
      'data'   => $data
    );

    return $this;
  }

  public function inline ( $handle, $inline ) {

    $this->inline = array(
      'handle' => $handle,
      'inline' => $inline
    );

    return $this;
  }

  public function context ( $context ) {

    $this->context = trim( $context ) === 'footer';

    return $this;
  }

  public function remove () {

    $this->dequeue = true;

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

      if ( $this->context === 'footer' ) {

        $wp->add_data( $this->handle, 'group', 1 );
      }
    }

    if ( isset( $this->inline ) && is_array( $this->inline ) && $wp->registered[$this->inline['handle']] ) {

      $wp->add_inline_script( $this->inline['handle'], $this->inline['inline'] );
    }

    if ( isset( $this->localized ) && is_array( $this->localized ) && $wp->registered[$this->localized['handle']] ) {

      $wp->localize( $this->localized['handle'], $this->localized['data'] );
    }

    if ( isset( $this->execution ) && $wp->registered[$this->handle] ) {

      $wp->add_data( $this->handle, 'script_execution', $this->execution );
    }

    $wp->enqueue( $this->handle );
  }
}