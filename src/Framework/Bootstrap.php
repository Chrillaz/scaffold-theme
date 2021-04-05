<?php

namespace WpTheme\Scaffold\Framework;

use WpTheme\Scaffold\Framework\Utilities as Util;

use WpTheme\Scaffold\Framework\Services\Storage;

use WpTheme\Scaffold\Framework\Container\Container;

$themeroot = get_template_directory();

require $themeroot . '/vendor/autoload.php';

/** 
 * Register All Providers 
 */
$providers = new Storage();

$directory = $themeroot . '/src/App/ServiceProviders';

Util::directoryIterator( $directory, function ( $provider ) use ( $providers ) {

  $providers->set( $provider->name, $provider->qualifiedname );
});

/**
 * Set Theme Facade Singleton
 */
$singletons = new Storage();

// $singletons->set( 'Theme', Theme::getInstance() );

$container = Container::getInstance( $providers, $singletons );

/**
 * Run All Hooks
 */
$directory = $themeroot . '/src/App/Hooks';

Util::directoryIterator( $directory, function ( $hook ) use ( $container ) {

  $hook = $container->resolve( $hook->qualifiedname );

  // $hook->register();
});