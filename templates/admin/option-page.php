<?php list( $theme, $options ) = $args; ?>

<div class="wrap">
  <h2><?php _e( 'THEME OPTIONS', $theme->get( 'TextDomain' ) ); ?></h2>
  <form method="post" action="options.php">
    <?php 
      settings_fields( $options->getName() ); 
      do_settings_sections( $options->getName() );
    ?>
    <section class="flex-container">
      <div class="flex-column-30">
        <table class="form-table" role="presentation">
          <p><?php _e( 'Enable gutenberg features.', $theme->get( 'TextDomain' ) ); ?></p>
          <tr valign="top">
            <td>
              <label>
                <input id="theme-block-styles" name="<?php echo $options->getName(); ?>[block-styles]" type="checkbox" value="1" <?php checked( '1', $options->get( 'block-styles' ) ); ?> />
                <?php _e( 'Enable block styles.', $theme->get( 'TextDomain' ) ); ?>
              </label>
            </td>
          </tr>
          <tr valign="top">
            <td>
              <label>
                <input id="theme-editor-styles" name="<?php echo $options->getName(); ?>[editor-styles]" type="checkbox" value="1" <?php checked( '1', $options->get( 'editor-styles' ) ); ?> />
                <?php _e( 'Enable editor styles.', $theme->get( 'TextDomain' ) ); ?>
              </label>
            </td>
          </tr>
          <tr valign="top">
            <td>
              <label>
                <input id="theme-align-wide" name="<?php echo $options->getName(); ?>[align-wide]" type="checkbox" value="1" <?php checked( '1', $options->get( 'align-wide' ) ); ?> />
                <?php _e( 'Enable wide and full alignments.', $theme->get( 'TextDomain' ) ); ?>
              </label>
            </td>
          </tr>
          <tr valign="top">
            <td>
              <label>
                <input id="theme-responsive-embeds" name="<?php echo $options->getName(); ?>[responsive-embeds]" type="checkbox" value="1" <?php checked( '1', $options->get( 'responsive-embeds' ) ); ?> />
                <?php _e( 'Enable responsive embeds.', $theme->get( 'TextDomain' ) ); ?>
              </label>
            </td>
          </tr>
          <tr valign="top">
            <td>
              <label>
                <input id="theme-custom-colors" name="<?php echo $options->getName(); ?>[custom-colors]" type="checkbox" value="1" <?php checked( '1', $options->get( 'disable-custom-colors' ) ); ?> />
                <?php _e( 'Enable custom colors.', $theme->get( 'TextDomain' ) ); ?>
              </label>
            </td>
          </tr>
          <tr valign="top">
            <td>
              <label>
                <input id="theme-disable-custom-gradients" name="<?php echo $options->getName(); ?>[disable-custom-gradients]" type="checkbox" value="1" <?php checked( '1', $options->get( 'disable-custom-gradients' ) ); ?> />
                <?php _e( 'Enable custom gradients.', $theme->get( 'TextDomain' ) ); ?>
              </label>
            </td>
          </tr>
          <tr valign="top">
            <td>
              <label>
                <input id="theme-disable-custom-font-sizes" name="<?php echo $options->getName(); ?>[disable-custom-font-sizes]" type="checkbox" value="1" <?php checked( '1', $options->get( 'disable-custom-font-sizes' ) ); ?> />
                <?php _e( 'Enable custom font sizes.', $theme->get( 'TextDomain' ) ); ?>
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
              <p><?php _e( 'Define theme color palette.', $theme->get( 'TextDomain' ) ); ?></p>
            </td>
          </tr>
          <tr>
            <th>
              <?php _e( 'Dark', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <input type="text" class="color-picker" name="<?php echo $options->getName(); ?>[color.dark]" id='color-picker' value="<?php echo $options->get( 'color.dark' ); ?>" />
            </td>
          </tr>
          <tr>
            <th>
              <?php _e( 'Primary Dark', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <input type="text" class="color-picker" name="<?php echo $options->getName(); ?>[color.primary-dark]" id='color-picker' value="<?php echo $options->get( 'color.primary-dark' ); ?>" />
            </td>
          </tr>
          <tr>
            <th>
              <?php _e( 'Primary', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <input type="text" class="color-picker" name="<?php echo $options->getName(); ?>[color.primary]" id='color-picker' value="<?php echo $options->get( 'color.primary' ); ?>" />
            </td>
          </tr>
          <tr>
            <th>
              <?php _e( 'Primary Light', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <input type="text" class="color-picker" name="<?php echo $options->getName(); ?>[color.primary-light]" id='color-picker' value="<?php echo $options->get( 'color.primary-light' ); ?>" />
            </td>
          </tr>
          <tr>
            <th>
              <?php _e( 'Secondary Dark', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <input type="text" class="color-picker" name="<?php echo $options->getName(); ?>[color.secondary-dark]" id='color-picker' value="<?php echo $options->get( 'color.secondary-dark' ); ?>" />
            </td>
          </tr>
          <tr>
            <th>
              <?php _e( 'Secondary', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <input type="text" class="color-picker" name="<?php echo $options->getName(); ?>[color.secondary]" id='color-picker' value="<?php echo $options->get( 'color.secondary' ); ?>" />
            </td>
          </tr>
          <tr>
            <th>
              <?php _e( 'Secondary Light', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <input type="text" class="color-picker" name="<?php echo $options->getName(); ?>[color.secondary-light]" id='color-picker' value="<?php echo $options->get( 'color.secondary-light' ); ?>" />
            </td>
          </tr>
          <tr>
            <th>
              <?php _e( 'Light', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <input type="text" class="color-picker" name="<?php echo $options->getName(); ?>[color.light]" id='color-picker' value="<?php echo $options->get( 'color.light' ); ?>" />
            </td>
          </tr><!-- end colors -->

          <tr valign="top">
            <th></th>
            <td>
              <p><?php _e( 'Define media breakpoint widths.', $theme->get( 'TextDomain' ) ); ?></p>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Media Breakpoint SM', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-media-sm" name="<?php echo $options->getName(); ?>[media.sm]" type="number" value="<?php echo absint( $options->get( 'media.sm' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Media Breakpoint MD', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-media-md" name="<?php echo $options->getName(); ?>[media.md]" type="number" value="<?php echo absint( $options->get( 'media.md' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Media Breakpoint LG', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-media-lg" name="<?php echo $options->getName(); ?>[media.lg]" type="number" value="<?php echo absint( $options->get( 'media.lg' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Media Breakpoint XL', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-media-xl" name="<?php echo $options->getName(); ?>[media.xl]" type="number" value="<?php echo absint( $options->get( 'media.xl' ) ); ?>" />
              </label>
            </td>
          </tr><!-- end breakpoints -->

          <tr valign="top">
            <th></th>
            <td>
              <p><?php _e( 'Define font sizes.', $theme->get( 'TextDomain' ) ); ?></p>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Font size H1', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-font-h1" name="<?php echo $options->getName(); ?>[font.h1]" type="number" value="<?php echo absint( $options->get( 'font.h1' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Font size H2', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-font-h2" name="<?php echo $options->getName(); ?>[font.h2]" type="number" value="<?php echo absint( $options->get( 'font.h2' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Font size H3', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-font-h3" name="<?php echo $options->getName(); ?>[font.h3]" type="number" value="<?php echo absint( $options->get( 'font.h3' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Font size H4', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-font-h4" name="<?php echo $options->getName(); ?>[font.h4]" type="number" value="<?php echo absint( $options->get( 'font.h4' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Font size H5', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-font-h5" name="<?php echo $options->getName(); ?>[font.h5]" type="number" value="<?php echo absint( $options->get( 'font.h5' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Font size H6', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-font-h6" name="<?php echo $options->getName(); ?>[font.h6]" type="number" value="<?php echo absint( $options->get( 'font.h6' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Font size Paragraph', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-font-paragraph" name="<?php echo $options->getName(); ?>[font.paragraph]" type="number" value="<?php echo absint( $options->get( 'font.paragraph' ) ); ?>" />
              </label>
            </td>
          </tr>
          <tr valign="top">
            <th>
              <?php _e( 'Font size Anchor', $theme->get( 'TextDomain' ) ); ?>
            </th>
            <td>
              <label>
                <input id="theme-font-anchor" name="<?php echo $options->getName(); ?>[font.anchor]" type="number" value="<?php echo absint( $options->get( 'font.anchor' ) ); ?>" />
              </label>
            </td>
          </tr>        
        </table>
      </div>
    </section>

    <?php submit_button(); ?>
  </form>
</div>