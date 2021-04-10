<?php

namespace WpTheme\Scaffold\App\Hooks;

use WpTheme\Scaffold\Framework\Abstracts\Hooks;

use WpTheme\Scaffold\Framework\Services\{
  HookLoader,
  AssetLoader
};

final class EnqueueScripts extends Hooks {

  protected $hooks;

  protected $assets;

  public function __construct ( HookLoader $hooks, AssetLoader $assets ) {

    $this->hooks = $hooks;

    $this->assets = $assets;
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

  public function register (): void {

    $this->hooks->addAction( 'wp_enqueue_scripts', 'publicAssets', $this );

    $this->hooks->addAction( 'admin_enqueue_scripts', 'adminAssets', $this );

    $this->hooks->load();
  }
}