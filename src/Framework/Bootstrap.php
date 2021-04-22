<?php

namespace WpTheme\Scaffold\Framework;

use WpTheme\Scaffold\Framework\Utilities as Util;

use WpTheme\Scaffold\Framework\Resources\Storage;

use WpTheme\Scaffold\Framework\Container\{
  Container,
  Reflector,
  ContextResolution
};

$themeroot = get_template_directory();

require $themeroot . '/vendor/autoload.php';

$config = new Storage( require $themeroot . '/src/Framework/Container/WpBindings.php' );

$contextResolution = new ContextResolution( $config );

$reflector = new Reflector( $contextResolution );

$container = Container::create( $reflector );

$container->bind( 'theme', \WpTheme\Scaffold\Framework\Theme::class, true );

/** 
 * Register Providers 
 */
$directory = $themeroot . '/src/App/Providers';

Util::directoryIterator( $directory, function ( $provider ) use ( $container ) {

  $container->bind( $provider->name, $provider->qualifiedname, true );
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
