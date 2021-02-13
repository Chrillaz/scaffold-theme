<?php

namespace WPTheme\Scaffold\Integrations;

use WPTheme\Scaffold\Interfaces\Integration;

class BlockEditor implements Integration {

  private $theme;

  public function __construct( $theme ) {

    $this->theme = $theme;

    add_action( 'after_setup_theme', [ $this, 'setup'] );

    add_action( 'enqueue_block_assets', [ $this, 'blockAssets' ] );
  }

  private function doScheme ( $schema ) {

    return array_map( function ( $item ) use ( $schema ) {

      $keys = explode( '.', $item, 2 );

      return [
        'name'   => __( \ucfirst( str_replace( '-', ' ', $keys[1] ) ), $this->theme->get( 'TextDomain' ) ),
        'slug'   => $keys[1],
        $keys[0] => $schema[$item]
      ];
    }, array_keys( $schema ) );
  }

  public function blockAssets () {

    $this->theme->assets()->script( 'theme-editor-scripts', 'editor.min.js' )->dependencies( 'wp-block', 'wp-hooks' )->enqueue();

    if ( true === $this->theme->settings()->get( 'editor-styles' ) ) {

      $this->theme->assets()->style( 'theme-editor-css', 'editor-styles.css' )->inline( $this->theme->assets()->getCSSVars() )->enqueue();
    }
  }

  public function setup () {

    if ( true === $this->theme->settings()->get( 'block-styles' ) ) {
    
      add_theme_support( 'wp-block-styles' );
    }
    
    if ( true === $this->theme->settings()->get( 'align-wide' ) ) {
    
      add_theme_support( 'align-wide' );
    }
    
    if ( true === $this->theme->settings()->get( 'responsive-embeds' ) ) {
          
      add_theme_support( 'responsive-embeds' );
    }
    
    if ( true === $this->theme->settings()->get( 'editor-styles' ) ) {
        
      add_theme_support( 'editor-styles' );
    }
    
    if ( true === $this->theme->settings()->get( 'disable-custom-colors' ) ) {
        
      add_theme_support( 'disable-custom-colors' );
    }
    
    if ( true === $this->theme->settings()->get( 'disable-custom-gradients' ) ) {
          
      add_theme_support( 'disable-custom-gradients' );
    }
    
    add_theme_support( 'editor-color-palette', $this->doScheme( $this->theme->settings()->collect( 'color-palette' ) ) );
            
    if ( true === $this->theme->settings()->get( 'disable-custom-font-sizes' ) ) {
        
      add_theme_support( 'disable-custom-font-sizes' );
    }
  }
}