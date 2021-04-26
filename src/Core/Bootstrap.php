<?php

namespace WpTheme\Scaffold\Core;

use WpTheme\Scaffold\Core\Theme;

use WpTheme\Scaffold\Core\Utilities as Util;

define( 'THEME_ROOT', get_template_directory() );

define( 'APP_DIR', THEME_ROOT . '/src/App' );

define( 'CORE_DIR', THEME_ROOT . '/src/Core' );

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
  require CORE_DIR . '/Config.php',
  require APP_DIR . '/Config.php'
);

foreach ( $config as $key => $value ) {

  $theme->instance( $key, $value );
}

/**
 * Theme Services
 */
Util::directoryIterator( CORE_DIR . '/Services', function ( $service ) use ( $theme ) {

  $theme->singleton( $service->qualifiedname );
});

/**
 * Theme Options
 */
Util::directoryIterator( APP_DIR . '/Options', function ( $option ) use ( $theme ) {

  $theme->singleton( $option->qualifiedname, function ( $theme ) use ( $option ) {
    
    return $option->qualifiedname::register( $theme );
  });
});

/**
 * Theme Meta
 */
// Util::directoryIterator( APP_DIR . '/Metas', function ( $meta ) use ( $theme ) {

//   $theme->singleton( $meta->qualifiedname, function ( $theme ) use ( $meta ) {

//     return $meta->qualifiedname::register( $theme );
//   });
// });

/**
 * Run Core, App Hooks and Integrations
 */
array_map( function ( $directory ) use ( $theme ) {

  Util::directoryIterator( $directory, function ( $hook ) use ( $theme ) {

    $hook = $theme->make( $hook->qualifiedname );
  
    $hook->register();
  });
}, [
  APP_DIR . '/Integrations',
  CORE_DIR . '/Hooks',
  APP_DIR . '/Hooks'
]);

return $theme;