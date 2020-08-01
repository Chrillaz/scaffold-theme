<!DOCTYPE html>

<html <?php language_attributes(); ?>>

  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, minimum-scale=1, user-scalable=no">

    <?php wp_head(); ?>
  </head>

  <body class="<?php body_class(); ?>">

  <?php wp_body_open(); ?>

    <div class="site">
  
    <?php
    /**
     * Functions hooked in theme_before_content
     * 
     * @hooked /templates/partials/site-navigation     20
     */ 
    theme_before_content(); ?>

      <main class="page" role="main">