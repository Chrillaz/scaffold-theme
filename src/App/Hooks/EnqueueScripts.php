<?php

namespace WpTheme\Scaffold\App\Hooks;

use WpTheme\Scaffold\Framework\Abstracts\Hooks;

use WpTheme\Scaffold\Framework\Services\HookLoader;

use WpTheme\Scaffold\Framework\Services\AssetLoader;

final class EnqueueScripts extends Hooks {

  private $hooks;

  private $assets;

  public function __construct ( HookLoader $hooks, AssetLoader $assets ) {

    $this->hooks = $hooks;

    $this->assets = $assets;
  }

  public function publicAssets () {

    $this->assets->addScript( 'main', '/js/main.min.js' )->enqueue();

    $this->assets->load();
  }

  public function register (): void {

    $this->hooks->addAction( 'wp_enqueue_scripts', 'publicAssets', $this );

    $this->hooks->load();
  }
}