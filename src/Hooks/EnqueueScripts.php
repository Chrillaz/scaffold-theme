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
<<<<<<< HEAD
=======
>>>>>>> cache test
    $this->assets->addStyle( 'theme-main-styles', '/css/style.css' )->inline( $this->styles->getCustomProperties() )->enqueue();
=======
    $this->assets->addStyle( 'theme-styles', '/css/style.css' )->inline( $this->styles->getCustomProperties() )->enqueue();
>>>>>>> cache test
=======
=======
>>>>>>> fix
    $this->assets->addStyle( 'theme-main-styles', '/css/style.css' )->inline( $this->styles->getCustomProperties() )->enqueue();
>>>>>>> fix

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
  }

  public function adminAssets ( string $suffix ) {

    $this->assets->addStyle( 'scaffold-option-styles', '/css/admin-styles.css' )->enqueue();
    
    if ( 'appearance_page_theme_option' === $suffix ) {

      $this->assets->addScript( 'scaffold-option-scripts', '/js/admin-scripts.min.js' )->dependencies( 'jquery', 'wp-color-picker' )->enqueue();
<<<<<<< HEAD
=======

      $this->assets->addStyle( 'scaffold-option-styles', '/css/admin-styles.css' )->enqueue();
>>>>>>> fix
      
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