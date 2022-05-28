<?php
while ( $mitech_query->have_posts() ) :
	$mitech_query->the_post();
	$classes = array( 'grid-item', 'post-item' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper">

			<?php if ( has_post_thumbnail() ) { ?>
				<div class="post-feature post-thumbnail">
					<a href="<?php the_permalink(); ?>">
						<?php
						Mitech_Image::the_post_thumbnail( array( 'size' => '370x230' ) );
						?>
					</a>
				</div>
			<?php } ?>

			<div class="post-info">
				<div class="post-meta">
					<?php get_template_part( 'loop/blog/date' ); ?>

					<?php get_template_part( 'loop/blog/sticky' ); ?>
				</div>

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
