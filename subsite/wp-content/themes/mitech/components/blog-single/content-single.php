<?php
/**
 * Template part for displaying blog content in single.php.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mitech
 * @since   1.0
 */

$sidebar = Mitech_Global::instance()->get_sidebar_status();
?>
<div id="page-content" class="page-content">

	<?php if ( $sidebar === 'none' && Mitech::setting( 'single_post_feature_enable' ) === '1' ) : ?>
		<div class="entry-feature">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<?php $format = Mitech_Post::instance()->get_the_post_format(); ?>
						<?php get_template_part( 'components/blog-single/no-sidebar/format', $format ); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="container">
		<div class="row">

			<?php Mitech_Templates::render_sidebar( 'left' ); ?>

			<div class="page-main-content">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'components/blog-single/style', 'standard' );

				endwhile;
				?>
			</div>

			<?php Mitech_Templates::render_sidebar( 'right' ); ?>

		</div>
	</div>
</div>
