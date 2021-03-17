<?php
use WpTheme\Scaffold\Theme;

if ( ! file_exists( $autoload = __DIR__ . '/vendor/autoload.php' ) ) {

  wp_die( __( 'Please run composer install or composer dump-autoload to generate composer vendor folder.', wp_get_theme()->get( 'TextDomain') ), 'Can not find composer autoload.php', [
    'response'  => 403,
    'back_link' => get_admin_url( 'admin.php?page=themes' )
  ]);
}

require $autoload;

// require __DIR__ . '/src/Bootstrap.php';

$storage = new \WpTheme\Scaffold\Services\FlatStorage();

$container = new \WpTheme\Scaffold\Container( $storage );

$container->set( 'WpTheme\\Scaffold\\Services\\Option'::class );

Theme::getInstance( \wp_get_theme( \get_template() ), $container );