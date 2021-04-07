<?php

namespace WpTheme\Scaffold\App\Hooks;

use WpTheme\Scaffold\Framework\Abstracts\Hooks;

class SettingsPage extends Hooks {

  /**
   * @type action
   * 
   * @priority 99
   */
  final public function adminMenu () {

  }

  public function register (): void {

    $this->hooks->addAction( 'admin_menu', 'adminMenu', $this );

    $this->hooks->load();
  }
}