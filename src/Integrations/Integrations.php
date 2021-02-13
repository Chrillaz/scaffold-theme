<?php

namespace WPTheme\Scaffold\Integrations;

class Integrations {

  public static $integrations = [];

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
  public static function create ( object $theme, array $integrations ) {

    self::$integrations = array_merge( self::$integrations,

      array_map( function ( $integration ) use ( $theme ) {

        if ( ! class_exists( $integration ) ) {

          wp_die( __ ( $integration . ' is not supported by theme.', $theme->get( 'TextDomain' ) ), 'No support for ' . $integration, [
            'response'  => 403,
            'back_link' => get_admin_url( 'admin.php?page=themes' )
          ]);
        }

        return new $integration( $theme );
      }, $integrations )
    );
  }

  /**
   * getIntegrations
   * 
   * Returns any array of theme integrations
   * 
   * @return array
   */
  public static function getIntegrations (): array {

    return self::$integrations;
  }
}