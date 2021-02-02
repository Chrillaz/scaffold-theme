<?php

namespace Chrillaz\WPScaffold\Includes;

use Chrillaz\WPScaffold\Includes\Style;

class Script extends Style {

  public $execution;

  public $infooter;

  public function __construct ( $handle, $args ) {

    parent::__construct( $handle, $args );

    $this->execution = $this->isValidExec( $args );

    $this->infooter = ( $args['infooter'] !== null ? $args['infooter'] : true );
  }

  private function isValidExec ( array $args ) {
    
    if ( ! isset( $args['execution'] ) ) {

      return;
    }

    if ( 'defer' === $args['execution'] || 'async' === $args['execution'] ) {

      return $args['execution'];
    }
  }
}