<?php

namespace Chrillaz\WPScaffold\Integrations;

if ( ! defined( 'ABSPATH' ) ) exit;

use Chrillaz\WPScaffold\Interfaces\Integration;

class ExampleIntegration implements Integration {

  private $theme;

  public function __construct( $theme ) {

    $this->theme = $theme;
  }
}