<?php

namespace WpTheme\Scaffold\App\Hooks;

use WpTheme\Scaffold\Framework\Abstracts\Hooks;

final class SetupTheme extends Hooks {

  public function setupTheme () {

    \load_theme_textdomain( $this->theme->getHeader( 'TextDomain' ) );
    
    \add_theme_support( 'title-tag' );
    
    \add_theme_support( 'post-thumbnails' );
    
    \register_nav_menus( [
      'primary' => __( 'Primary', $this->theme->getHeader( 'TextDomain' ) ),
      'social'  => __( 'Social Links Menu', $this->theme->getHeader( 'TextDomain' ) )
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
    
    // \set_post_thumbnail_size( $width:integer, $height:integer, $crop:boolean|array );
        
    \add_theme_support( 'custom-logo', [] );
    
    // \add_image_size( $name:string, $width:integer, $height:integer, $crop:boolean|array )
  }

  public function register(): void {

    $this->hooks->addAction( 'after_setup_theme', 'setupTheme', $this );

    $this->hooks->load();
  }
}