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

    $this->assets->addStyle( 'public-styles', '/css/public-styles.css' )->inline( $this->styles->getCustomProperties() )->enqueue();

    $this->assets->addScript( 'public-scripts', '/js/public.min.js' )->load( 'defer' )->enqueue();

    $this->assets->load();
  }

  public function adminAssets ( string $suffix ) {
    
    if ( 'appearance_page_theme_option' === $suffix ) {

      $this->assets->addScript( 'admin-scripts', '/js/admin.min.js' )->dependencies( 'jquery', 'wp-color-picker' )->enqueue();

      $this->assets->addStyle( 'admin-styles', '/css/admin-styles.css' )->enqueue();
      
      $this->assets->addStyle( 'wp-color-picker' )->enqueue();
    }
  }

  public function editorAssets () {

    $this->assets->addScript( 'editor-scripts', '/js/editor.min.js' )->dependencies(
      'wp-editor',
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

    $this->hooks->addAction( 'enqueue_block_editor_assets', 'editorAssets', $this );

    $this->hooks->load();
  }
}