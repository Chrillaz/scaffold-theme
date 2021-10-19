<?php 
/**
 * Footer template
 */ ?>
    </div><!-- end .site-wrapper -->
  </main><!-- end main -->
  <footer>
    <div class="site-wrapper">
      <?php do_action( 'scaffold/footer' ); ?>
    </div>
    <div>
      <small><?php siteCred(); ?></small>
      <small>&copy; Copyright <?php echo Date('Y'); ?></small>
    </div>
  </footer>
<?php wp_footer(); ?>
</body><!-- end body -->
</html><!-- end html -->