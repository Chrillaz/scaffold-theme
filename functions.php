<?php

<<<<<<< HEAD
$theme = require __DIR__ . '/src/Framework/Bootstrap.php';
=======
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
 * Boot theme
 */
$theme = new Theme\Scaffold\Theme( get_template() );

/**
 * Load theme public assets
 */
$theme->assets()->add( 'public', function ( $asset ) {

  $asset->style( 'style', [
    'file' => 'style.css',
  ]);

  $asset->script( 'main', [
    'file' => 'main.min.js'
  ])->load( 'defer' );
});

/**
 * Load theme admin assets
 */
// $theme->assets()->add( 'admin', function ( $asset ) {

//   $asset->script();
// });

/**
 * Load theme editor assets
 */
// $theme->assets()->add( 'editor', function ( $asset ) {

//   $asset->script();
// });

/**
 * Load theme login assets
 */
// $theme->assets()->add( 'login', function ( $asset ) {

//   $asset->script();
// });


$theme->run();
>>>>>>> new
