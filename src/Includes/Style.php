<?php

namespace Chrillaz\WPScaffold\Includes;

use Chrillaz\WPScaffold\Theme;

class Style extends Theme {

  public $handle;

  public $uri;

  public $dependencies;

  public $version;

  public $media;

  public function __construct ( $handle, $args ) {

    $src = $this->src( $args['src'] );

    $this->handle = $handle;

    $this->uri = $src->uri;

    $this->dependencies = ( ! isset( $args['dependencies'] ) ? [] : $args['dependencies'] );

    $this->version = filemtime( $src->path );

    $this->media = ( isset( $args['media'] ) ? $args['media'] : 'all' );
  }
}