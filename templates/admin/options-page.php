<?php list( $theme, $options ) = $args; ?>

<div class="wrap">
  <h2><?php _e( 'THEME OPTIONS', $theme->get( 'TextDomain' ) ); ?></h2>
  <form method="post" action="options.php">
    <?php 
      settings_fields( $options->getName() ); 
      do_settings_sections( $options->getName() );
    ?>
        <table class="form-table" role="presentation">
          <h3><?php _e( 'Theme Updates', $theme->get( 'TextDomain' ) ); ?></h3>
          <p><?php _e( 'Enable automatic uppdates.', $theme->get( 'TextDomain' ) ); ?></p>
          <tr>
            <th scope="row">
              <label for="theme-update-access"><?php _e( 'Enter token:', $theme->get( 'TextDomain' ) ); ?></label>
            </th>
            <td>
              <input id="theme-update-access" name="<?php echo $options->getName(); ?>[update-access]" type="text" value="<?php echo $options->get( 'update-access' ); ?>" class="regular-text" />
              <p><?php _e( 'A valid access token is required.', $theme->get( 'TextDomain' ) ); ?></p>
            </td>
          </tr>
        </table>

        <table class="form-table" role="presentation">
          <h3><?php _e( 'Gutenberg settings', $theme->get( 'TextDomain' ) ); ?></h3>
          <p><?php _e( 'Enable gutenberg features.', $theme->get( 'TextDomain' ) ); ?></p>
          <tr valign="top">
            <td>
              <label class="switch">
                <input id="theme-block-templates" name="<?php echo $options->getName(); ?>[block-templates]" type="checkbox" value="1" <?php checked( '1', $options->get( 'block-templates' ) ); ?> />
                <span class="slider round"></span>
              </label>
              <?php _e( 'Enable block templates. (as of 5.8 https://ithemes.com/wordpress-5-8/#ib-toc-anchor-3)', $theme->get( 'TextDomain' ) ); ?>
            </td>
          </tr>
          <tr valign="top">
            <td>
              <label class="switch">
                <input id="theme-block-styles" name="<?php echo $options->getName(); ?>[block-styles]" type="checkbox" value="1" <?php checked( '1', $options->get( 'block-styles' ) ); ?> />
                <span class="slider round"></span>
              </label>
              <?php _e( 'Enable block styles.', $theme->get( 'TextDomain' ) ); ?>
            </td>
          </tr>
          <tr valign="top">
            <td>
              <label class="switch">
                <input id="theme-editor-styles" name="<?php echo $options->getName(); ?>[editor-styles]" type="checkbox" value="1" <?php checked( '1', $options->get( 'editor-styles' ) ); ?> />
                <span class="slider round"></span>
              </label>
              <?php _e( 'Enable editor styles.', $theme->get( 'TextDomain' ) ); ?>
            </td>
          </tr>
          <tr valign="top">
            <td>
              <label class="switch">
                <input id="theme-align-wide" name="<?php echo $options->getName(); ?>[align-wide]" type="checkbox" value="1" <?php checked( '1', $options->get( 'align-wide' ) ); ?> />
                <span class="slider round"></span>
              </label>
              <?php _e( 'Enable wide and full alignments.', $theme->get( 'TextDomain' ) ); ?>
            </td>
          </tr>
          <tr valign="top">
            <td>
              <label class="switch">
                <input id="theme-responsive-embeds" name="<?php echo $options->getName(); ?>[responsive-embeds]" type="checkbox" value="1" <?php checked( '1', $options->get( 'responsive-embeds' ) ); ?> />
                <span class="slider round"></span>
              </label>
              <?php _e( 'Enable responsive embeds.', $theme->get( 'TextDomain' ) ); ?>
            </td>
          </tr>
        </table>

    <?php submit_button(); ?>
  </form>
</div>