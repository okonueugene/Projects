<?php
while ( $mitech_query->have_posts() ) :
	$mitech_query->the_post();
	$classes = array( 'grid-item', 'post-item' );
	$format  = Mitech_Post::instance()->get_the_post_format();
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper">

			<?php if ( has_post_thumbnail() ) { ?>
				<div class="post-feature post-thumbnail">
					<a href="<?php the_permalink(); ?>">
						<?php
						Mitech_Image::the_post_thumbnail( array( 'size' => '540x330' ) );
						?>
					</a>
				</div>
			<?php } ?>

			<div class="post-info">

				<?php get_template_part( 'loop/blog/title' ); ?>

				<div class="post-meta">

					<?php get_template_part( 'loop/blog/author' ); ?>

					<?php get_template_part( 'loop/blog/date' ); ?>

					<?php Mitech_Post::instance()->view_count(); ?>

					<?php get_template_part( 'loop/blog/sticky' ); ?>

				</div>

				<div class="post-excerpt">
					<?php Mitech_Templates::excerpt( array(
						'limit' => 18,
						'type'  => 'word',
					) ); ?>
				</div>

				<?php get_template_part( 'loop/blog/readmore' ); ?>

			</div>

		</div>
	</div>
<?php endwhile;
