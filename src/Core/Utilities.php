<?php

namespace WpTheme\Scaffold\Core;

class Utilities {

  public static function directoryIterator ( string $dir, \Closure $callback ) {

    $files = new \DirectoryIterator( $dir );

    foreach ( $files as $file ) {

      if ( ! $file->isDot() || ! $file->isDir() ) {

        $name = $file->getBasename( '.php' );

        $parts = explode( 'src/', $path = $file->getPath() );

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
}