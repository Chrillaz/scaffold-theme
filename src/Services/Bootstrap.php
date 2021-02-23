<?php

namespace WPTheme\Scaffold\Services;

use WPTheme\Scaffold\Integrations\Integrations;

class Bootstrap {

  public $theme;

  public function __construct ( $theme ) {

    $this->theme = $theme;
  }

  private function integrations () {

    Integrations::create( 
      $this->theme, 
      $this->theme->settings()->get( 'integrations' ) 
    );
  }

  public function init () {

    $this->integrations();
    
    $this->theme->assets()->doCSSVars( $this->theme->settings()->collect( 'color-palette', 'font-sizes', 'media-breakpoints' ) );

    add_action( 'after_setup_theme', [ $this, 'setup' ] );

    add_action( 'wp_enqueue_scripts', function () {

      do_action( 'scaffold/public_assets', $this->theme->assets() );
    });

    add_filter( 'script_loader_tag', [ $this->theme->assets(), 'scriptExec' ], 10, 2 );
  }

  public function setup () {

    load_theme_textdomain( $this->theme->get( 'TextDomain' ) );
    
    add_theme_support( 'title-tag' );
    
    add_theme_support( 'post-thumbnails' );

    $navmenu_locations = apply_filters( 'scaffold/navmenu_locations', [
      'primary' => __( 'Primary', $this->theme->get( 'TextDomain' ) ),
      'social'  => __( 'Social Links Menu', $this->theme->get( 'TextDomain' ) )
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
    
    $post_thumbnail_size = apply_filters( 'scaffold/set_post_thumbnail_size', [] );
    
    if ( is_array( $post_thumbnail_size ) && ! empty( $post_thumbnail_size ) ) {
    
      set_post_thumbnail_size(
        $post_thumbnail_size['width'],
        $post_thumbnail_size['height'],
        $post_thumbnail_size['crop']
      );
    }
        
    add_theme_support( 
      'custom-logo', 
      apply_filters( 'scaffold/custom_logo', [] )
    );
    
    $custom_image_sizes = apply_filters( 'scaffold/custom_image_sizes', [] );
    
    if ( is_array( $custom_image_sizes ) && ! empty( $custom_image_sizes ) ) {
    
      foreach ( $custom_image_sizes as $name => $settings ) {
  
        add_image_size( $name, $settings['width'], $settings['height'], $settings['crop'] );
      }
    }

    do_action( 'scaffold/setup', $this->theme );
  }
}