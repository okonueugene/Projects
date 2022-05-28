<?php
/**
 * The template for displaying search results pages.
 *
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package  Mitech
 * @since    1.0
 */
get_header();
?>
<?php Mitech_Templates::title_bar(); ?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Mitech_Templates::render_sidebar( 'left' ); ?>

				<div class="page-main-content">
					<?php if ( Mitech_Helper::is_search_has_results() && 'above' === Mitech::setting( 'search_page_search_form_display' ) ) : ?>
						<div
							class="search-page-search-form <?php echo esc_attr( Mitech::setting( 'search_page_search_form_display' ) ); ?>">
							<?php get_search_form(); ?>
						</div>
					<?php endif; ?>

					<?php get_template_part( 'components/content', 'blog' ); ?>

					<?php if ( Mitech_Helper::is_search_has_results() && 'below' === Mitech::setting( 'search_page_search_form_display' ) ) : ?>
						<div
							class="search-page-search-form <?php echo esc_attr( Mitech::setting( 'search_page_search_form_display' ) ); ?>">
							<?php get_search_form(); ?>
						</div>
					<?php endif; ?>
				</div>

				<?php Mitech_Templates::render_sidebar( 'right' ); ?>

			</div>
		</div>
	</div>
<?php
get_footer();
