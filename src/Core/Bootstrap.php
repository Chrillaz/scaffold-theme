<?php

namespace WpTheme\Scaffold\Core;

use WpTheme\Scaffold\Core\Theme;

use WpTheme\Scaffold\Core\Utilities as Util;

define( 'THEME_ROOT', get_template_directory() );

define( 'APP_DIR', THEME_ROOT . '/src/App' );

define( 'CORE_DIR', THEME_ROOT . '/src/Core' );

require THEME_ROOT . '/vendor/autoload.php';

$theme = Theme::create( \wp_get_theme( \get_template() ) );

$theme->singleton( Theme::class, function ( $theme ) {

  return $theme;
});

/**
 * Store config
 */
$config = require APP_DIR . '/Config.php';

array_map( function ( $key, $config ) use ( $theme ) {

  return $theme->instance( $key, $config );
}, 
  array_keys( $config ),
  $config
);

/**
 * Bind modules
 */
array_map( function ( $module, $implementation ) use ( $theme ) {

  if ( $implementation instanceof \Closure ) {

    return $theme->bind( $module, function ( $theme ) use ( $implementation ) {

      return $implementation();
    });
  }

  return $theme->bind( $module, $implementation );
}, 
  array_keys( $theme['theme.bindings'] ),
  $theme['theme.bindings'] 
);

/**
 * Theme Services
 */
Util::directoryIterator( APP_DIR . '/Services', function ( $service ) use ( $theme ) {

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
  // APP_DIR . '/Integrations',
  APP_DIR . '/Hooks'
]);

return $theme;