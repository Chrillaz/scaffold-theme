<?php

namespace Chrillaz\WPScaffold\Interfaces;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * @property Chrillaz\WPScaffols\Theme $theme
 */
interface Integration {

  public function __construct ( object $theme );
}