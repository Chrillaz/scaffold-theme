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

  public function blockAssets () {

    $this->theme->assets()->script( 'theme-editor-scripts', 'editor.min.js' )->dependencies( 'wp-block', 'wp-hooks' )->enqueue();

    $this->theme->assets()->style( 'theme-editor-css', 'editor-styles.css' )->inline( 'theme-editor-css', $this->theme->assets()->getCSSVars() )->enqueue();
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
    
    // add_theme_support( 'editor-color-palette', $this->theme->getSchema( 'color', $this->theme->getSetting( 'color-palette' ) ) );
            
    if ( true === $this->theme->settings()->get( 'disable-custom-font-sizes' ) ) {
        
      add_theme_support( 'disable-custom-font-sizes' );
    }
  }
}