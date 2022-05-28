<?php
while ( $mitech_query->have_posts() ) :
	$mitech_query->the_post();
	$classes = array( 'grid-item', 'post-item' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper">
			<?php if ( has_post_thumbnail() ) { ?>
				<a href="<?php the_permalink(); ?>" class="link-secret">
					<div class="post-feature post-thumbnail">
						<?php Mitech_Image::the_post_thumbnail( array( 'size' => '540x330' ) ); ?>

						<div class="post-meta">
							<?php get_template_part( 'loop/blog/author', 'no-link' ); ?>

							<?php get_template_part( 'loop/blog/date' ); ?>

							<?php get_template_part( 'loop/blog/sticky' ); ?>
						</div>
					</div>
				</a>
			<?php } ?>

			<div class="post-info">
				<?php get_template_part( 'loop/blog/title' ); ?>

				<div class="post-excerpt">
					<?php Mitech_Templates::excerpt( array(
						'limit' => 22,
						'type'  => 'word',
					) ); ?>
				</div>

				<?php get_template_part( 'loop/blog/readmore', 'link' ); ?>
			</div>
		</div>
	</div>
<?php endwhile;
