<?php

namespace Chrillaz;

class Customizer {

  private $panels;

  private $sections;

  private $controls;

  private $settings;

  private $defaults = [];

  public function __construct ( array $themeOptions, array $config = [] ) {

    $this->panels = [];

    $this->sections = [];

    $this->controls = [];

    $this->settings = [];

    $this->themeSettings( $themeOptions );

    if ( ! empty( $config ) ) {

      $this->setup();
    }
  }

  /**
   * getFieldType
   * 
   * returns field type
   * 
   * @param mixed $value
   * 
   * @return mixed
   */
  private function getFieldType ( $value ) {

    switch ( $value ) {
      case 1 === preg_match( '/#([a-f0-9]{3}){1,2}\b/i', $value )
       :
        $return = 'color';
        break;
      case is_bool( $value ) :
        $return = 'checkbox';
        break;
      case is_numeric( $value ) :
        $return = 'number';
        break;
      default :
        $return = 'text';
    }

    return $return;
  }

  /**
   * getSanitizeCallback
   * 
   * returns string name for sanitize callback
   * 
   * @param string $type
   * 
   * @return string
   */
  private function getSanitizeCallback ( string $type ): string {

    $callbacks = [
      'color'  => 'sanitize_hex_color',
      'text'   => 'sanitize_text_field',
      'number' => 'absint'
    ];

    return ! empty( $callbacks[$type] ) ? $callbacks[$type] : '';
  }

  /**
   * setup
   * 
   * Generates settinngs for custom customizer options
   * 
   * @return void
   */
  private function setup () {

    foreach ( $config as $type => $settings ) {

      if ( is_array( $settings['panels'] ) && ! empty( $settings['panels'] ) ) {

        $this->add( 'panels', $settings['panels'] );
      }

      if ( is_array( $settings['sections'] ) && ! empty( $settings['sections'] ) ) {
        
        $this->add( 'sections', $settings['sections'] );
      }

      if ( is_array( $settings['controls'] ) && ! empty( $settings['controls'] ) ) {
        
        $this->add( 'controls', $settings['controls'] );
      }

      if ( is_array( $settings['settings'] ) && ! empty( $settings['settinns'] ) ) {
        
        $this->add( 'settings', $settings['settings'] );
      }
    }
  }

   /**
   * themeSettings
   * 
   * Itterates settings json and creates theme customizer settings
   * 
   * @param array $options
   * 
   * @return void
   */
  private function themeSettings ( array $options ) {

    $this->add( 'panels', 'theme_options', [
      'priority'    => 20,
      'title'       => __( 'Theme Options' ),
      'description' => __( 'Define theme defaults')
    ]);
    
    foreach ( $options as $section => $setting ) {

      $this->add( 'sections', 'theme_' .$section, [
        'title' => __( 'Theme ' . ucfirst( $section ) ),
        'panel' => 'theme_options'
      ]);

      foreach ( $setting as $key => $value ) {
        
        $type = $this->getFieldType( $value );

        $sanitizer = $this->getSanitizeCallback( $type );
          
        $this->add('settings', $key, [
          'section'           => 'theme_' .$section,
          'default'           => $value,
          'sanitize_callback' => $sanitizer,
        ]);
          
        $controls = [
          'type' => $type,
          'label' => __( str_replace( '-', ' ', $key ) ),
          'section' => 'theme_' .$section,
          'settings' => $key
        ];

        if ( $type === 'number' && $key === 'content-width' ) {
          
          $controls['input_attrs'] = [
            'min' => 900,
            'max' => 1400
          ];
        }

        $this->add('controls', $key . '-control', $controls );
      }
    }
  }

  /**
   * getDefault
   * 
   * Returns default value for theme mod
   * 
   * @return array
   */
  public function getDefault ( string $name ) {

    if ( empty( $this->defaults ) ) {
      
      $this->defaults = array_map( function ( $setting ) {
      
        return $setting['default'];
      }, $this->settings );
    }

    if ( isset( $this->defaults[$name] ) ) {
  
      return $this->defaults[$name];
    }

    return null;
  }

  /**
   * add
   * 
   * Registers Panel, Section, Control, Setting
   * 
   * @param string  $type
   * @param array   $options
   * 
   * @return void
   */
  public function add ( string $type, $key, array $options ) {

    $this->{$type}[$key] = $options;
  }

  /**
   * register
   * 
   * Registers settings to theme customizer
   * 
   * @return void
   */
  public function register ( $wp_customize ) {

    foreach( $this->panels as $id => $panel ) {

      $wp_customize->add_panel( $id, $panel );
    }

    foreach( $this->sections as $id => $section ) {
      
      $wp_customize->add_section( $id, $section );
    }

    foreach( $this->settings as $id => $setting ) {
      
      $wp_customize->add_setting( $id, $setting );
    }

    foreach( $this->controls as $id => $control ) {
      
      switch ( $control['type'] ) {
        case 'image' :
          $wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, $id, $control ) );
          break;
        case 'color' :
          $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, $id, $control ) );
          break;
        default :
          $wp_customize->add_control( new \WP_Customize_Control( $wp_customize, $id, $control ) );
      }
    }
  }
}