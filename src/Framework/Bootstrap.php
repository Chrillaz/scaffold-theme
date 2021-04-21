<?php

namespace WpTheme\Scaffold\Framework;

use WpTheme\Scaffold\Framework\Utilities as Util;

use WpTheme\Scaffold\Framework\Container\Container;


$themeroot = get_template_directory();

require $themeroot . '/vendor/autoload.php';

$container = Container::create();

$container->bind( 'theme', \WpTheme\Scaffold\Framework\Theme::class, true );

/** 
 * Register Providers 
 */
$directory = $themeroot . '/src/App/Providers';

Util::directoryIterator( $directory, function ( $provider ) use ( $container ) {

  $container->bindDefinition( str_replace( 'Provider', '', $provider->name ), $provider->qualifiedname );
});


/**
 * Register Options
 */
$directory = $themeroot . '/src/App/Options';

Util::directoryIterator( $directory, function ( $option ) use ( $container ) {

  $container->bind( $option->name, $option->qualifiedname, true );
});


/**
 * Run All Hooks
 */
$directory = $themeroot . '/src/App/Hooks';

Util::directoryIterator( $directory, function ( $hook ) use ( $container ) {

  $hook = $container->make( $hook->qualifiedname );

  $hook->register();
});
