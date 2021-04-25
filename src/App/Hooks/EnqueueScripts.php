<?php

namespace WpTheme\Scaffold\App\Hooks;

use WpTheme\Scaffold\Core\Abstracts\Hooks;

use WpTheme\Scaffold\Core\Services\{
  HookLoader,
  AssetLoader,
  GlobalStyles
};

final class EnqueueScripts extends Hooks {

  protected $hooks;

  protected $assets;

  protected $styles;

  public function __construct ( HookLoader $hooks, AssetLoader $assets, GlobalStyles $styles ) {

    $this->hooks = $hooks;

    $this->assets = $assets;

    $this->styles = $styles;
  }

  public function publicAssets () {

    $this->assets
      ->addStyle( 'main', '/css/style.css' )
      ->inline( $this->styles->getCustomProperties() )
      ->enqueue();

    $this->assets
      ->addScript( 'main', '/js/main.min.js' )
      ->load( 'defer' )
      ->enqueue();
  }

  public function register (): void {

    $this->hooks->addAction( 'wp_enqueue_scripts', 'publicAssets', $this );

    $this->hooks->load();
  }
}