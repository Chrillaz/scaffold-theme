<?php

namespace Scaffold\Theme;

use \Scaffold\Essentials\Utilities as Util;

require __DIR__ . '/../vendor/autoload.php';

$app = \Scaffold\Essentials\Essentials::create([
  'basepath'   => \get_template_directory(),
  'publicpath' => \get_template_directory_uri() 
]);

$app->singleton( \Scaffold\Theme\Theme::class );

$theme = $app->make( \Scaffold\Theme\Theme::class, [
  'theme'     => \wp_get_theme( \get_Template() ),
  'container' => $app
]);

return $theme;