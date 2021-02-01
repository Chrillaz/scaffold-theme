<?php

namespace Chrillaz\WPScaffold;

if ( ! defined( 'ABSPATH' ) ) exit;

use Chrillaz\WPScaffold\Interfaces\Facade;

use Chrillaz\WPScaffold\Includes\Customizer;

use Chrillaz\WPScaffold\Includes\Hooks;

use Chrillaz\WPScaffold\Includes\Assets;

abstract class Theme implements Facade {

  // private $assets;

  private $hooks;

  private $assets;

  private $customizer;

  private $settings;

  protected static $optionsName = '';

  /**
   * getSetting
   * 
   * reads the settings json and returns the chunk of json the path is targeting
   * 
   * @param string $param
   * 
   * @return mixed
   */
  protected function getSetting ( string $part ) {

    if ( $this->settings === null ) {

      $settings = \apply_filters( 
        'chrillaz/default_settings', 
        json_decode( file_get_contents( $this->src( '/settings.json' )->path ), true ) 
      );

      $this->settings = $settings;
    }

    return ( isset( $this->settings[$part] ) ? $this->settings[$part] : [] );
  }

  /**
   * assetPath
   * 
   * Returns path to assets
   * 
   * @return string
   */
  public function src ( string $relpath ): object {

    $src = new \stdClass;

    $src->path = get_template_directory() . $relpath;

    $src->uri = get_template_directory_uri() . $relpath;

    return $src;
  }

  /**
   * customizer
   * 
   * returns an instance of Customizer
   * this class handles the setup of themes options panel in the customizer
   * 
   * @param array $defaults
   * 
   * @return Customizer
   */
  public function customizer ( ?array $defaults = [] ): Customizer {

    if ( $this->customizer === null ) $this->customizer = new Customizer( $defaults );

    return $this->customizer;
  }

  /**
   * loader
   * 
   * returns an instance of Loader
   * this class queues action and filter hooks
   * 
   * @return Hooks
   */
  public function hooks (): Hooks {

    if ( $this->hooks === null ) $this->hooks = new Hooks();

    return $this->hooks;
  }

  /**
   * asset
   * 
   * returns an instance of Assets
   * this class handles script and style inclutions and script executions
   * 
   * @return Assets
   */
  public function assets (): Assets {

    if ( $this->assets === null ) {

      $this->assets = new Assets([
        'color' => $this->getSchema( 'color', $this->getSetting( 'color-palette' ) ),
        'font-size' => $this->getSchema( 'font-size', $this->getSetting( 'font-sizes' ) )
      ]);
    }

    return $this->assets;
  }

  /**
   * getOptions
   * 
   * a wrapper around get_option wich provides the theme default options
   * 
   * @return array
   */
  public static function getOptions (): array {

    return get_option( self::$optionsName, self::getSetting( 'default-options' ) );
  }

  /**
   * getOption
   * 
   * gets the specifyed option from the options array
   * 
   * @param string $option
   * 
   * @return mixed
   */
  public static function getOption ( string $option ) {

    $options = self::getOptions();

    return ( isset( $options[$option] ) ? $options[$option] : false );
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
  public static function getTheme ( string $detail ): string {

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
    
    if ( $default ) {

      return get_theme_mod( $mod, $default );
    }

    return get_theme_mod( $mod, self::customizer()->getDefault( $mod ) );
  }

  /**
   * getSchema
   * 
   * Returns gutenberg scheme of specifyed setting
   * 
   * @return array
   */
  public function getSchema ( string $key, array $scheme ): array {
    
    return array_map( function ( $name ) use ( $key, $scheme ) {
      // var_dump('<pre>', $this->getThemeMod( $name ), '</pre>');
      return [
        'name' => __( ucfirst( str_replace( '-', ' ',  $name ) ), $this->getTheme( 'TextDomain' ) ),
        'slug' => $name,
        $key   => ($key === 'font-size' ? $this->getThemeMod( $name ) . 'px' : $this->getThemeMod( $name ) )
      ];
    }, array_keys( $scheme ) );
  }
}