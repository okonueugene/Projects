<?php
while ( $mitech_query->have_posts() ) :
	$mitech_query->the_post();
	$classes = array( 'grid-item', 'post-item' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<a href="<?php the_permalink(); ?>" class="link-secret">
			<div class="post-wrapper">
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="post-feature post-thumbnail">
						<?php Mitech_Image::the_post_thumbnail( array( 'size' => '480x312' ) ); ?>

						<?php get_template_part( 'loop/blog/author', 'no-link' ); ?>
					</div>
				<?php } ?>

				<div class="post-info">

					<div class="post-meta">

						<?php get_template_part( 'loop/blog/date' ); ?>

						<?php get_template_part( 'loop/blog/sticky' ); ?>

					</div>

					<?php get_template_part( 'loop/blog/title', 'no-link' ); ?>

				</div>
			</div>
		</a>
	</div>
<?php endwhile;
