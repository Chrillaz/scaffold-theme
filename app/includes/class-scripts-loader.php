<?php

namespace Theme\includes;

class Scripts_Loader {

  public static $instance = NULL;
  
  protected $registered_scripts = [];

  private function __construct ( $target_dir, $version, $settings ) {
    
    $this->register_scripts( $target_dir, $version );

    if ( ! empty( $this->registered_scripts ) ) {

      $this->enqueue_scripts( $this->registered_scripts );
    }
      
    if ( $settings != NULL && $settings['defer'] ) {
        
      add_filter( 'script_loader_tag', function ( $tag ) use ( $settings ) {

        return $this->defer_scripts( $tag, $settings );
      }, 10);
    }
  }

  protected function register_scripts ( string $target_dir, string $version ): void {
    
    foreach_file( $target_dir, 'js', function ( $name, $path ) use ( $version ) {

      $alias = substr( basename( $name ), 0, strpos( basename( $name ), '.' ) );

      $this->registered_scripts[$alias] = wp_register_script( $alias, get_template_directory_uri() . $path, NULL, $version, true );
    });
  }

  protected function enqueue_scripts ( $scripts ): void {

    foreach ( $scripts as $name => $registered ) {

      $alias = explode( '-', $name, 2 );

      if ( is_array( $alias ) && $registered ) apply_filters( 'theme_scripts_exclude', $alias, $name );

      if ( $registered ) wp_enqueue_script( $name );
    }
  }

  public function defer_scripts ( string $tag, $settings ): string {
    
    if ( is_admin() || ! strpos( $tag, 'js' ) ) return $tag;

    $pages = apply_filters( 'scripts_loader_omit_if_page', $settings['omit_if_page'] );
    
    if ( is_array( $pages ) && is_page( $pages ) ) return $tag;
    
    $scripts = apply_filters( 'scripts_loader_defer_scripts', $settings['scripts'] );

    if ( is_array( $scripts ) && ! empty( $scripts ) ) {

      // Defer each script in settings
      foreach ( $scripts as $script ) {
    
        if ( strpos( $tag, $script ) ) return str_replace( ' src' , ' defer src', $tag );
      }
    }

    return $tag;
  }

  public static function init ( string $target_dir, string $version, $settings = NULL ) {

    if ( self::$instance !== NULL ) return self::$instance;

    return self::$instance = new Scripts_Loader( $target_dir, $version, $settings );
  }
}