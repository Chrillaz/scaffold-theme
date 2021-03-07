<?php

namespace WpTheme\Scaffold\Providers;

return $providers = [
  'after_setup_theme' => 'WpTheme\\Scaffold\\Providers\\SetupProvider'::class,
  'script_loader_tag' => 'WpTheme\\Scaffold\\Providers\\ScriptloadProvider'::class,
];