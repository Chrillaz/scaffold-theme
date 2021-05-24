<?php

namespace Scaffold\Theme\Options;

use \Scaffold\Essentials\Essentials;

use \Scaffold\Essentials\Abstracts\Option;

use \Scaffold\Essentials\Contracts\OptionInterface;

final class ThemeOption extends Option implements OptionInterface {

  public function getGroup ( string $group ): array {

    return array_filter( $this->getOption(), function ( $key ) use ( $group ) {

      return false !== strpos( $key, "$group." );
    }, ARRAY_FILTER_USE_KEY );
  }

  public static function register ( Essentials $container ): OptionInterface {

    return new Self( 
      $container['option.theme.name'],
      $container['option.theme.capability'],
      array_merge( $container['theme.styles'], $container['theme.supports'] )
    );
  }
}