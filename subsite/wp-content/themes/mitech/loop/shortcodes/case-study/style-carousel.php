<?php
while ( $mitech_query->have_posts() ) :
	$mitech_query->the_post();
	$classes = array( 'case-study-item grid-item swiper-slide' );

	$video                   = $video = Mitech_Case_Study::instance()->get_the_post_meta( 'case_study_video_url' );
	$feature_permalink       = Mitech_Case_Study::instance()->get_the_permalink();
	$thumbnail_wrapper_class = 'post-thumbnail-wrapper';
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<a href="<?php echo esc_url( $feature_permalink ); ?>" class="post-permalink link-secret video-link">
		<div class="post-wrapper">
			<div class="<?php echo esc_attr( $thumbnail_wrapper_class ); ?>">
					<div class="post-thumbnail">
						<?php if ( $enable_popup_video === '1' && $video !== '' ) { ?>
							<div class="video-poster">
								<?php if ( has_post_thumbnail() ) { ?>
									<?php Mitech_Image::the_post_thumbnail( array( 'size' => $image_size ) ); ?>
								<?php } else { ?>
									<?php Mitech_Templates::image_placeholder( 480, 298 ); ?>
								<?php } ?>
							</div>
							<div class="video-overlay">
								<div class="video-button">
									<div class="video-play">
										<span class="video-play-icon"></span>
									</div>
								</div>
							</div>
						<?php } else { ?>

							<?php if ( has_post_thumbnail() ) { ?>
								<?php Mitech_Image::the_post_thumbnail( array(
									'size' => $image_size,
								) ); ?>
							<?php } else { ?>
								<?php Mitech_Templates::image_placeholder( 480, 298 ); ?>
							<?php } ?>

						<?php } ?>
					</div>

			</div>

			<div class="post-info">
				<h3 class="post-title"><?php the_title(); ?></h3>

				<?php Mitech_Case_Study::instance()->the_categories_no_link(); ?>

				<div class="post-excerpt">
					<?php Mitech_Templates::excerpt( array(
						'limit' => 16,
						'type'  => 'word',
					) ); ?>
				</div>

				<div class="btn">
					<span class="btn-text">
							<?php esc_html_e( 'View case study', 'mitech' ); ?>
						</span>
					<span class="btn-icon fa fa-long-arrow-right"></span>
				</div>
			</div>

		</div>
		</a>
	</div>
<?php endwhile; ?>
