<?php

namespace WpTheme\Scaffold\Providers;

return [
  'register' => [
    'admin_menu'         => 'WpTheme\\Scaffold\\Providers\\SettingsPageProvider'::class,
    'admin_init'         => 'WpTheme\\Scaffold\\Providers\\SettingsProvider'::class,
    'after_setup_theme'  => 'WpTheme\\Scaffold\\Providers\\SetupProvider'::class,
    'script_loader_tag'  => 'WpTheme\\Scaffold\\Providers\\ScriptexecProvider'::class,
    'wp_enqueue_scripts' => 'WpTheme\\Scaffold\\Providers\\PublicAssetsProvider'::class,
    // 'hook_name' => 'namespace\\ProviderclassName'::class,
  ],
  'unregister' => [
    // 'hook_name' => [ $component|string|array, $priority|int ],
  ]
];