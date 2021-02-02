<?php

namespace Chrillaz\WPScaffold\Includes;

if ( ! defined( 'ABSPATH' ) ) exit;

use Chrillaz\WPScaffold\Includes\Loader;

class Assets extends Loader {

  private $customProperties;

  public function __construct ( $customProperties ) {

    $properties = array_map( function ( $key ) use ( $customProperties ) {

      return array_reduce( $customProperties[$key], function ( $acc, $curr ) use ( $key ) {
        
        $acc .= "--theme-" . $curr['slug'] . "-" . $key . ": " . $curr[$key] . "; \n";
        return $acc;
      }, '');
    }, array_keys( $customProperties ) );
    
    $this->customProperties = sprintf( ':root{%s}', implode( ';', $properties ) );
  }

  public function getCustomProperties () {

    return $this->customProperties;
  }

  /**
   * addScript
   * 
   * wrapper for register, add data and enqueue scripts
   * 
   * @param object $asset
   * 
   * @return mixed
   */
  public function add ( object $asset ) {

    if ( $asset instanceof Style ) {

      wp_register_style( $asset->handle, $asset->uri, $asset->dependencies, $asset->version, $asset->media );

      wp_enqueue_style( $asset->handle );
    }
    
    if ( $asset instanceof Script ) {
      
      wp_register_script( $asset->handle, $asset->uri, $asset->dependencies, $asset->version, $asset->infooter );

      if ( isset( $asset->execution ) ) {

        wp_script_add_data( $asset->handle, 'script_execution', $asset->execution );
      }

      wp_enqueue_script( $asset->handle );
    }

    unset( $asset );
  }

  /**
   * editorAssets
   */
  public function editorAssets () {

    $scriptpath = $this->src( '/assets/js/editor-scripts.min.js' );
    wp_enqueue_script( 'theme-editor-scripts', $scriptpath->uri, ['wp-blocks', 'wp-hooks'], filemtime( $scriptpath->path ), true );

    if ( true === $this->getThemeMod( 'editor-styles' ) ) {

      $stylepath = $this->src( '/assets/css/editor-styles.css' );
      wp_enqueue_style( 'theme-editor-styles', $stylepath->uri, [], filemtime( $stylepath->path ) );

      wp_add_inline_style( 'theme-editor-styles', $this->getCustomProperties() );
    }
  }

  /**
   * loadAssets
   * 
   * Itterates assets queue and runs all callbacks
   * 
   * @return void
   */
  public function load (): void {
  
    array_map( function ( $callback ) {

      if ( is_object( $callback ) && is_callable( $callback ) ) {

        $fn = \Closure::bind( $callback, $this );
  
        $fn( $this );
      }
    }, $this->assets );
  }
 
  /**
   * scriptExec
   * 
   * Sets script_execution defer/async
   * 
   * @param string $tag
   * 
   * @param string $handle
   * 
   * @return string
   */
  public function scriptExec ( $tag, $handle ): string {

    $script_exec = wp_scripts()->get_data( $handle, 'script_execution' );

    if ( ! $script_exec ) {

      return $tag;
    }

    foreach ( wp_scripts()->registered as $script ) {

      if ( in_array( $handle, $script->deps, true ) ) {

        return $tag;
      }
    }
    
    if ( ! preg_match( ":\s$script_exec(=|>|\s):", $tag ) ) {

      $tag = preg_replace( ':(?=></script>):', " $script_exec", $tag, 1 );
    }

    return $tag;
  }
}