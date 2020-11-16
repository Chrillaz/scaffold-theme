<?php

use function Chrillaz\asset;

if ( ! file_exists( $autoload = __DIR__ . '/vendor/autoload.php' ) ) {

  wp_die( __( '', wp_get_theme()->get( 'TextDomain' ) ) );
}

require $autoload;

$theme = new Chrillaz\Bootstrap();

/**
 * Add scripts and styles
 */
add_action( 'wp_enqueue_scripts', function () use ( $theme ) {

  wp_register_script( 'theme', asset( '/js/main.min.js' )->uri, [], filemtime( asset( '/js/main.min.js' )->abspath ), true );
  wp_script_add_data( 'theme', 'script_execution', 'defer' );
  wp_enqueue_script( 'theme' );

  // wp_enqueue_style( $handle:string, $path . '/css/...', $deps:array, filemtime( $path . '/css/...' ), $media:string );
});