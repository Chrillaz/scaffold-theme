<?php

namespace WpTheme\Scaffold\Core\Hooks;

use WpTheme\Scaffold\Core\Abstracts\Hooks;

use WpTheme\Scaffold\Core\Services\{
  HookLoader,
  AssetLoader,
  ThemeOption,
  GlobalStyles
};

final class EnqueueScripts extends Hooks {

  protected $hooks;

  protected $assets;

  protected $styles;

  protected $options;

  public function __construct ( HookLoader $hooks, AssetLoader $assets, ThemeOption $options, GLobalStyles $styles ) {

    $this->hooks = $hooks;

    $this->assets = $assets;

    $this->options = $options;
  }

  public function adminAssets ( $suffix ) {

    if ( 'appearance_page_theme_option' === $suffix ) {

      $this->assets->addScript( 'scaffold-options', '/js/admin-scripts.min.js' )->dependencies( 'jquery', 'wp-color-picker' )->enqueue();

      $this->assets->addStyle( 'scaffold-options', '/css/admin-styles.css' )->enqueue();
      
      $this->assets->addStyle( 'wp-color-picker' )->enqueue();
      
      $this->assets->load();
    }
  }

  public function blockAssets () {

    $this->assets->addScript( 'theme-editor-scripts', '/js/editor-scripts.min.js' )->dependencies( 'wp-blocks', 'wp-hooks' )->enqueue();

    if ( '1' === $this->options->get( 'editor-styles' ) ) {

      $this->assets->addStyle( 'theme-editor-css', '/css/editor-styles.css' )->inline( $this->styles->getCustomProperties() )->enqueue();
    }
  }

  public function register (): void {

    $this->hooks->addAction( 'admin_enqueue_scripts', 'adminAssets', $this );

    $this->hooks->addAction( 'enqueue_block_editor_assets', 'blockAssets', $this );

    $this->hooks->load();
  }
}