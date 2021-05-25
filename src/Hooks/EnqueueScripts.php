<?php

namespace Scaffold\Theme\Hooks;

use \Scaffold\Essentials\Abstracts\Hooks;

use \Scaffold\Essentials\Services\{
  HookLoader,
  AssetLoader
};

use Scaffold\Theme\Options\ThemeOption;

use Scaffold\Theme\Services\GlobalStyles;

final class EnqueueScripts extends Hooks {

  protected $hooks;

  protected $assets;

  protected $styles;

  protected $options;

  public function __construct ( HookLoader $hooks, AssetLoader $assets, ThemeOption $options, GlobalStyles $styles ) {

    $this->hooks = $hooks;

    $this->assets = $assets;

    $this->styles = $styles;
    
    $this->options = $options;
  }

  public function publicAssets () {

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    $this->assets->addStyle( 'theme-main-styles', '/css/style.css' )->inline( $this->styles->getCustomProperties() )->enqueue();

    $this->assets->addScript( 'theme-main-scripts', '/js/main.min.js' )->load( 'defer' )->enqueue();
=======
    $this->assets->addStyle( 'theme-styles', '/css/style.css' )->inline( $this->styles->getCustomProperties() )->enqueue();

    $this->assets->addScript( 'theme-main-scripts', '/js/main.min.js' )->load( 'defer' )->enqueue();

    $this->assets->load();
>>>>>>> cache test
=======
    $this->assets->addStyle( 'theme-main-styles', '/css/style.css' )->inline( $this->styles->getCustomProperties() )->enqueue();

    $this->assets->addScript( 'theme-main-scripts', '/js/main.min.js' )->load( 'defer' )->enqueue();
>>>>>>> fix
=======
    $this->assets->addStyle( 'theme-main-styles', '/css/style.css' )->inline( $this->styles->getCustomProperties() )->enqueue();

    $this->assets->addScript( 'theme-main-scripts', '/js/main.min.js' )->load( 'defer' )->enqueue();
>>>>>>> 0b6ffc1fa05f26849c818cd8c60b3ab0d54d8b15
  }

  public function adminAssets ( string $suffix ) {

    if ( 'appearance_page_theme_option' === $suffix ) {

      $this->assets->addScript( 'scaffold-option-scripts', '/js/admin-scripts.min.js' )->dependencies( 'jquery', 'wp-color-picker' )->enqueue();

      $this->assets->addStyle( 'scaffold-option-styles', '/css/admin-styles.css' )->enqueue();
      
      $this->assets->addStyle( 'wp-color-picker' )->enqueue();
    }
  }

  public function editorAssets () {

    $this->assets->addScript( 'theme-blocks', '/js/theme-blocks.min.js' )->dependencies(
      'wp-components', 
      'wp-compose', 
      'wp-data', 
      'wp-edit-post', 
      'wp-element', 
      'wp-plugins', 
      'wp-polyfill'
    )->enqueue();
  }

  public function register (): void {

    $this->hooks->addAction( 'wp_enqueue_scripts', 'publicAssets', $this );

    $this->hooks->addAction( 'admin_enqueue_scripts', 'adminAssets', $this );

    // $this->hooks->addAction( 'enqueue_block_editor_assets', 'editorAssets', $this );

    $this->hooks->load();
  }
}