<?php

if ( ! file_exists( $autoload = __DIR__ . '/vendor/autoload.php' ) ) {

  wp_die( __( '', wp_get_theme()->get( 'TextDomain' ) ) );
}

require $autoload;

$theme = new Chrillaz\Bootstrap();

/**
 * Add scripts and styles
 * 
 * Receives get_template_directory_uri() . '/assets
 * 
 * @param string $path
 * 
 * @param strinng $version
 * 
 * @return void
 */
$theme->addScripts( function ( $path, $version ) {
  
  // wp_register_script( $handle:string, $path . '/js/...', $deps:array, filemtime( $path . '/js/...' ), $in_footer:boolean );
  // wp_script_add_data( $handle:string, $script_execution:string|script_execution, $attr:string|async|defer );
  // wp_enqueue_script( $handle:string );

  // wp_enqueue_style( $handle:string, $path . '/css/...', $deps:array, filemtime( $path . '/css/...' ), $media:string );
});