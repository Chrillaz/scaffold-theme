<?php

namespace WpTheme\Scaffold\App\Providers;

use WpTheme\Scaffold\Framework\Services\Storage;

use WpTheme\Scaffold\Framework\Interfaces\ProviderInterface;

final class ThemeOptionProvider implements ProviderInterface {

  public function register (): array {

    $settings = \json_decode(
      \file_get_contents(
        \get_template_directory() . '/settings.json'
      ),
      true
    );

    return [
      'theme_option',
      new Storage( $settings['settings'] )
    ];
  }
}