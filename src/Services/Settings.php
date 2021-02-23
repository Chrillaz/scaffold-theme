<?php

namespace WPTheme\Scaffold\Services;

class Settings {

  public $defaults;

  private $optionname;

  private $settings = [];

  public function __construct ( $settings ) {
    
    $this->optionname = 'theme_mods_' . get_template() . '[settings]';

    $this->settings = $settings;

    $this->defaults = $this->doDefaults( 'settings' );
  }

  private function doDefaults ( string $settings ) {

    return array_reduce( $this->get( $settings ), function ( $acc, $curr ) {

      if ( is_array( $curr ) ) {

        $acc = array_merge( $acc, $curr );
      }

      return $acc;
    }, array() );
  }

  public function get ( string $option ) {

    if ( isset( $this->settings[$option] ) ) {

      return $this->settings[$option];
    }
    
    $options = get_option( $this->optionname, $this->defaults );
    
    return $options[$option];
  }

  public function collect ( ...$groups ) {
    
    $options = get_option( $this->optionname, $this->defaults );

    return array_reduce( $groups, function ( $acc, $curr ) use ( $options ) {
      
      if ( isset( $this->get('settings')[$curr] ) ) {
        
        $acc = array_merge( $acc, array_filter( $options, function ( $value ) use ( $curr ) {
          
          return array_key_exists( $value, $this->get('settings')[$curr] );
        }, ARRAY_FILTER_USE_KEY ) );
      }

      return $acc;
    }, array() );
  }

  public function set ( string $option, $value ) {

    $options = get_option( $this->optionname, $this->defaults );

    $options[$option] = $value;

    update_option( $this->optionname, $options );
  }
}
