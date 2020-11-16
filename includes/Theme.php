<?php

namespace Chrillaz;

class Theme {

  private $assets;

  private $loader;

  private $settings;

  private $customizer;

  public function __construct () {
  
    $this->settings = apply_filters( 'chrillaz/default_settings', asset( '/settings.json', false, true )->contents );

    $this->loader = new Loader();

    $this->customizer = new Customizer( $this->settings['options'] );

    $this->assets = new AssetLoader();
  }

  /**
   * getColorScheme
   * 
   * Returns gutenber compatible color array
   * 
   * @return array
   */
  public function getColorScheme (): array {

    return array_map( function ( $name ) {

      return [
        'name'  => __( ucfirst( str_replace( '-', ' ',  $name ) ), $this->getTheme( 'TextDomain' ) ),
        'slug'  => $name,
        'color' => esc_html( get_theme_mod( $name, $this->customizer->getDefault( $name ) ) )
      ];
    }, array_keys( $this->settings['options']['colors'] ) );
  }

  /**
   * getTheme
   * 
   * Returns value from theme header details
   * 
   * @param string $detail
   * 
   * @return string
   */
  public function getTheme ( string $detail ): string {

    return wp_get_theme()->get( $detail );
  }

  /**
   * getThemeMod
   * 
   * Returns theme mod value
   * 
   * @param string $mod
   * 
   * @param mixed $default
   * 
   * @return mixed
   */
  public function getThemeMod ( string $mod, $default = false ) {

    if ( ! $default ) {

      return get_theme_mod( $mod, $default );
    }

    return get_theme_mod( $mod, $this->getCustomizer()->getDefault( $mod ) );
  }

  /**
   * getCustomizer
   * 
   * Returns the instance of Customizer
   * 
   * @return Customizer
   */
  public function getCustomizer (): Customizer {

    return $this->customizer;
  }

  /**
   * getLoader
   * 
   * Returns the instance of Loader
   * 
   * @return Loader
   */
  public function getLoader(): Loader {

    return $this->loader;
  }

  /**
   * getAssets
   * 
   * Returns the instance of AssetLoader
   * 
   * @return AssetLoader
   */
  public function getAssets(): AssetLoader {

    return $this->assets;
  }

  /**
   * addScripts
   * 
   * @param Closure $callback
   * 
   * @return Closure
   */
  public function addScripts ( $callback ) {

    $assetPath = $this->assets->assetPath();

    $themeVersion = $this->getTheme( 'Version' );

    if ( is_object( $callback) && is_callable( $callback ) ) {

      return call_user_func_array( $callback, [ $assetPath, $themeVersion ] );
    }
  }
}