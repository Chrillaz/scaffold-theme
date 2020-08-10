<?php

/**
 * Functions and definitions
 * 
 * @package
 */

/**
 * Class autoloader
 */
require get_theme_file_path( 'includes/class-autoloader.php' );

new Autoloader( 'Theme', get_theme_file_path( DIRECTORY_SEPARATOR ) );

/**
 * Theme globals and settings
 */
require_once get_theme_file_path( 'settings/settings.php' );

/**
 * Define template root to views folder
 */
add_filter( 'template_directory', function ( $template_dir, $template, $template_root ) {
  var_dump('<pre>', 'HEJ', '</pre>');
  
  if ( defined( 'TEMPLATEPATH' ) && ! strpos( TEMPLATEPATH, 'wdwd' ) ) {

    wp_die( 'TEMPLATEPATH must be defined in wp-config.php, to point to ' . THEME_TEMPLATE_DIR . ' dir' );
  }
var_dump('<pre>', TEMPLATEPATH, '</pre>');
  return TEMPLATEPATH;

}, 10, 3);

/**
 * Define them template root
 * 
 * Enqueue theme assets
 * 
 * Register theme feature support
 */
require_once get_theme_file_path( 'setup.php' );

/**
 * Theme helper functions
 */
require_once get_theme_file_path( 'resources/helpers.php' );

/**
 * Theme template hooks
 */
require_once get_theme_file_path( 'resources/hooks.php' );

/**
 * Theme Filters
 */
require get_theme_file_path( 'resources/filters.php' );

/**
 * Theme Actions
 */
require get_theme_file_path( 'resources/actions.php' );

/**
 * Image Lazy loading
 * 
 * Intercepts images and sets lazy data attributes
 */
// LazyLoader::init();
