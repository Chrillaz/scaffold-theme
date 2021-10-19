<?php

namespace Scaffold\Theme\Options;

use \Scaffold\Essentials\Essentials;

use \Scaffold\Essentials\Abstracts\Option;

use \Scaffold\Essentials\Contracts\OptionInterface;

final class CookieOption extends Option implements OptionInterface 
{

  public static function register( Essentials $container ): OptionInterface 
  {

    return new Self( 
      $container['option.cookie.name'],
      $container['option.cookie.capability'],
      $container['option.cookie.default']
    );
  }
}