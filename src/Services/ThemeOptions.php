<?php

namespace WpTheme\Scaffold\Services;

use WpTheme\Scaffold\Abstracts\Option;

class ThemeOptions extends Option {

  public function getSupportSettings () {

    return array_filter( $this->getDefault(), function ( $setting ) {
      
      return ! strpos( $setting, '.' );
    }, ARRAY_FILTER_USE_KEY );
  }

  public function getColorSettings () {

    return array_filter( $this->getDefault(), function ( $setting ) {
      
      return false !== strpos( $setting, 'color.' );
    }, ARRAY_FILTER_USE_KEY );
  }

  public function getBreakPointSettings () {

    return array_filter( $this->getDefault(), function ( $setting ) {
      
      return false !== strpos( $setting, 'media.' );
    }, ARRAY_FILTER_USE_KEY );
  }

  public function getFontSizeSettings () {

    return array_filter( $this->getDefault(), function ( $setting ) {
      
      return false !== strpos( $setting, 'font.' );
    }, ARRAY_FILTER_USE_KEY );
  }

  public function supportSection () {

    echo '<p>Add theme supports for gutenberg editor.</p>';
  }

  public function breakpointSection () {

    echo '<p>Define media query breakpoints.</p>';
  }

  public function fontsizeSection () {

    echo '<p>Define font sizes.</p>';
  }
}