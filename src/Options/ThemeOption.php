<?php

namespace Scaffold\Theme\Options;

use \Scaffold\Essentials\Essentials;

use \Scaffold\Essentials\Abstracts\Option;

use \Scaffold\Essentials\Contracts\OptionInterface;

final class ThemeOption extends Option implements OptionInterface 
{

  public static function register( Essentials $container ): OptionInterface 
  {

    return new Self( 
      $container['option.theme.name'],
      $container['option.theme.capability'],
      $container['option.theme.default']
    );
  }
}