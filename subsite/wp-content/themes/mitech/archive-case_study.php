<?php
/**
 * The template for displaying archive case study pages.
 *
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mitech
 * @since   1.0
 */
get_header();

$style              = Mitech::setting( 'archive_case_study_style' );
$columns            = Mitech::setting( 'archive_case_study_columns' );
$gutter             = Mitech::setting( 'archive_case_study_gutter' );
$overlay_style      = Mitech::setting( 'archive_case_study_overlay_style' );
$caption_style      = Mitech::setting( 'archive_case_study_caption_style' );
$enable_popup_video = Mitech::setting( 'archive_case_study_popup_video_enable' );
?>
<?php Mitech_Templates::title_bar(); ?>
	<div id="page-content" class="page-content">

		<?php if ( Mitech::setting( 'archive_case_study_category_list' ) === '1' ) : ?>
			<?php get_template_part( 'components/case-study/category-list' ); ?>
		<?php endif; ?>

		<div class="container">
			<div class="row">

				<?php Mitech_Templates::render_sidebar( 'left' ); ?>

				<div class="page-main-content">
					<?php if ( have_posts() ) : ?>
						<?php
						$args = array();

						$args[] = 'style="' . $style . '"';
						$args[] = 'columns="' . $columns . '"';
						$args[] = 'gutter="' . $gutter . '"';
						$args[] = 'column_gutter="' . $gutter . '"';
						$args[] = 'row_gutter="' . $gutter . '"';
						$args[] = 'overlay_style="' . $overlay_style . '"';
						$args[] = 'caption_style="' . $caption_style . '"';
						$args[] = 'enable_popup_video="' . $enable_popup_video . '"';
						$args[] = 'pagination="pagination"';
						$args[] = 'pagination_align="center"';
						$args[] = 'filter_enable=""';
						$args[] = 'main_query="1"';

						$shortcode_string = '[tm_case_study ' . implode( ' ', $args ) . ']';

						echo do_shortcode( $shortcode_string );
						?>
					<?php else :
						get_template_part( 'components/content', 'none' );
					endif; ?>
				</div>

				<?php Mitech_Templates::render_sidebar( 'right' ); ?>

			</div>
		</div>
	</div>
<?php get_footer();
