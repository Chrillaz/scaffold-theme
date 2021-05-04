<?php

namespace WpTheme\Scaffold;

use \Essentials\Essentials;

use \Essentials\Utilities as Util;

require __DIR__ . '/../vendor/autoload.php';

if ( ! class_exists( \Essentials\Essentials::class ) ) {
  
}

$app = Essentials::create([
  'namespace' => '\\WpTheme\\Scaffold',
  'basepath'  => \get_template_directory(),
  'baseuri'   => \get_template_directory_uri() 
]);

$app->singleton( Essentials::class, function ( $container ) {
  
  return $container;
});

$app->setConfig( require __DIR__ . '/Config.php' );

$app->extend( \WpTheme\Scaffold\Theme::class, function ( $client, Essentials $container ) {

  return new $client( \wp_get_theme( \get_template() ), $container );
});

$app->singleton( \WpTheme\Scaffold\Theme::class );

Util::directoryIterator( $app->getNamespace(), $app->getBasepath( '/src/Hooks/' ), function ( $hook ) use ( $app ) {

  $hook = $app->make( $hook->qualifiedname );

  $hook->register();
});

return $app;