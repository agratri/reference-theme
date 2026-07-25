   <?php
      /**
       * Mirrors header.php, which fires 'header_before' rather than printing markup
       * directly. kindaid_footer() is hooked to this action in include/theme-helper.php
       * at priority 10, so plugins can inject before or after the footer by using a
       * lower or higher priority.
       */
      do_action('footer_before');
   ?>


   <?php wp_footer(); ?>
</body>

</html>
