<?php

namespace WpTheme\Scaffold\Framework;

use WpTheme\Scaffold\Framework\Theme;

use WpTheme\Scaffold\Framework\Utilities as Util;

$themeroot = get_template_directory();

require $themeroot . '/vendor/autoload.php';

$theme = new Theme( \wp_get_theme( \get_template() ) );

/**
 * WP Singleton Bindings
 */
$theme->bind( \WP_Theme::class, function ( $theme ) {

  return \wp_get_theme( \get_template() );
});

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

// // $directory = $themeroot . 'src/App/Providers';

// // Util::directoryIterator( $directory, function ( $provider ) use ( $theme ) {

// //   $
// // });

/**
 * Theme Options
 */
$theme->bind( \WpTheme\Scaffold\App\Options\ThemeOption::class );

$theme
  ->when( \WpTheme\Scaffold\App\Options\ThemeOption::class )
  ->needs('$name')
  ->give( 'theme_option' );

$theme
  ->when( \WpTheme\Scaffold\App\Options\ThemeOption::class )
  ->needs('$capability')
  ->give( 'edit_themes' );

// /**
//  * Register Options
//  */
// $directory = $themeroot . '/src/App/Options';

// Util::directoryIterator( $directory, function ( $option ) use ( $theme ) {

//   $theme->singleton( $option->name, $option->qualifiedname );
// });

/**
 * Run All Hooks
 */
$directory = $themeroot . '/src/App/Hooks';

Util::directoryIterator( $directory, function ( $hook ) use ( $theme ) {

  $hook = $theme->make( $hook->qualifiedname );

  $hook->register();
});

class Test {

  public $theme;

  public function __construct( \WP_Theme $theme ) {

    $this->theme = $theme;
  }
}
var_dump('<pre>', \wp_get_theme( \get_template() ) === ($theme->make(Test::class))->theme, '</pre>');

return $theme;