<div class="wrap">
  <h2>HELLO SETTINGS</h2>
  <form>
    <table class="form-table" role="presentation">
      <tbody>
        <?php foreach( WpTheme\Scaffold\Theme::storage()->get( 'settings')['support'] as $name => $setting ) {
          echo '<tr>';
          echo '<th><label>' . $name . '</label>';
          echo '<td><input type="checkbox" name="' . $name . '" value="1"' . checked( $setting, true, false ) . ' /></td>';
          echo '</tr>';
        } ?>
      </tbody>
    </table>
  </form>
</div>