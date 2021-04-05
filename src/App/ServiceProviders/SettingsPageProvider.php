<?php

namespace WpTheme\Scaffold\App\ServiceProviders;

use WpTheme\Scaffold\Framework\Interfaces\ProviderInterface;

class SettingsPageProvider implements ProviderInterface {

  public function register (): array {

    return [
      \wp_scripts(),
      'hello'
    ];
  }
}