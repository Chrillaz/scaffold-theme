<?php

namespace WpTheme\Scaffold;

require __DIR__ . '/../vendor/autoload.php';

$app = \Essentials\Essentials::create([
  'basepath'   => \get_template_directory(),
  'publicpath' => \get_template_directory_uri() 
]);

$app->singleton( \WpTheme\Scaffold\Theme::class );

$theme = $app->make( \WpTheme\Scaffold\Theme::class, [
  'theme'     => \wp_get_theme( \get_Template() ),
  'container' => $app
]);

return $theme;