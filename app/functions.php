<?php

/**
 * Functions and definitions
 * 
 * @package
 */

define('THEME_VERSION', '1.0.0');
define('THEME_NAME', 'THEME NAME');

/**
 * Enqueue scripts and styles.
 */
add_action('wp_enqueue_scripts', function () {

  wp_enqueue_style('style', get_stylesheet_uri());

  wp_enqueue_style( 'dashicons' );

  wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.min.js', null, THEME_VERSION, true);
}, 100);