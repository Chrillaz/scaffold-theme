<?php
/**
 * Header template
 */ ?>
<!DOCTYPE html>
  <html <?php esc_attr_e( language_attributes() ); ?>>
    <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, minimum-scale=1, user-scalable=no" />
      <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
  
    <?php 
      wp_body_open(); ?>

      <main id="main" class="main" role="main">

