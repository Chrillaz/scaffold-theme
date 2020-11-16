<?php

namespace Chrillaz;

if ( ! function_exists( 'asset' ) ) {

  function asset ( $rel_path, $load = false, $require_once = false, $args = [] ) {

    if ( ! file_exists( $file = get_template_directory() . $rel_path ) ) {

      wp_die( __( 'Can not locate ' . $rel_path, 'noortheme' ) );
    }
    
    $paths = new \stdClass();

    $paths->abspath = $file;
    $paths->uri = get_template_directory_uri() . $rel_path;
    $paths->contents = json_decode( file_get_contents( locate_template( $rel_path, $load, $require_once, $args ) ), true );

    return $paths;
  }
}