<?php
while ( $mitech_query->have_posts() ) :
	$mitech_query->the_post();
	$classes = array( 'grid-item', 'post-item' );
	$format  = Mitech_Post::instance()->get_the_post_format();
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper">

			<?php get_template_part( 'loop/blog/list-small-image/format', $format ); ?>

			<div class="post-info">

				<?php get_template_part( 'loop/blog/category' ); ?>

				<?php get_template_part( 'loop/blog/title' ); ?>

				<div class="post-excerpt">
					<?php Mitech_Templates::excerpt( array(
						'limit' => 18,
						'type'  => 'word',
					) ); ?>
				</div>

				<div class="post-meta">

					<?php get_template_part( 'loop/blog/author' ); ?>

					<?php get_template_part( 'loop/blog/date' ); ?>

					<?php get_template_part( 'loop/blog/sticky' ); ?>

				</div>

			</div>

		</div>
	</div>
<?php endwhile;
