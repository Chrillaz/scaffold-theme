<?php

class Autoloader {

  public function __construct ( $namespace, $base_dir, $extention = '.php' ) {
    
    spl_autoload_register( function ( $rel_path ) use ( $namespace, $base_dir, $extention ) {
      
      $str_parts = explode( '\\', $rel_path );

      $depth = count( $str_parts ) - 1;

      if ( is_array( $str_parts ) && ! empty( $str_parts ) ) {

        $str_parts[ $depth ] = 'class-' . $str_parts[ $depth ];

        $path = str_replace( '_', '-', substr( implode( '/', $str_parts ), strlen( $namespace . '/' ) ) );
        
        $file = trailingslashit( $base_dir ) . strtolower( $path ) . $extention;
        
        if ( file_exists( $file ) ) {
  
          require $file;
          return true;
        }
      }

      return false;
    });
  }
}
