<?php

namespace WpTheme\Scaffold\App\Hooks;

use WpTheme\Scaffold\Framework\Abstracts\Hooks;

use WpTheme\Scaffold\App\Options\ThemeOption;

use WpTheme\Scaffold\Framework\Services\{
  HookLoader,
  AssetLoader
};

final class EnqueueScripts extends Hooks {

  protected $hooks;

  protected $assets;

  protected $options;

  public function __construct ( HookLoader $hooks, AssetLoader $assets, ThemeOption $options ) {

    $this->hooks = $hooks;

    $this->assets = $assets;

    $this->options = $options;
  }

  public function publicAssets () {

    $this->assets->addScript( 'main', '/js/main.min.js' )->load( 'defer' )->enqueue();

    $this->assets->load();
  }

  public function adminAssets ( $hook_suffix ) {

    if ( 'appearance_page_theme_option' === $hook_suffix ) {

      $this->assets->addScript( 'scaffold-options', '/js/admin-scripts.min.js' )->dependencies( 'jquery', 'wp-color-picker' )->enqueue();

      $this->assets->addStyle( 'scaffold-options', '/css/admin-styles.css' )->enqueue();
      
      $this->assets->addStyle( 'wp-color-picker' )->enqueue();
      
      $this->assets->load();
    }
  }

  public function blockAssets () {

    $this->assets->addScript( 'theme-editor-scripts', 'editor-scripts.min.js' )->dependencies( 'wp-blocks', 'wp-hooks' )->enqueue();

    if ( '1' === $this->options->get( 'editor-styles' ) ) {

      // $this->assets->addStyle( 'theme-editor-css', 'editor-styles.css' )->inline( Context::use( 'cssVars' ) )->enqueue();
    }
  }

  public function register (): void {

    $this->hooks->addAction( 'wp_enqueue_scripts', 'publicAssets', $this );

    $this->hooks->addAction( 'admin_enqueue_scripts', 'adminAssets', $this );

    $this->hooks->addAction( 'enqueue_block_editor_assets', 'blockAssets', $this );

    $this->hooks->load();
  }
}