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
 * Add scripts and styles
 */
$theme->assets()->enqueue( function ( $self ) {

  $self->addStyle( 'main', [
    'src'          => $self->src( '/assets/css/style.css' ),
    'dependencies' => [],
    'media'        => ''
  ]);
  
  $self->addScript( 'main', [
    'src'          => $self->src( '/assets/js/main.min.js' ),
    'infooter'     => true,
    'dependencies' => [],
    'scriptexec'   => ''
  ]);
});

/**
 * Add aditional support if needed
 */
$theme->loader()->addAction( 'chrillaz/theme_supports', function () {
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
