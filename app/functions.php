<?php

/**
 * Functions and definitions
 * 
 * @package
 */

var_dump('<pre>', ABSPATH . 'wp-content/themes/My-THEME', '</pre>');
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
