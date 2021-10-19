<?php

namespace Scaffold\Theme\Hooks;

use Scaffold\Theme\Options\ThemeOption;

use \Scaffold\Essentials\Abstracts\Hooks;

use \Scaffold\Essentials\Services\{
  HookLoader,
  AssetLoader
};

final class EnqueueScripts extends Hooks 
{

  protected $assets;

  protected $options;

  public function __construct( AssetLoader $assets, ThemeOption $options ) 
  {

    $this->assets = $assets;
    
    $this->options = $options;
  }

  public function publicAssets() 
  {

    $this->assets->addStyle( 'dashicons' )->enqueue();

    $this->assets->addStyle( 'theme-main-styles', '/css/public-styles.css' )->enqueue();

    $this->assets->addScript( 'theme-public-scripts', '/js/public.min.js' )->load( 'defer' )->enqueue();

    $this->assets->load();
  }

  public function adminAssets( string $suffix ) 
  {

    $this->assets->addStyle( 'scaffold-option-styles', '/css/admin-styles.css' )->enqueue();
  }

  public function editorAssets() 
  {
    
    $this->assets->addScript( 'theme-blocks', '/js/editor-scripts.min.js' )
      ->dependencies(
        'wp-components', 
        'wp-compose', 
        'wp-data', 
        'wp-editor',
        'wp-edit-post', 
        'wp-element', 
        'wp-hooks',
        'wp-plugins',
        'wp-polyfill'
      )
      ->enqueue();      

      $this->assets->addStyle( 'editor-styles', '/css/editor-styles.css' )->enqueue();
  }

  public function register( HookLoader $hooks ): void 
  {

    $hooks->addAction( 'wp_enqueue_scripts', 'publicAssets', $this );

    $hooks->addAction( 'admin_enqueue_scripts', 'adminAssets', $this );

    $hooks->addAction( 'enqueue_block_editor_assets', 'editorAssets', $this );

    $hooks->load();
  }
}