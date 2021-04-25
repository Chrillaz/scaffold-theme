<?php

namespace WpTheme\Scaffold\Core;

use WpTheme\Scaffold\Core\Theme;

use WpTheme\Scaffold\Core\Utilities as Util;

$themeroot = get_template_directory();

require $themeroot . '/vendor/autoload.php';

$theme = Theme::create( \wp_get_theme( \get_template() ) );

$theme->singleton( Theme::class, function ( $theme ) {

  return $theme;
});

/**
 * WP Core Component Bindings
 */
$theme->bind( \WP_Scripts::class, function ( $theme ) {

  return \wp_scripts();
});

$theme->bind( \WP_Styles::class, function ( $theme ) {

  return \wp_styles();
});

/**
 * Store config
 */
$config = array_merge(
  require __DIR__ . '/Config.php',
  require __DIR__ . '/../App/Config.php'
);

foreach ( $config as $key => $value ) {

  $theme->instance( $key, $value );
}

/**
 * Theme Services
 */
$directory = $themeroot . '/src/Core/Services';

Util::directoryIterator( $directory, function ( $service ) use ( $theme ) {

  $theme->singleton( $service->qualifiedname );
});

/**
 * Theme Options
 */
$directory = $themeroot . '/src/App/Options';

Util::directoryIterator( $directory, function ( $option ) use ( $theme ) {

  $theme->singleton( $option->qualifiedname, function ( $theme ) use ( $option ) {
    
    return $option->qualifiedname::register( $theme );
  });
});

/**
 * Theme Integrations
 */
$directory = $themeroot . '/src/App/Integrations';

Util::directoryIterator( $directory, function ( $integration ) use ( $theme ) {

  $integration = $theme->make( $integration->qualifiedname );

  $integration->register();
});

/**
 * Run Core Hooks
 */
$directory = $themeroot . '/src/Core/Hooks';

Util::directoryIterator( $directory, function ( $hook ) use ( $theme ) {

  $hook = $theme->make( $hook->qualifiedname );

  $hook->register();
});

/**
 * Run App Hooks
 */
$directory = $themeroot . '/src/App/Hooks';

Util::directoryIterator( $directory, function ( $hook ) use ( $theme ) {

  $hook = $theme->make( $hook->qualifiedname );

  $hook->register();
});

return $theme;