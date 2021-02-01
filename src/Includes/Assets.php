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
   * @param string $handle
   * 
   * @param object $args
   * 
   * @return mixed
   */
  public function addScript ( string $handle, array $args ) {

    if ( ! isset( $args['dependencies'] ) ) {

      $args['dependencies'] = [];
    }

    if ( ! isset( $args['infooter'] ) ) {
      
      $args['infooter'] = true;
    }

    wp_register_script( $handle, $args['src']->uri, $args['dependencies'], filemtime( $args['src']->path ), $args['infooter'] );

    if ( isset( $args['scriptexec'] ) && ( $args['scriptexec'] === 'defer' || $args['scriptexec'] === 'async' ) ) {

      wp_script_add_data( $handle, 'script_execution', $args['scriptexec'] );
    }

    return wp_enqueue_script( $handle );
  }

  /**
   * addStyle
   * 
   * wrapper for register and enqueue styles
   * 
   * @param string $handle
   * 
   * @param array $args
   * 
   * @return mixed
   */
  public function addStyle ( string $handle, array $args ) {

    if ( ! isset( $args['dependencies'] ) ) {
      
      $args['dependencies'] = [];
    }

    if ( ! isset( $args['media'] ) ) {
      
      $args['media'] = '';
    }

    wp_register_style( $handle, $args['src']->uri, $args['dependencies'], filemtime( $args['src']->path ), $args['media'] );

    return wp_enqueue_style( $handle );
  }

  /**
   * editorAssets
   */
  public function editorAssets () {

    $scriptpath = $this->src( '/assets/js/editor-scripts.min.js' );
    wp_enqueue_script(
      'theme-editor-scripts',
      $scriptpath->uri,
      ['wp-blocks', 'wp-hooks'],
      filemtime( $scriptpath->path ),
      true
    );

    if ( true === $this->getThemeMod( 'editor-styles' ) ) {

      $stylepath = $this->src( '/assets/css/editor-styles.css' );
      wp_enqueue_style( 
        'theme-editor-styles', 
        $stylepath->uri, 
        [], 
        filemtime( $stylepath->path )
      );

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
  
        call_user_func_array( $callback, [ $this ] );
      }
    }, $this->assets );
  }

  /**
   * enqueue
   * 
   * adds callback to queue
   * 
   * @param closure
   * 
   * @return void
   */
  public function queue ( ...$args ) {

    list( $callback ) = $args;

    return array_push( $this->assets, $callback );
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

    if ( 'async' !== $script_exec && 'defer' !== $script_exec ) {

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