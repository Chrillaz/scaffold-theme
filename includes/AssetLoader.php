<?php

namespace Chrillaz;

class AssetLoader {

  /**
   * assetPath
   * 
   * Returns path to assets
   * 
   * @return string
   */
  public function assetPath (): string {

    return get_stylesheet_directory_uri() . '/assets';
  }

  /**
   * scriptLoaderTag
   * 
   * Sets script_execution defer/async
   * 
   * @param string $tag
   * 
   * @param string $handle
   * 
   * @return string
   */
  public function scriptLoaderTag ( $tag, $handle ): string {

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