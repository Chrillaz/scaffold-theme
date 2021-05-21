<?php

namespace WpTheme\Scaffold\Hooks;

use \Essentials\Abstracts\Hooks;

use \Essentials\Services\{
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

    $this->hooks->addAction( 'enqueue_block_editor_assets', 'editorAssets', $this );

    $this->hooks->load();
  }
}