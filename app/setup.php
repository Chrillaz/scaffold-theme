<?php

use \Theme\includes\{ Scripts_Loader, Route };

/**
 * Define template root to views folder
 */
add_filter( 'template_directory', function ( $template_dir, $template, $template_root ) {
  
  if ( defined( 'TEMPLATEPATH' ) && ! strpos( TEMPLATEPATH, THEME_TEMPLATE_DIR ) ) {

    wp_die( 'TEMPLATEPATH must be defined in wp-config.php, to point to ' . THEME_TEMPLATE_DIR . ' dir' );
  }

  return TEMPLATEPATH;

}, 10, 3);

// add_action( 'init', function () {

//   new Route( '/aktiviteter-umea' );
// });

/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', function () { 
  
  // Styles
  wp_enqueue_style( 'style', get_stylesheet_uri() );

  // Fonts
  wp_enqueue_style( 'fonts', printeach( THEME_FONT_MAP ), [], NULL );

  // Scripts
  Scripts_Loader::init( '/assets/js', THEME_VERSION, [
    'defer' => true,
    'omit_if_page' => [],
    'scripts' => ['main.min.js']
  ]);
}, 99 );

/**
 * Registers features support
 */
add_action( 'after_setup_theme', function () {

  add_theme_support( 'title-tag' );

  add_theme_support( 'post-thumbnails' );

  add_theme_support( 'custom-logo', [
    'height'      => 50,
    'width'       => 200,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => ['site-title', 'site-description']
  ]);

  register_nav_menus([
    'primary_navigation' => __( 'Primary Navigation', THEME_NAME ),
    'footer_navigation' => __( 'Footer Navigation', THEME_NAME )
  ]);
}, 0);
