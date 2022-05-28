<?php
while ( $mitech_query->have_posts() ) :
	$mitech_query->the_post();
	$classes = array( 'case-study-item grid-item' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper">
			<div class="post-thumbnail-wrapper">
				<a href="<?php Mitech_Case_Study::instance()->the_permalink(); ?>" class="post-permalink link-secret">
					<div class="post-thumbnail">
						<?php if ( has_post_thumbnail() ) { ?>
							<?php Mitech_Image::the_post_thumbnail( array(
								'size' => $image_size,
							) ); ?>
						<?php } else { ?>
							<?php Mitech_Templates::image_placeholder( 480, 480 ); ?>
						<?php } ?>
					</div>
				</a>
			</div>

			<div class="post-info">

				<?php Mitech_Case_Study::instance()->the_categories(); ?>

				<h3 class="post-title">
					<a href="<?php Mitech_Case_Study::instance()->the_permalink() ?>"><?php the_title(); ?></a>
				</h3>

				<div class="post-excerpt">
					<?php Mitech_Templates::excerpt( array(
						'limit' => 28,
						'type'  => 'word',
					) ); ?>
				</div>

				<div class="post-read-more">
					<a href="<?php the_permalink(); ?>" class="tm-button style-flat tm-button-nm">
						<span class="btn-text">
							<?php esc_html_e( 'View detail', 'mitech' ); ?>
						</span>
					</a>
				</div>


			</div>
		</div>
	</div>
<?php endwhile; ?>
