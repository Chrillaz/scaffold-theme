<?php

namespace WpTheme\Scaffold\Providers;

use WpTheme\Scaffold\Abstracts\Provider;

class SetupProvider extends Provider {

  public function boot ( ...$args ) {

    load_theme_textdomain( $this->theme->get( 'TextDomain' ) );
    
    add_theme_support( 'title-tag' );
    
    add_theme_support( 'post-thumbnails' );
    
    \register_nav_menus( array(
      'primary' => __( 'Primary', $this->theme->get( 'TextDomain' ) ),
      'social'  => __( 'Social Links Menu', $this->theme->get( 'TextDomain' ) )
    ) );

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
        
    // \add_theme_support( $feature:string, $args:mixed );
    
    // \add_image_size( $name:string, $width:integer, $height:integer, $crop:boolean|array );
    
  }

  public function register () {

    $this->provider->action( $this );
  }
}