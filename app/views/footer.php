<?php

    theme_after_content(); ?>

    </main><!-- end .page -->

      <?php theme_before_footer(); ?>

      <footer></footer>

      <?php 
      /**
       * Functions hooked in theme_after_footer
       * 
       * @hooked /templates/partials/site-credit     10 
       */  
      theme_after_footer(); ?>

    </div><!-- end .site -->
    
    <?php wp_footer(); ?>

  </body>
</html>