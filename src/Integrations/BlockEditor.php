<?php

namespace WPTheme\Scaffold\Integrations;

use WPTheme\Scaffold\Interfaces\Integration;

use WPTheme\Scaffold\Providers\Context;

class BlockEditor implements Integration {

  private $theme;

  public function __construct( $theme ) {

    $this->theme = $theme;

    add_action( 'after_setup_theme', [ $this, 'setup'] );

    add_action( 'enqueue_block_editor_assets', [ $this, 'blockAssets' ] );
  }

  private function doScheme ( $schema ) {

    return array_map( function ( $item ) use ( $schema ) {

      $keys = explode( '.', $item, 2 );

      return [
        'name'   => __( \ucfirst( str_replace( '-', ' ', $keys[1] ) ), $this->theme->get( 'TextDomain' ) ),
        'slug'   => $keys[1],
        $keys[0] => $this->theme->mods()->use( $item )
      ];
    }, array_keys( $schema ) );
  }

  public function blockAssets () {

    $this->theme->assets()->script( 'theme-editor-scripts', 'editor-scripts.min.js' )->dependencies( 'wp-blocks', 'wp-hooks' )->enqueue();

    if ( true === $this->theme->mods()->use( 'editor-styles' ) ) {

      $this->theme->assets()->style( 'theme-editor-css', 'editor-styles.css' )->inline( Context::use( 'cssVars' ) )->enqueue();
    }
  }

  public function setup () {

    if ( true === $this->theme->mods()->use( 'block-styles' ) ) {
    
      add_theme_support( 'wp-block-styles' );
    }
    
    if ( true === $this->theme->mods()->use( 'align-wide' ) ) {
    
      add_theme_support( 'align-wide' );
    }
    
    if ( true === $this->theme->mods()->use( 'responsive-embeds' ) ) {
          
      add_theme_support( 'responsive-embeds' );
    }
    
    if ( true === $this->theme->mods()->use( 'editor-styles' ) ) {
        
      add_theme_support( 'editor-styles' );
    }
    
    if ( true === $this->theme->mods()->use( 'disable-custom-colors' ) ) {
        
      add_theme_support( 'disable-custom-colors' );
    }
    
    if ( true === $this->theme->mods()->use( 'disable-custom-gradients' ) ) {
          
      add_theme_support( 'disable-custom-gradients' );
    }
    
    add_theme_support( 'editor-color-palette', $this->doScheme( $this->theme->settings()->get( 'settings.color-palette' ) ) );
            
    if ( true === $this->theme->mods()->use( 'disable-custom-font-sizes' ) ) {
        
      add_theme_support( 'disable-custom-font-sizes' );
    }
  }
}