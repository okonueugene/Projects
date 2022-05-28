<?php
/**
 * The template for displaying the footer.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mitech
 * @since   1.0
 */

?>
</div><!-- /.content-wrapper -->

<?php Mitech_THA::instance()->footer_before(); ?>
<?php get_template_part( 'components/footer' ); ?>
<?php Mitech_THA::instance()->footer_after(); ?>

</div><!-- /.site -->

<?php Mitech_THA::instance()->body_bottom(); ?>

<?php wp_footer(); ?>
</body>
</html>
