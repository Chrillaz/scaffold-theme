<?php

/**
 * Theme helper functions
 */

if ( ! function_exists( 'foreach_file' ) ) {

  function foreach_file ( $dir, $extention, $callback ) {

    $files = new DirectoryIterator( get_stylesheet_directory() . $dir );

    foreach ( $files as $file ) {
      
      if ( pathinfo( $file, PATHINFO_EXTENSION ) === $extention ) {

        $name = basename( $file );

        $path = trailingslashit( $dir ) . $name;

          if ( is_object( $callback ) && is_callable( $callback ) ) {

          call_user_func_array( $callback, [ $name, $path ] );
        }
      }
    }
  }
}

if ( ! function_exists( 'printeach' ) ) {

  function printeach ( $values ) {

    if ( is_array( $values ) && !empty( $values ) ) {

      foreach ($values as $value) {

        if ( is_string( $value ) && !empty( $value ) ) {

          print( $value );
        }
      }
    } 
  }
}
