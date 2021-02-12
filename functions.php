<?php

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
 * Add public scripts and styles
 */
if ( ! function_exists( 'publicAssets' ) ) {

  function publicAssets ( $assets ) {

    $assets->script( 'main', 'main.min.js' )->dependencies()->load( 'defer' )->enqueue();
  }
}

/**
 * Run theme
 */
// $theme->run();
