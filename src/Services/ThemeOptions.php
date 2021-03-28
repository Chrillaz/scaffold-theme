<?php

namespace WpTheme\Scaffold\Services;

use WpTheme\Scaffold\Abstracts\Option;

class ThemeOptions extends Option {

  public function getSupports () {

    return array_filter( $this->getDefault(), function ( $setting ) {
      
      return ! strpos( $setting, '.' );
    }, ARRAY_FILTER_USE_KEY );
  }

  public function getColors () {

    return array_filter( $this->getDefault(), function ( $setting ) {
      
      return false !== strpos( $setting, 'color.' );
    }, ARRAY_FILTER_USE_KEY );
  }

  public function getBreakpoints () {

    return array_filter( $this->getDefault(), function ( $setting ) {
      
      return false !== strpos( $setting, 'media.' );
    }, ARRAY_FILTER_USE_KEY );
  }

  public function getFontsizes () {

    return array_filter( $this->getDefault(), function ( $setting ) {
      
      return false !== strpos( $setting, 'font.' );
    }, ARRAY_FILTER_USE_KEY );
  }
}