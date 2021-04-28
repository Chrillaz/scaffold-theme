<?php

namespace WpTheme\Scaffold\App\Hooks;

use WpTheme\Scaffold\Core\Theme;

use WpTheme\Scaffold\Core\Abstracts\Hooks;

use WpTheme\Scaffold\App\Options\ThemeOption;

use WpTheme\Scaffold\App\Services\HookLoader;

final class SetupTheme extends Hooks {

  protected $hooks;

  protected $theme;

  protected $options;

  public function __construct ( HookLoader $hooks, Theme $theme, ThemeOption $options ) {

    $this->hooks = $hooks;

    $this->theme = $theme;

    $this->options = $options;
  }

  private function doScheme ( array $schema ): array {

    return array_map( function ( $item ) use ( $schema ) {

      $keys = explode( '.', $item, 2 );

      if ( is_array( $keys ) && isset( $keys[1] ) ) {
        
        return [
          'name'   => __( \ucfirst( str_replace( '-', ' ', $keys[1] ) ), $this->theme->getHeader( 'TextDomain' ) ),
          'slug'   => $keys[1],
          $keys[0] => $this->options->get( $item )
        ];
      }
    }, array_keys( $schema ) );
  }
  
  public function setupTheme () {

    \load_theme_textdomain( $this->theme->getHeader( 'TextDomain' ) );
    
    \add_theme_support( 'title-tag' );
    
    \add_theme_support( 'post-thumbnails' );
    
    \register_nav_menus( [
      'primary' => __( 'Primary', $this->theme->getHeader( 'TextDomain' ) ),
      'social'  => __( 'Social Links Menu', $this->theme->getHeader( 'TextDomain' ) )
    ]);

    \add_theme_support('html5', [
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
    ]);
    
    // \set_post_thumbnail_size( $width:integer, $height:integer, $crop:boolean|array );
        
    \add_theme_support( 'custom-logo', [] );
    
    // \add_image_size( $name:string, $width:integer, $height:integer, $crop:boolean|array )

    if ( '1' === $this->options->get( 'block-styles' ) ) {
    
      \add_theme_support( 'wp-block-styles' );
    }
    
    if ( '1' === $this->options->get( 'align-wide' ) ) {
    
      \add_theme_support( 'align-wide' );
    }
    
    if ( '1' === $this->options->get( 'responsive-embeds' ) ) {
          
      \add_theme_support( 'responsive-embeds' );
    }
    
    if ( '1' === $this->options->get( 'editor-styles' ) ) {
        
      \add_theme_support( 'editor-styles' );
    }
    
    if ( '1' !== $this->options->get( 'disable-custom-colors' ) ) {
        
      \add_theme_support( 'disable-custom-colors' );
    }
    
    if ( '1' !== $this->options->get( 'disable-custom-gradients' ) ) {
          
      \add_theme_support( 'disable-custom-gradients' );
    }

    if ( '1' !== $this->options->get( 'disable-custom-font-sizes' ) ) {

      \add_theme_support( 'disable-custom-font-sizes' );
    }

    \add_theme_support( 'editor-color-palette', $this->doScheme( $this->options->getGroup( 'color' ) ) );
  }

  public function register(): void {

    $this->hooks->addAction( 'after_setup_theme', 'setupTheme', $this );

    $this->hooks->load();
  }
}