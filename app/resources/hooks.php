<?php

/**
 * Theme template hooks
 */


/**
 * Content wrapper before after Hooks
 */
if (!function_exists('theme_before_content')) {

  function theme_before_content () {

    do_action('theme_before_content');
  }
}

if (!function_exists('theme_after_content')) {

  function theme_after_content () {

    do_action('theme_after_content');
  }
}

/**
 * Single template Hooks
 */
if (!function_exists('theme_before_single_content')) {

  function theme_before_single_content () {

    do_action('theme_before_single_content');
  }
}

if (!function_exists('theme_after_single_content')) {

  function theme_after_single_content () {

    do_action('theme_after_single_content');
  }
}

/**
 * Footer template Hooks
 */
if (!function_exists('theme_before_footer')) {

  function theme_before_footer () {

    do_action('theme_before_footer');
  }
}

if (!function_exists('theme_after_footer')) {

  function theme_after_footer () {

    do_action('theme_after_footer');
  }
}