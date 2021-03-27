<?php use WpTheme\Scaffold\Theme; ?>

<div class="wrap">
  <h2><?php _e( 'THEME OPTIONS', Theme::get( 'TextDomain' ) ); ?></h2>
  <form method="post" action="options.php">
    <?php 
      settings_fields( 'theme_options' ); 
      do_settings_sections( 'theme_options' );
    ?>
    <section class="flex-container">
      <div class="flex-column-30">
        <table class="form-table" role="presentation">
          <p><?php _e( 'Enable gutenberg features.', Theme::get( 'TextDomain' ) ); ?></p>
          <tr valign="top">
            <td>
              <label>
                <input id="theme-block-styles" name="theme_options[block-styles]" type="checkbox" value="1" <?php checked( '1', $options->use( 'block-styles' ) ); ?> />
                <?php _e( 'Enable block styles.', Theme::get( 'TextDomain' ) ); ?>
              </label>
            </td>
          </tr>
          <tr valign="top">
            <td>
              <label>
                <input id="theme-editor-styles" name="theme_options[editor-styles]" type="checkbox" value="1" <?php checked( '1', $options->use( 'editor-styles' ) ); ?> />
                <?php _e( 'Enable editor styles.', Theme::get( 'TextDomain' ) ); ?>
              </label>
            </td>
          </tr>
          <tr valign="top">
            <td>
              <label>
                <input id="theme-align-wide" name="theme_options[align-wide]" type="checkbox" value="1" <?php checked( '1', $options->use( 'align-wide' ) ); ?> />
                <?php _e( 'Enable wide and full alignments.', Theme::get( 'TextDomain' ) ); ?>
              </label>
            </td>
          </tr>
          <tr valign="top">
            <td>
              <label>
                <input id="theme-responsive-embeds" name="theme_options[responsive-embeds]" type="checkbox" value="1" <?php checked( '1', $options->use( 'responsive-embeds' ) ); ?> />
                <?php _e( 'Enable responsive embeds.', Theme::get( 'TextDomain' ) ); ?>
              </label>
            </td>
          </tr>
          <tr valign="top">
            <td>
              <label>
                <input id="theme-custom-colors" name="theme_options[custom-colors]" type="checkbox" value="1" <?php checked( '1', $options->use( 'disable-custom-colors' ) ); ?> />
                <?php _e( 'Enable custom colors.', Theme::get( 'TextDomain' ) ); ?>
              </label>
            </td>
          </tr>
          <tr valign="top">
            <td>
              <label>
                <input id="theme-disable-custom-gradients" name="theme_options[disable-custom-gradients]" type="checkbox" value="1" <?php checked( '1', $options->use( 'disable-custom-gradients' ) ); ?> />
                <?php _e( 'Enable custom gradients.', Theme::get( 'TextDomain' ) ); ?>
              </label>
            </td>
          </tr>
          <tr valign="top">
            <td>
              <label>
                <input id="theme-disable-custom-font-sizes" name="theme_options[disable-custom-font-sizes]" type="checkbox" value="1" <?php checked( '1', $options->use( 'disable-custom-font-sizes' ) ); ?> />
                <?php _e( 'Enable custom font sizes.', Theme::get( 'TextDomain' ) ); ?>
              </label>
            </td>
          </tr>
        </table>
      </div>
      <div class="flex-column-70 pl border-left">
        <table class="form-table colors" role="presentation">
          <tr valign="top">
            <th></th>
            <td>
              <p><?php _e( 'Define theme color palette.', Theme::get( 'TextDomain' ) ); ?></p>
            </td>
          </tr>
          <tr>
            <th>
              <?php _e( 'Dark', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <input type="text" class="color-picker" name="theme_options[color.dark]" id='color-picker' value="<?php echo $options->use( 'color.dark' ); ?>" />
            </td>
          </tr>
          <tr>
            <th>
              <?php _e( 'Primary Dark', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <input type="text" class="color-picker" name="theme_options[color.primary-dark]" id='color-picker' value="<?php echo $options->use( 'color.primary-dark' ); ?>" />
            </td>
          </tr>
          <tr>
            <th>
              <?php _e( 'Primary', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <input type="text" class="color-picker" name="theme_options[color.primary]" id='color-picker' value="<?php echo $options->use( 'color.primary' ); ?>" />
            </td>
          </tr>
          <tr>
            <th>
              <?php _e( 'Primary Light', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <input type="text" class="color-picker" name="theme_options[color.primary-light]" id='color-picker' value="<?php echo $options->use( 'color.primary-light' ); ?>" />
            </td>
          </tr>
          <tr>
            <th>
              <?php _e( 'Secondary Dark', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <input type="text" class="color-picker" name="theme_options[color.secondary-dark]" id='color-picker' value="<?php echo $options->use( 'color.secondary-dark' ); ?>" />
            </td>
          </tr>
          <tr>
            <th>
              <?php _e( 'Secondary', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <input type="text" class="color-picker" name="theme_options[color.secondary]" id='color-picker' value="<?php echo $options->use( 'color.secondary' ); ?>" />
            </td>
          </tr>
          <tr>
            <th>
              <?php _e( 'Secondary Light', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <input type="text" class="color-picker" name="theme_options[color.secondary-light]" id='color-picker' value="<?php echo $options->use( 'color.secondary-light' ); ?>" />
            </td>
          </tr>
          <tr>
            <th>
              <?php _e( 'Light', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <input type="text" class="color-picker" name="theme_options[color.light]" id='color-picker' value="<?php echo $options->use( 'color.light' ); ?>" />
            </td>
          </tr><!-- end colors -->

          <tr valign="top">
            <th></th>
            <td>
              <p><?php _e( 'Define media breakpoint widths.', Theme::get( 'TextDomain' ) ); ?></p>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Media Breakpoint SM', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-media-sm" name="theme_options[media.sm]" type="number" value="<?php echo absint( $options->use( 'media.sm' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Media Breakpoint MD', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-media-md" name="theme_options[media.md]" type="number" value="<?php echo absint( $options->use( 'media.md' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Media Breakpoint LG', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-media-lg" name="theme_options[media.lg]" type="number" value="<?php echo absint( $options->use( 'media.lg' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Media Breakpoint XL', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-media-xl" name="theme_options[media.xl]" type="number" value="<?php echo absint( $options->use( 'media.xl' ) ); ?>" />
              </label>
            </td>
          </tr><!-- end breakpoints -->

          <tr valign="top">
            <th></th>
            <td>
              <p><?php _e( 'Define font sizes.', Theme::get( 'TextDomain' ) ); ?></p>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Font size H1', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-font-h1" name="theme_options[font.h1]" type="number" value="<?php echo absint( $options->use( 'font.h1' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Font size H2', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-font-h2" name="theme_options[font.h2]" type="number" value="<?php echo absint( $options->use( 'font.h2' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Font size H3', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-font-h3" name="theme_options[font.h3]" type="number" value="<?php echo absint( $options->use( 'font.h3' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Font size H4', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-font-h4" name="theme_options[font.h4]" type="number" value="<?php echo absint( $options->use( 'font.h4' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Font size H5', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-font-h5" name="theme_options[font.h5]" type="number" value="<?php echo absint( $options->use( 'font.h5' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Font size H6', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-font-h6" name="theme_options[font.h6]" type="number" value="<?php echo absint( $options->use( 'font.h6' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Font size Paragraph', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-font-paragraph" name="theme_options[font.paragraph]" type="number" value="<?php echo absint( $options->use( 'font.paragraph' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Font size Anchor', Theme::get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-font-anchor" name="theme_options[font.anchor]" type="number" value="<?php echo absint( $options->use( 'font.anchor' ) ); ?>" />
              </label>
            </td>
          </tr>        
        </table>
      </div>
    </section>

    <?php submit_button(); ?>
  </form>
</div>