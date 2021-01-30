<?php

namespace Chrillaz\WPScaffold\Interfaces;

if ( ! defined( 'ABSPATH' ) ) exit;

interface Factory {

  /**
   * create
   * 
   * Registers and instanciates theme integrations
   * 
   * @param Theme $theme
   * 
   * @param array $integrations
   * 
   * @return void
   */
  public static function create ( object $theme, array $integrations ): void;

  /**
   * getIntegrations
   * 
   * Returns any array of theme integrations
   * 
   * @return array
   */
  public static function getIntegrations (): array;
}