<?php

namespace WpTheme\Scaffold\Core;

class Utilities {

  public static function directoryIterator ( string $path, \Closure $callback ) {

    $filter = new \RecursiveCallbackFilterIterator( 
      new \RecursiveDirectoryIterator( $path ), 
      function ( $current, $key, $iterator ) {

        return ( pathinfo( $name = $current->getFileName(), PATHINFO_EXTENSION) || $name[0] !== '.' );
      }
    );

    foreach ( new \RecursiveIteratorIterator( $filter ) as $info) {

      $name = $info->getBasename( '.php' );

      $parts = explode( 'src/', $path = $info->getPath() );

      $namespace = 'WpTheme\\Scaffold\\' . str_replace( '/', '\\', end( $parts ) );

      $qualifiedname = $namespace . '\\' . $name . ''::class;

      $callback( (object) [
        'name' => $name,
        'path' => $path,
        'namespace' => $namespace,
        'qualifiedname' => $qualifiedname
      ]);
    }
  }
}