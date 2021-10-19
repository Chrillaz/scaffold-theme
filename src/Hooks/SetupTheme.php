<?php

namespace Scaffold\Theme\Hooks;

use Scaffold\Theme\Theme;

use Scaffold\Theme\Options\ThemeOption;

use \Scaffold\Essentials\Abstracts\Hooks;

use \Scaffold\Essentials\Services\HookLoader;

final class SetupTheme extends Hooks 
{

  protected $theme;

  protected $options;

  public function __construct( Theme $theme, ThemeOption $options ) 
  {

    $this->theme = $theme;

    $this->options = $options;
  }

  public function setup() 
  {

    \load_theme_textdomain( $this->theme->get( 'TextDomain' ) );
    
    \add_theme_support( 'title-tag' );
    
    \add_theme_support( 'post-thumbnails' );
    
    \register_nav_menus( [
      'primary' => __( 'Primary', $this->theme->get( 'TextDomain' ) ),
      'footer_col_one'  => __( 'Footer Column 1 Menu', $this->theme->get( 'TextDomain' ) ),
      'footer_col_two'  => __( 'Footer Column 2 Menu', $this->theme->get( 'TextDomain' ) ),
      'social'  => __( 'Social Menu', $this->theme->get( 'TextDomain' ) ),
      'help' => __( 'Help Menu', $this->theme->get( 'TextDomain') ) 
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

    \add_theme_support( 'custom-logo', [] );

    \add_theme_support( 'core-block-patterns' );

    if ( '1' !== $this->options->get( 'block-templates' ) ) {

        \remove_theme_support( 'block-templates' );
    }

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

      \add_editor_style( $this->theme->publicPath( '/assets/css/editor-styles.css' ) );
    }
  }

  public function register( HookLoader $hooks ): void 
  {

    $hooks->addAction( 'after_setup_theme', 'setup', $this );

    $hooks->load();
  }
}