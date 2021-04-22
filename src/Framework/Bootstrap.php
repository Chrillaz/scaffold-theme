<?php

namespace WpTheme\Scaffold\Framework;

use WpTheme\Scaffold\Framework\Theme;

use WpTheme\Scaffold\Framework\Utilities as Util;

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
 * Theme Services
 */
$directory = $themeroot . '/src/Framework/Services';

Util::directoryIterator( $directory, function ( $service ) use ( $theme ) {

  $theme->singleton( $service->qualifiedname );
}); 

/**
 * Theme Options
 */
$theme->singleton( \WpTheme\Scaffold\App\Options\ThemeOption::class, function ( $theme ) {

  $settings = \json_decode(
    \file_get_contents(
      \get_template_directory() . '/config/theme.json'
    ),
    true
  );

  return new \WpTheme\Scaffold\App\Options\ThemeOption(
    'theme_option',
    'edit_themes',
    $theme->make( \WpTheme\Scaffold\Framework\Resources\Storage::class, [
      'storage' => $settings['settings']
    ])
  );
});

/**
 * Run All Hooks
 */
$directory = $themeroot . '/src/App/Hooks';

Util::directoryIterator( $directory, function ( $hook ) use ( $theme ) {

  $hook = $theme->make( $hook->qualifiedname );

  $hook->register();
});

return $theme;