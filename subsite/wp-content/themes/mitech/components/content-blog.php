<?php
/**
 * Template part for displaying blog content in home.php, archive.php.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mitech
 * @since   1.0
 */
$style = Mitech::setting( 'blog_archive_style', 'list' );

if ( have_posts() ) : ?>

	<?php if ( class_exists( 'Vc_Manager' ) ) { ?>
		<?php echo do_shortcode( '[tm_blog style="' . $style . '" main_query="1" gutter="30" number="9" pagination="pagination"]' ); ?>
	<?php } else { ?>
		<div class="tm-grid-wrapper tm-blog style-<?php echo esc_attr( $style ); ?>">
			<div class="tm-grid has-animation move-up"
			     data-grid-has-gallery="true"
			>
				<?php
				global $wp_query;
				$mitech_query = $wp_query;
				set_query_var( 'mitech_query', $mitech_query );

				get_template_part( 'loop/shortcodes/blog/style', $style );
				?>
			</div>
		</div>
		<div class="tm-grid-pagination">
			<?php Mitech_Templates::paging_nav(); ?>
		</div>
	<?php } ?>
<?php else : get_template_part( 'components/content', 'none' ); ?>
<?php endif; ?>
