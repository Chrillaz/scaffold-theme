<?php

namespace WpTheme\Scaffold\App\Providers;

use WpTheme\Scaffold\Framework\Interfaces\ProviderInterface;

final class ScriptLoaderProvider implements ProviderInterface {

  public function register (): array {

    return [
      \wp_scripts()
    ];
  }
}