<?php

namespace WpTheme\Scaffold\Framework;

use WpTheme\Scaffold\Framework\Utilities as Util;

use Illuminate\Container\Container;

$themeroot = get_template_directory();

require $themeroot . '/vendor/autoload.php';

$container = Container::getInstance();

/**
 * WP Singleton Bindings
 */
$container->bind( \WP_Theme::class, function ( $container ) {

  return \wp_get_theme( \get_template() );
}, true );

$container->bind( \WP_Scripts::class, function ( $container ) {

  return \wp_scripts();
}, true );

$container->bind( \WP_Styles::class, function ( $container ) {

  return \wp_styles();
}, true );

/**
 * Theme Services
 */
$directory = $themeroot . '/src/Framework/Services';

Util::directoryIterator( $directory, function ( $service ) use ( $container ) {

  $container->singleton( $service->qualifiedname );
});

$container->singleton( 'theme', WpTheme\Scaffold\Framework\Theme::class );

// $directory = $themeroot . 'src/App/Providers';

// Util::directoryIterator( $directory, function ( $provider ) use ( $container ) {

//   $
// });

/**
 * Theme Options
 */
$container->bind( \WpTheme\Scaffold\App\Options\ThemeOption::class );

$container
  ->when( \WpTheme\Scaffold\App\Options\ThemeOption::class )
  ->needs('$name')
  ->give( 'theme_option' );

$container
  ->when( \WpTheme\Scaffold\App\Options\ThemeOption::class )
  ->needs('$capability')
  ->give( 'edit_themes' );

/**
 * Register Options
 */
$directory = $themeroot . '/src/App/Options';

Util::directoryIterator( $directory, function ( $option ) use ( $container ) {

  $container->singleton( $option->name, $option->qualifiedname );
});

/**
 * Run All Hooks
 */
$directory = $themeroot . '/src/App/Hooks';

Util::directoryIterator( $directory, function ( $hook ) use ( $container ) {

  $hook = $container->make( $hook->qualifiedname );

  $hook->register();
});
