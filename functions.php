<?php
/**
 * Load composer autoload.php
 */
if ( ! file_exists( $autoload = __DIR__ . '/vendor/autoload.php' ) ) {

  wp_die( __( 'Please run composer install or composer dump-autoload to generate composer vendor folder.', wp_get_theme()->get( 'TextDomain') ), 'Can not find composer autoload.php', [
    'response'  => 403,
    'back_link' => get_admin_url( 'admin.php?page=themes' )
  ]);
}

require $autoload;

/**
 * Bootstrap Theme
 */
$theme = new Chrillaz\WPScaffold\Includes\Bootstrap();

/**
 * Add public scripts and styles
 */
$theme->assets()->queue( function ( $asset ) {

  $asset->addStyle( 'main', [
    'src'          => $asset->src( '/assets/css/style.css' ),
    'dependencies' => [],
    'media'        => ''
  ]);

  wp_add_inline_style( 'main', $asset->getCustomProperties() );
  
  $asset->addScript( 'main', [
    'src'          => $asset->src( '/assets/js/main.min.js' ),
    'infooter'     => true,
    'dependencies' => [],
    'scriptexec'   => 'defer'
  ]);
});

/**
 * Add aditional support if needed
 */
$theme->hooks()->addAction( 'chrillaz/theme_supports', function () {
  /**
   * inspect theme supports within src/Includes/Bootstrap.php. 
   * 
   * Here we can define extra support if not included on Bootstrap themeSetup.
   */
});

/**
 * Run theme
 */
$theme->run();
