<?php use WpTheme\Scaffold\Theme; ?>

<div class="wrap">
  <h2>HELLO SETTINGS</h2>
  <form method="post" action="options.php">
    <table class="form-table" role="presentation">
      <?php 
        settings_fields( get_template() . '-options' ); 
        do_settings_sections( get_template() . '-options' ); 
      ?>
			<tr valign="top">
				<td>
					<label>
						<input name="theme-block-styles" type="checkbox" value="1" <?php checked( '1', get_option( 'block-styles' ) ); ?> />
						<?php _e( 'Enable block styles.', Theme::get( 'TextDomain' ) ); ?>
					</label>
				</td>
			</tr>
      <tr valign="top">
				<td>
					<label>
						<input name="theme-editor-styles" type="checkbox" value="1" <?php checked( '1', get_option( 'editor-styles' ) ); ?> />
						<?php _e( 'Enable editor styles.', Theme::get( 'TextDomain' ) ); ?>
					</label>
				</td>
			</tr>
      <tr valign="top">
				<td>
					<label>
						<input name="theme-align-wide" type="checkbox" value="1" <?php checked( '1', get_option( 'align-wide' ) ); ?> />
						<?php _e( 'Enable wide and full alignments.', Theme::get( 'TextDomain' ) ); ?>
					</label>
				</td>
			</tr>
      <tr valign="top">
				<td>
					<label>
						<input name="theme-responsive-embeds" type="checkbox" value="1" <?php checked( '1', get_option( 'responsive-embeds' ) ); ?> />
						<?php _e( 'Enable responsive embeds.', Theme::get( 'TextDomain' ) ); ?>
					</label>
				</td>
			</tr>
      <tr valign="top">
				<td>
					<label>
						<input name="theme-custom-colors" type="checkbox" value="1" <?php checked( '1', get_option( 'disable-custom-colors' ) ); ?> />
						<?php _e( 'Enable custom colors.', Theme::get( 'TextDomain' ) ); ?>
					</label>
				</td>
			</tr>
      <tr valign="top">
				<td>
					<label>
						<input name="theme-custom-gradients" type="checkbox" value="1" <?php checked( '1', get_option( 'disable-custom-gradients' ) ); ?> />
						<?php _e( 'Enable custom gradients.', Theme::get( 'TextDomain' ) ); ?>
					</label>
				</td>
			</tr>
      <tr valign="top">
				<td>
					<label>
						<input name="theme-custom-fonnt-sizes" type="checkbox" value="1" <?php checked( '1', get_option( 'disable-custom-font-sizes' ) ); ?> />
						<?php _e( 'Enable custom font sizes.', Theme::get( 'TextDomain' ) ); ?>
					</label>
				</td>
			</tr>
    </table>
    <?php submit_button(); ?>
  </form>
</div>