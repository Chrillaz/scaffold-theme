<?php

namespace WpTheme\Scaffold\Providers;

use WpTheme\Scaffold\Theme;

use WpTheme\Scaffold\Abstracts\Provider;

class SettingsProvider extends Provider {

  public function boot ( ...$args ) {

    $options = Theme::use( 'ThemeOptions' );
    
    \register_setting( $options->getName(), 'theme_options' );

    \add_settings_section( 'theme_supports', 'Gutenberg', [$options, 'supportSection'], $options->getName() );

    \add_settings_section( 'theme_breakpoints', 'Media breakpoints', [$options, 'breakpointSection'], $options->getName() );

    \add_settings_section( 'theme_fontsizes', 'Font Sizes', [$options, 'fontsizeSection'], $options->getName() );

    foreach ( $options->getSupportSettings() as $option => $value ) {
      
      $label = \ucfirst( \str_replace( '-', ' ', $option ) );

      \add_settings_field( $option, $label, function () use ( $options, $option ) {
        
        echo \sprintf( '<input id="%s" name="%s" type="%s" value="%s" %s />',
          'theme_' . $option,
          $options->getName() . '[' . $option . ']',
          'checkbox',
          '1',
          ( '1' === $options->use( $option ) ? 'checked' : '' )
        );
        
      }, $options->getName(), 'theme_supports' );
    }

    foreach ( $options->getBreakPointSettings() as $option => $value ) {

      $label = 'Breakpoint ' . \strtoupper( explode( '.', $option )[1] );

      \add_settings_field( $option, $label, function () use ( $options, $option ) {

        echo \sprintf( '<input id="%s" name="%s" type="%s" value="%s" />',
          'theme_' . $option,
          $options->getName() . '[' . $option . ']',
          'number',
          $options->use( $option )
        );
      }, $options->getName(), 'theme_breakpoints' );
    }

    foreach ( $options->getFontSizeSettings() as $option => $value ) {

      $label = 'Size ' . \strtoupper( explode( '.', $option )[1] );

      \add_settings_field( $option, $label, function () use ( $options, $option ) {

        echo \sprintf( '<input id="%s" name="%s" type="%s" value="%s" />',
          'theme_' . $option,
          $options->getName() . '[' . $option . ']',
          'number',
          $options->use( $option )
        );
      }, $options->getName(), 'theme_fontsizes' );
    }
  }

  public function register () {

    $this->registrar->action( $this );
  }
}