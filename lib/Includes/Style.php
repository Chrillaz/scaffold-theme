<?php

namespace Theme\Scaffold\Includes;

use Theme\Scaffold\Interfaces\IAsset;

class Style implements IAsset {

  private $src;

  private $deps;
  
  private $handle;

  private $version;

  private $args;
  
  private $register;

  public function __construct ( string $handle, array $args ) {

    $this->enqueue = true;

    $this->handle = $handle;

    $this->src = get_template_directory_uri() . '/assets/css/' . $args['file'];

    $this->version = filemtime( get_template_directory() . '/assets/css/' . $args['file'] );

    $this->deps = ( isset( $args['dependencies'] ) ? $args['dependencies'] : [] );

    $this->args = ( isset( $args['media'] ) ? $args['media'] : 'all' );
  }

  public function remove (): Style {

    $this->enqueue = false;

    return $this;
  }

  public function inline ( string $text ): Style {

    $this->inline = $text;

    return $this;
  }

  public function enqueue (): void {

    $wpstyles = wp_styles();
    
    if ( isset( $wpstyles->registered[$this->handle] ) && ! $this->enqueue ) {

      $wpstyles->dequeue( $this->handle );

      return;
    }

    if ( ! isset( $wpstyles->registered[$this->handle] ) ) {

      $wpstyles->add( $this->handle, $this->src, $this->deps, $this->version, $this->args );

      $wpstyles->add_data( $this->handle, 'group', 1 );
    }
    
    if ( isset( $this->inline ) && ! empty( $this->inline ) ) {

      $wpstyles->wp_add_inline_style( $this->handle, $this->inline );
    }

    $wpstyles->enqueue( $this->handle );
  }
}