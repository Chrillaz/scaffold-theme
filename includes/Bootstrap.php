<?php

namespace Chrillaz;

use Chrillaz\Theme;

use function Chrillaz\asset;

class Bootstrap extends Theme {

  public function __construct () {
  
    parent::__construct();
    
    $loader = $this->getLoader();

    $loader->addAction( 'customize_register', $this->getCustomizer(), 'register' );

    $loader->addAction( 'after_setup_theme', $this, 'themeSupports' );

    $loader->addAction( 'wp_enqueue_scripts', $this, 'addScripts' );

    $loader->addAction( 'script_loader_tag', $this->getAssets(), 'scriptLoaderTag', 10, 2 );

    $loader->run();

    return $this;
  }

  /**
   * themeSupports
   * 
   * Defines all theme supports
   * 
   * @return void
   */
  public function themeSupports () {

    $customizer = $this->getCustomizer();
    
    load_theme_textdomain( $this->getTheme( 'TextDomain' ) );
    
    add_theme_support( 'title-tag' );
    
    add_theme_support( 'post-thumbnails' );
    
    if ( true === get_theme_mod( 'block-styles', $this->getThemeMod( 'block-styles' ) ) ) {
    
      add_theme_support( 'wp-block-styles' );
    }
    
    if ( true === get_theme_mod( 'align-wide', $this->getThemeMod( 'align-wide' ) ) ) {
    
      add_theme_support( 'align-wide' );
    }
    
    if ( true === get_theme_mod( 'responsive-embeds', $this->getThemeMod( 'responsive-embeds' ) ) ) {
          
      add_theme_support( 'responsive-embeds' );
    }
    
    if ( true === get_theme_mod( 'editor-styles', $this->getThemeMod( 'editor-styles' ) ) ) {
        
      add_theme_support( 'editor-styles' );
          
      add_editor_style( './assets/css/style-editor' );
    }
    
    $navmenu_locations = apply_filters( 'noor/navmenu_locations', [
      'primary' => __( 'Primary', wp_get_theme()->get( 'TextDomain' ) ),
      'social'  => __( 'Social Links Menu', wp_get_theme()->get( 'TextDomain' ) )
    ]);
    
    register_nav_menus( $navmenu_locations );
    
    $post_thumbnail_size = apply_filters( 'noor/set_post_thumbnail_size', [] );
    
    if ( ! empty( $post_thumbnail_size ) ) {
    
      set_post_thumbnail_size(
        $post_thumbnail_size['width'],
        $post_thumbnail_size['height'],
        $post_thumbnail_size['crop']
      );
    }
        
    add_theme_support( 
      'custom-logo', 
      apply_filters( 'noor/custom_logo', [] )
    );
    
    $custom_image_sizes = apply_filters( 'noor/custom_image_sizes', [] );
    
    if ( is_array( $custom_image_sizes ) && ! empty( $custom_image_sizes ) ) {
    
      foreach ( $custom_image_sizes as $name => $settings ) {
  
        add_image_size( $name, $settings['width'], $settings['height'], $settings['crop'] );
      }
    }
    
    if ( true === get_theme_mod( 'disable-custom-colors', $this->getThemeMod( 'disable-custom-colors' ) ) ) {
        
      add_theme_support( 'disable-custom-colors' );
    }
    
    if ( true === get_theme_mod( 'disable-custom-gradients', $this->getThemeMod( 'disable-custom-gradients' ) ) ) {
          
      add_theme_support( 'disable-custom-gradients' );
    }
    
    add_theme_support( 'editor-color-palette', $this->getColorScheme() );
            
    if ( true === get_theme_mod('disable-custom-font-sizes', $this->getThemeMod( 'disable-custom-font-sizes' ) ) ) {
        
      add_theme_support( 'disable-custom-font-sizes' );
    }
        
    // $custom_typography = apply_filters( 'noor/custom_font_sizes', $this->settings->get( 'typography/fontSize' ) );
        
    // add_theme_support( 'editor-font-sizes', $custom_typography );
  }
}