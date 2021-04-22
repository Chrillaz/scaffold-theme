<?php

namespace WpTheme\Scaffold\App\Providers;

use WpTheme\Scaffold\Framework\Resources\Storage;

use WpTheme\Scaffold\Framework\Interfaces\ProviderInterface;

final class ThemeOptionProvider implements ProviderInterface {

  public function register (): array {

    $settings = \json_decode(
      \file_get_contents(
        \get_template_directory() . '/config/theme.json'
      ),
      true
    );

    return [
      'default'    => new Storage( $settings['settings'] ),
      'name'       => 'theme_option',
      'capability' => 'edit_themes'
    ];
  }
}