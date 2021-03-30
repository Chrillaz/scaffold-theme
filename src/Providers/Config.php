<?php

namespace WpTheme\Scaffold\Providers;

return [
  'register' => [
    'admin_menu'            => 'WpTheme\\Scaffold\\Providers\\Admin\\SettingsPageProvider'::class,
    'admin_init'            => 'WpTheme\\Scaffold\\Providers\\Admin\\SettingsProvider'::class,
    'admin_enqueue_scripts' => 'WpTheme\\Scaffold\\Providers\\Admin\\AdminAssetsProvider'::class,
    'after_setup_theme'     => 'WpTheme\\Scaffold\\Providers\\App\\SetupProvider'::class,
    'script_loader_tag'     => 'WpTheme\\Scaffold\\Providers\\App\\ScriptexecProvider'::class,
    'wp_enqueue_scripts'    => 'WpTheme\\Scaffold\\Providers\\App\\PublicAssetsProvider'::class,
    // 'hook_name'          => 'namespace\\ProviderclassName'::class,
  ],
  'unregister' => [
    // 'hook_name' => [ $component|string|array, $priority|int ],
  ]
];