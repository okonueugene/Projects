<?php
/**
 * Template part for displaying single post pages.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mitech
 * @since   1.0
 */

$_post_title = Mitech::setting( 'single_post_title_enable' );
$format      = Mitech_Post::instance()->get_the_post_format();
$sidebar     = Mitech_Global::instance()->get_sidebar_status();
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-wrapper' ); ?>>

		<h2 class="screen-reader-text"><?php echo esc_html( get_the_title() ); ?></h2>

		<?php if ( $sidebar !== 'none' && Mitech::setting( 'single_post_feature_enable' ) === '1' ) : ?>
			<?php get_template_part( 'components/blog-single/standard/format', $format ); ?>
		<?php endif; ?>

		<div class="entry-header">
			<?php if ( Mitech::setting( 'single_post_categories_enable' ) === '1' && has_category() ) : ?>
				<div class="entry-post-categories">
					<?php the_category( ' / ' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( $_post_title === '1' ) : ?>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php endif; ?>

			<?php if ( is_singular( 'post' ) ) : ?>
				<?php get_template_part( 'components/blog-single/meta' ); ?>
			<?php endif; ?>
		</div>

		<div class="entry-content">
			<?php
			the_content( sprintf( /* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'mitech' ), array( 'span' => array( 'class' => array() ) ) ), the_title( '<span class="screen-reader-text">"', '"</span>', false ) ) );

			Mitech_Templates::page_links();
			?>
		</div>

		<div class="entry-footer">
			<div class="row row-xs-center">
				<div class="col-md-6">
					<?php if ( Mitech::setting( 'single_post_tags_enable' ) === '1' && has_tag() ) : ?>
						<div class="entry-post-tags">
							<div class="tagcloud-icon">
								<span class="far fa-tags"></span>
							</div>
							<div class="tagcloud">
								<?php the_tags( '', ', ', '' ); ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<div class="col-md-6">
					<?php if ( Mitech::setting( 'single_post_share_enable' ) === '1' ) : ?>
						<?php Mitech_Templates::post_sharing(); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>

	</article>
<?php
$author_desc = get_the_author_meta( 'description' );
if ( Mitech::setting( 'single_post_author_box_enable' ) === '1' && ! empty( $author_desc ) ) {
	Mitech_Templates::post_author();
}

if ( Mitech::setting( 'single_post_pagination_enable' ) === '1' ) {
	Mitech_Post::instance()->nav_page_links();
}

if ( Mitech::setting( 'single_post_related_enable' ) ) {
	get_template_part( 'components/blog-single/content-related-posts' );
}

// If comments are open or we have at least one comment, load up the comment template.
if ( Mitech::setting( 'single_post_comment_enable' ) === '1' && ( comments_open() || get_comments_number() ) ) :
	comments_template();
endif;
