<?php

namespace WpTheme\Scaffold\App\Options;

use WpTheme\Scaffold\Core\Theme;

use WpTheme\Scaffold\Core\Abstracts\Option;

use WpTheme\Scaffold\Core\Contracts\OptionInterface; 

final class ThemeOption extends Option implements OptionInterface {

  public function getGroup ( string $group ): array {

    return array_filter( $this->getOption(), function ( $key ) use ( $group ) {

      return false !== strpos( $key, "$group." );
    }, ARRAY_FILTER_USE_KEY );
  }

  public static function register ( Theme $theme ) {

    return new Self( 
      'theme_option',
      'edit_themes',
      array_merge( $theme['theme.styles'], $theme['theme.supports'] )
    );
  }
}