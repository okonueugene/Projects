<?php
while ( $mitech_query->have_posts() ) :
	$mitech_query->the_post();
	$classes = array( 'case-study-item grid-item' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<a href="<?php Mitech_Case_Study::instance()->the_permalink(); ?>" class="post-permalink link-secret">
			<div class="post-wrapper">

				<div class="post-thumbnail-wrapper">
					<div class="post-thumbnail">
						<?php if ( has_post_thumbnail() ) { ?>
							<?php Mitech_Image::the_post_thumbnail( array(
								'size'   => 'custom',
								'width'  => 960,
								'height' => 9999,
								'crop'   => false,
							) ); ?>
						<?php } else { ?>
							<?php Mitech_Templates::image_placeholder( 480, 480 ); ?>
						<?php } ?>
					</div>

					<?php if ( $overlay_style !== '' ) : ?>
						<?php get_template_part( 'loop/case-study/overlay', $overlay_style ); ?>
					<?php endif; ?>
				</div>

			</div>
		</a>
	</div>
<?php endwhile; ?>
