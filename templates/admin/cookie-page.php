<?php list( $theme, $options ) = $args; ?>

<div class="wrap">
  <h2><?php _e( 'COOKIE SETTINGS', $theme->get( 'TextDomain' ) ); ?></h2>

  <form method="post" action="options.php">
    <?php 
      settings_fields( $options->getName() ); 
      do_settings_sections( $options->getName() );
    ?>
    <section class="flex-container">
      <div class="flex-column-30">
        <table class="form-table" role="presentation">
          <p><?php _e( 'Edit the contents of cookiebar.', $theme->get( 'TextDomain' ) ); ?></p>
          <?php wp_editor( 
            esc_html( __( $options->get( 'content' ), $theme->get( 'TextDomain' ) ) ),
            'cookieEditor',
            [
              'tinymce'       => true,
              'textarea_name' => $options->getName() . '[content]',
              'textarea_rows' => 5,
              'tabindex'      => 1,
              'media_buttons' => false,
              'quicktags' => true,
              'tinymce'   => true
            ]
          ); ?>
          
          <tr valign="top">
            <td>
              <label class="switch"><?php _e( 'Accept Button text: ', $theme->get( 'TextDomain' ) ); ?></label>
              <input id="cookie-btn" name="<?php echo $options->getName(); ?>[buttonText]" type="text" value="<?php _e( esc_html( $options->get( 'buttonText' ), $theme->get( 'TextDomain' ) ) ); ?>" />
            </td>
          </tr>
        </table>
      </div>
    </section>
    <?php submit_button(); ?>
  </form>
</div>