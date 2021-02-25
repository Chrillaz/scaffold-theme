<?php

use WPTheme\Scaffold\Providers\Context;

/**
 * Load composer autoload.php
 */
if ( ! file_exists( $autoload = __DIR__ . '/vendor/autoload.php' ) ) {

  wp_die( __( 'Please run composer install or composer dump-autoload to generate composer vendor folder.', wp_get_theme()->get( 'TextDomain') ), 'Can not find composer autoload.php', [
    'response'  => 403,
    'back_link' => get_admin_url( 'admin.php?page=themes' )
  ]);
}

require $autoload;

/**
 * Bootstrap Theme
 */
$theme = new WPTheme\Scaffold\Theme();

/**
 * publicAssets
 * 
 * enqueue public assets
 * 
 * @param Assets $assets
 */
add_action( 'scaffold/public_assets', function ( $assets ) {

  $assets->style( 'main', 'style.css' )->inline( Context::use( 'cssVars' ) )->enqueue();

  $assets->script( 'main', 'main.min.js' )->load( 'defer' )->enqueue();
});

/**
 * Custom setup on after_setup_theme hook
 * 
 * @param Theme $theme
 */
// add_action( 'scaffold/setup', function ( $theme ) {

// });
