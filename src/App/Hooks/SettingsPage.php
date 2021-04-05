<?php

namespace WpTheme\Scaffold\App\Hooks;

use WpTheme\Scaffold\Framework\Abstracts\Hook;

use WpTheme\Scaffold\Framework\Services\Storage;

class SettingsPage extends Hook {

  public function __construct( Storage $storage, \WP_Scripts $scripts, string $test ) {

  }

  /**
   * @type action
   * 
   * @priority 99
   */
  final public function adminMenu () {

  }
}