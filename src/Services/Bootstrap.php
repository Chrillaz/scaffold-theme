<?php

namespace WPTheme\Scaffold\Services;

use WPTheme\Scaffold\Integrations\Integrations;

class Bootstrap {

  public function __construct ( $theme ) {

    add_action( 'after_setup_theme', function () use ( $theme ) {

      $this->setup( $theme );
    });

    add_action( 'wp_enqueue_scripts', function () use ( $theme ) {

      if ( function_exists( $func = 'publicAssets' ) ) {

        call_user_func_array( $func, [$theme->assets()] );
      }
    });

    add_filter( 'script_loader_tag', [ $theme->assets(), 'scriptExec' ], 10, 2 );

    $this->integrations( $theme, $theme->settings()->collect( 'integrations' ) );
  }

  private function integrations ( $theme, $integrations ) {

    Integrations::create( $theme, $integrations );
  }

  public function setup ( $theme ) {

    load_theme_textdomain( $theme->get( 'TextDomain' ) );
    
    add_theme_support( 'title-tag' );
    
    add_theme_support( 'post-thumbnails' );

    $navmenu_locations = apply_filters( 'scaffold/navmenu_locations', [
      'primary' => __( 'Primary', $theme->get( 'TextDomain' ) ),
      'social'  => __( 'Social Links Menu', $theme->get( 'TextDomain' ) )
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
  }
}