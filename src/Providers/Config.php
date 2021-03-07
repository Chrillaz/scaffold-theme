<?php

namespace WpTheme\Scaffold\Providers;

return $providers = [
  'register' => [
    'after_setup_theme'  => 'WpTheme\\Scaffold\\Providers\\SetupProvider'::class,
    'script_loader_tag'  => 'WpTheme\\Scaffold\\Providers\\ScriptexecProvider'::class,
    'wp_enqueue_scripts' => 'WpTheme\\Scaffold\\Providers\\PublicAssetsProvider'::class,
    // 'hook_name' => 'namespace\\ProviderclassName'::class,
  ],
  'unregister' => [
    // 'hook_name' => [ $component|string|array, $priority|int $args|int ],
  ]
];