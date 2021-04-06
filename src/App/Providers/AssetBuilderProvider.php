<?php

namespace WpTheme\Scaffold\App\Providers;

use WpTheme\Scaffold\Framework\Interfaces\ProviderInterface;

final class AssetBuilderProvider implements ProviderInterface {

  public function register (): array {

    return [
      \wp_scripts(),
      \wp_styles()
    ];
  }
}