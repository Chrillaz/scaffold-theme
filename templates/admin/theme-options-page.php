<?php use WpTheme\Scaffold\Theme; ?>

<div class="wrap">
  <h2>Theme Settings</h2>
  <form method="post" action="options.php">
    <?php
      settings_fields( 'theme_options' ); 
      do_settings_sections( 'theme_options' ); 
      submit_button(); 
    ?>
  </form>
</div>