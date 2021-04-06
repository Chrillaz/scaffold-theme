<?php

namespace WpTheme\Scaffold\Framework;

use WpTheme\Scaffold\Framework\Utilities as Util;

use WpTheme\Scaffold\Framework\Services\Storage;

use WpTheme\Scaffold\Framework\Container\Container;

$themeroot = get_template_directory();

require $themeroot . '/vendor/autoload.php';

$definitions = new Storage();

/**
 * Register All Services
 */
$directory = $themeroot . '/src/Framework/Services';

Util::directoryIterator( $directory, function ( $service ) use ( $definitions ) {

  $definitions->set( $service->name, $service->qualifiedname );
});

/** 
 * Register All Providers 
 */
$directory = $themeroot . '/src/App/Providers';

Util::directoryIterator( $directory, function ( $provider ) use ( $definitions ) {

  $definitions->set( $provider->name, $provider->qualifiedname );
});


/**
 * Register Singletons
 */
$singletons = new Storage();

$singletons->set( 'Theme', 'WpTheme\\Scaffold\\App\\Theme'::class );

/**
 * Instantiate Container
 */
$container = Container::getInstance( $definitions, $singletons );

/**
 * Run All Hooks
 */
$directory = $themeroot . '/src/App/Hooks';

Util::directoryIterator( $directory, function ( $hook ) use ( $container ) {

  $hook = $container->resolve( $hook->qualifiedname );

  $hook->register();
});