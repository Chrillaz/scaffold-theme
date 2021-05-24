<?php

namespace WpTheme\Scaffold;

use \Scaffold\Essentials\Utilities as Util;

require __DIR__ . '/../vendor/autoload.php';

$app = \Scaffold\Essentials\Essentials::create([
  'basepath'   => \get_template_directory(),
  'publicpath' => \get_template_directory_uri() 
]);

$app->singleton( \WpTheme\Scaffold\Theme::class );

$theme = $app->make( \WpTheme\Scaffold\Theme::class, [
  'theme'     => \wp_get_theme( \get_Template() ),
  'container' => $app
]);

return $theme;