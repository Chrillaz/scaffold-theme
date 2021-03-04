<?php

namespace WpTheme\Scaffold\Services;

class Logger {

  public function __construct ( string $code, \Exception $error ) {

    \wp_die( 
      '<h2>' . $error->getMessage() . '</h2> \n' . $error->getTraceAsString(),
      'Container exception',
      [
        'response'  => 501,
        'back_link' => true,
        'code'      => $code
      ]
    );
  }
}