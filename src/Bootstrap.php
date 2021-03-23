<?php

namespace WpTheme\Scaffold;

use WpTheme\Scaffold\Theme;

use WpTheme\Scaffold\ServiceContainer;

use WpTheme\Scaffold\Services\Commander;

use WpTheme\Scaffold\Services\FlatStorage;

use WpTheme\Scaffold\Providers\ProviderRegistrar;

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

$storage = new FlatStorage();

$defaults = json_decode( file_get_contents( TEMPLATEPATH . '/settings.json' ), true );

$storage->update( 'settings', $defaults['settings'] );

Theme::getInstance( 
  \wp_get_theme( \get_template() ),
  $storage
);

/**
 * Sets and unsets the wp actions/filters
 * Maps to Providers namespace.
 */
require __DIR__ . '/Providers/Config.php';

$command = new Commander();
$registrar = new ProviderRegistrar();

foreach ( $providers['unregister'] as $hook => $provider ) {
      
  $registrar->remove( $hook, $provider );
}

foreach ( $providers['register'] as $hook => $provider ) {

  $command->setCommand( new $provider( $registrar, $hook ) );
  $command->run();
}