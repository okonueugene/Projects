<?php
/**
 * The template for displaying all single case study posts.
 *
 * @package Mitech
 * @since   1.0
 */
get_header();

$style = Mitech_Helper::get_post_meta( 'case_study_layout_style', '' );
if ( $style === '' ) {
	$style = Mitech::setting( 'single_case_study_style' );
}
?>
<?php Mitech_Templates::title_bar(); ?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Mitech_Templates::render_sidebar( 'left' ); ?>

				<div class="page-main-content">
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<h2 class="screen-reader-text"><?php echo esc_html( get_the_title() ); ?></h2>

							<?php get_template_part( 'components/case-study/single/style', $style ); ?>
						</article>

						<?php if ( Mitech::setting( 'single_case_study_related_enable' ) === '1' ) : ?>
							<?php get_template_part( 'components/case-study/related' ); ?>
						<?php endif; ?>

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( Mitech::setting( 'single_case_study_comment_enable' ) === '1' && ( comments_open() || get_comments_number() ) ) :
							comments_template();
						endif;
						?>
					<?php endwhile; ?>
				</div>

				<?php Mitech_Templates::render_sidebar( 'right' ); ?>

			</div>
		</div>

		<?php
		if ( Mitech::setting( 'single_case_study_pagination_enable' ) === '1' ) {
			Mitech_Case_Study::instance()->nav_page_links();
		}
		?>
	</div>
<?php
get_footer();
