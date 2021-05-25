<?php

$theme = require __DIR__ . '/src/Bootstrap.php';

function Theme () {

  global $app;

  return $app->make( \Scaffold\Theme\Theme::class );
}
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======

$cache = Theme()->container()->make(\Scaffold\Essentials\Contracts\CacheInterface::class);

$cache->set( 'test', 'hej', 'testgroup' );

var_dump('<pre>', $cache, '</pre>');
>>>>>>> cache test
=======
>>>>>>> fix
=======
>>>>>>> 0b6ffc1fa05f26849c818cd8c60b3ab0d54d8b15
