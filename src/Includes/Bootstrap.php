<?php

namespace Chrillaz\WPScaffold\Includes;

if ( ! defined( 'ABSPATH' ) ) exit;

use Chrillaz\WPScaffold\Theme;

class Bootstrap extends Theme {

  public function __construct () {

    $this->loader()->addAction( 'customize_register', 'register', $this->customizer([
        'settings' => $this->getSetting( 'default-mods' ),
        'color-scheme' => $this->getSetting( 'color-palette' )
      ])
    );

    $this->loader()->addAction( 'after_setup_theme', 'themeSetup', $this );

    $this->loader()->addAction( 'wp_enqueue_scripts', 'loadAssets', $this->assets() );

    $this->loader()->addAction( 'script_loader_tag', 'scriptLoaderTag', $this->assets(), 10, 2 );
  }

  /**
   * themeSetup
   * 
   * Defines all theme supports
   * 
   * @return void
   */
  public function themeSetup (): void {
    
    load_theme_textdomain( $this->getTheme( 'TextDomain' ) );
    
    add_theme_support( 'title-tag' );
    
    add_theme_support( 'post-thumbnails' );
    
    if ( true === $this->getThemeMod( 'block-styles' ) ) {
    
      add_theme_support( 'wp-block-styles' );
    }
    
    if ( true === $this->getThemeMod( 'align-wide' ) ) {
    
      add_theme_support( 'align-wide' );
    }
    
    if ( true === $this->getThemeMod( 'responsive-embeds' ) ) {
          
      add_theme_support( 'responsive-embeds' );
    }
    
    if ( true === $this->getThemeMod( 'editor-styles' ) ) {
        
      add_theme_support( 'editor-styles' );
          
      add_editor_style( './assets/css/style-editor' );
    }
    
    $navmenu_locations = apply_filters( 'noor/navmenu_locations', [
      'primary' => __( 'Primary', wp_get_theme()->get( 'TextDomain' ) ),
      'social'  => __( 'Social Links Menu', wp_get_theme()->get( 'TextDomain' ) )
    ]);
    
    register_nav_menus( $navmenu_locations );

    add_theme_support('html5', [
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
    ]);
    
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
    
    if ( true === $this->getThemeMod( 'disable-custom-colors' ) ) {
        
      add_theme_support( 'disable-custom-colors' );
    }
    
    if ( true === $this->getThemeMod( 'disable-custom-gradients' ) ) {
          
      add_theme_support( 'disable-custom-gradients' );
    }
    
    add_theme_support( 'editor-color-palette', $this->getSchema( 'color', $this->getSetting( 'color-palette' ) ) );
            
    if ( true === $this->getThemeMod( 'disable-custom-font-sizes' ) ) {
        
      add_theme_support( 'disable-custom-font-sizes' );
    }
        
    // $custom_typography = apply_filters( 'noor/custom_font_sizes', $this->settings->get( 'typography/fontSize' ) );
        
    // add_theme_support( 'editor-font-sizes', $custom_typography );

    do_action( 'chrillaz/theme_supports' );
  }

  public function run () {

    $this->loader()->run();
  }
}