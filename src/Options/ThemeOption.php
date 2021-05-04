<?php

namespace WpTheme\Scaffold\Options;

use \Essentials\Essentials;

use \Essentials\Abstracts\Option;

use \Essentials\Contracts\OptionInterface;

final class ThemeOption extends Option implements OptionInterface {

  public static function register ( Essentials $container ): OptionInterface {

    return new Self( 
      $container[],
      $container[],
      $container[]
     );
  }
}