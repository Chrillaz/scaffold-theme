<?php

namespace Scaffold\Theme\Hooks;

use Scaffold\Theme\Options\ThemeOption;

use \Scaffold\Essentials\Abstracts\Hooks;

use \Scaffold\Essentials\Services\HookLoader;

final class SetupTheme extends Hooks {

  protected $hooks;

  protected $options;

  public function __construct( HookLoader $hooks, ThemeOption $options ) {

    $this->hooks = $hooks;

    $this->options = $options;
  }

  private function doScheme ( array $schema ): array {

    return array_map( function ( $item ) use ( $schema ) {

      $keys = explode( '.', $item, 2 );

      if ( is_array( $keys ) && isset( $keys[1] ) ) {
        
        return [
          'name'   => __( \ucfirst( str_replace( '-', ' ', $keys[1] ) ), Theme()->get( 'TextDomain' ) ),
          'slug'   => $keys[1],
          $keys[0] => $this->options->get( $item )
        ];
      }
    }, array_keys( $schema ) );
  }

  public function setup () {

    \load_theme_textdomain( Theme()->get( 'TextDomain' ) );
    
    \add_theme_support( 'title-tag' );
    
    \add_theme_support( 'post-thumbnails' );
    
    \register_nav_menus( [
      'primary' => __( 'Primary', Theme()->get( 'TextDomain' ) ),
      'secondary'  => __( 'Secondary', Theme()->get( 'TextDomain' ) )
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

    \add_theme_support( 'custom-logo', [] );

    \add_theme_support( 'core-block-patterns' );

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

      \add_editor_style( Theme()->publicPath( '/assets/css/editor-styles.css' ) );
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

  public function register (): void {

    $this->hooks->addAction( 'after_setup_theme', 'setup', $this );

    $this->hooks->load();
  }
}