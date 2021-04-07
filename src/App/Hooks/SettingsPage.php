<?php

namespace WpTheme\Scaffold\App\Hooks;

use WpTheme\Scaffold\Framework\Abstracts\Hooks;

final class SettingsPage extends Hooks {

  public function adminMenu () {

  }

  public function register (): void {

    $this->hooks->addAction( 'admin_menu', 'adminMenu', $this );

    $this->hooks->load();
  }
}