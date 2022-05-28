<div class="grid-sizer"></div>
<?php
while ( $mitech_query->have_posts() ) :
	$mitech_query->the_post();
	$classes = array( 'grid-item', 'post-item' );
	$format  = Mitech_Post::instance()->get_the_post_format();
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper">

			<?php get_template_part( 'loop/blog/masonry/format', $format ); ?>

			<div class="post-info">

				<div class="post-meta">

					<?php get_template_part( 'loop/blog/date' ); ?>

					<?php Mitech_Post::instance()->view_count(); ?>

				</div>

				<?php get_template_part( 'loop/blog/title' ); ?>

				<div class="post-excerpt">
					<?php Mitech_Templates::excerpt( array(
						'limit' => 18,
						'type'  => 'word',
					) ); ?>
				</div>

				<a href="<?php Mitech_Case_Study::instance()->the_permalink() ?>" class="btn">
					<span class="btn-text">
							<?php esc_html_e( 'Read more', 'mitech' ); ?>
						</span>
					<span class="btn-icon fa fa-long-arrow-right"></span>
				</a>

			</div>

		</div>
	</div>
<?php endwhile;
