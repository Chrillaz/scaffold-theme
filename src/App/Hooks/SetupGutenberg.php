<?php

namespace WpTheme\Scaffold\App\Hooks;

use WpTheme\Scaffold\Framework\Theme;

use WpTheme\Scaffold\App\Options\ThemeOption;

use WpTheme\Scaffold\Framework\Abstracts\Hooks;

use WpTheme\Scaffold\Framework\Services\HookLoader;

final class SetupGutenberg extends Hooks {

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

      return [
        'name'   => __( \ucfirst( str_replace( '-', ' ', $keys[1] ) ), $this->theme->getHeader( 'TextDomain' ) ),
        'slug'   => $keys[1],
        $keys[0] => $this->options->get( $item )
      ];
    }, array_keys( $schema ) );
  }

  public function setupGutenberg () {

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

  public function register (): void {

    $this->hooks->addAction( 'after_setup_theme', 'setupGutenberg', $this );

    $this->hooks->load();
  }
}