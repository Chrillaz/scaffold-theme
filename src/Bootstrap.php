<?php

namespace WpTheme\Scaffold;

use WpTheme\Scaffold\Theme;

use WpTheme\Scaffold\Container;

use WpTheme\Scaffold\Services\Hooks;

use WpTheme\Scaffold\Services\FlatStorage;

use WpTheme\Scaffold\Services\ThemeOptions;

use WpTheme\Scaffold\Providers\ProviderRegistrar;

if ( ! \file_exists( $autoload = SCAFFOLD_ROOT_DIR . '/vendor/autoload.php' ) ) {

  \wp_die( __( 'Please run composer install or composer dump-autoload to generate composer vendor folder.', \wp_get_theme()->get( 'TextDomain') ), 'Can not locate composer autoload.php', [
    'response'  => 403,
    'back_link' => get_admin_url( 'admin.php?page=themes' )
  ]);
}

require $autoload;

if ( ! \file_exists( $settings = SCAFFOLD_ROOT_DIR . '/settings.json' ) ) {

  \wp_die( __( 'Please provide a settings.json in root of project.', \wp_get_theme()->get( 'TextDomain') ), 'Can not locate settings.json', [
    'response'  => 403,
    'back_link' => get_admin_url( 'admin.php?page=themes' )
  ]);
}

$settings = \json_decode( \file_get_contents( $settings ), true );

$storage = new FlatStorage();

$container = new Container( $storage );

$container->set( 'ThemeOptions', function ( $self ) use ( $settings ) {

  return new ThemeOptions(
    'theme_options',
    new FlatStorage( $settings['settings'] )
  );
});

Theme::getInstance( \wp_get_theme( \get_template() ), $container );

/**
 * Register WP events
 */
$providers = include( __DIR__ . '/Providers/Config.php' );

$registrar = new ProviderRegistrar();

$hooks = new Hooks( $providers );

foreach ( $hooks->get( 'register' ) as $hook => $provider ) {

  $hooks->set( new $provider( $registrar, $hook ) );
  $hooks->run();
}