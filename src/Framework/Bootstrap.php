<?php

namespace WpTheme\Scaffold\Framework;

use WpTheme\Scaffold\Framework\Utilities as Util;

use WpTheme\Scaffold\Framework\Services\Storage;

use WpTheme\Scaffold\Framework\Container\Container;

$themeroot = get_template_directory();

require $themeroot . '/vendor/autoload.php';

$definitions = new Storage();

/**
 * Register Services
 */
$directory = $themeroot . '/src/Framework/Services';

Util::directoryIterator( $directory, function ( $service ) use ( $definitions ) {

  $definitions->set( $service->name, $service->qualifiedname );
});

/**
 * Register Options
 */
$directory = $themeroot . '/src/App/Options';

Util::directoryIterator( $directory, function ( $option ) use ( $definitions ) {

  $definitions->set( $option->name, $option->qualifiedname );
});

/**
 * Register Meta
 */
// $directory = $themeroot . '/src/App/Mete';

// Util::directoryIterator( $directory, function ( $meta ) use ( $definitions ) {

//   $definitions->set( $meta->name, $meta->qualifiedname );
// });

/** 
 * Register Providers 
 */
$directory = $themeroot . '/src/App/Providers';

Util::directoryIterator( $directory, function ( $provider ) use ( $definitions ) {

  $definitions->set( $provider->name, $provider->qualifiedname );
});

/**
 * Register Singletons
 */
$singletons = new Storage();

$singletons->set( 'Theme', 'WpTheme\\Scaffold\\Framework\\Theme'::class );

$singletons->set( 'Container', 'WpTheme\\Scaffold\\Framework\\Container\\Container'::class );

/**
 * Instantiate Container
 */
$container = Container::getInstance( $definitions, $singletons );

/**
 * Register All Hooks
 */
$directory = $themeroot . '/src/App/Hooks';

Util::directoryIterator( $directory, function ( $hook ) use ( $container ) {

  $hook = $container->resolve( $hook->qualifiedname );

  $hook->register();
});