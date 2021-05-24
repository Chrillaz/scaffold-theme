<?php

$theme = require __DIR__ . '/src/Bootstrap.php';

function Theme () {

  global $app;

  return $app->make( \Scaffold\Theme\Theme::class );
}