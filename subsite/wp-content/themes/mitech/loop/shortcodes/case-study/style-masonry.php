<div class="grid-sizer"></div>
<?php
while ( $mitech_query->have_posts() ) :
	$mitech_query->the_post();
	$classes = array( 'case-study-item grid-item' );

	$video                   = $video = Mitech_Case_Study::instance()->get_the_post_meta( 'case_study_video_url' );
	$feature_permalink       = Mitech_Case_Study::instance()->get_the_permalink();
	$thumbnail_wrapper_class = 'post-thumbnail-wrapper';

	if ( $enable_popup_video === '1' && $video !== '' ) {
		$feature_permalink = $video;

		$thumbnail_wrapper_class .= ' tm-popup-video style-poster-01 poster-full-wide';
	}
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper">
			<div class="<?php echo esc_attr( $thumbnail_wrapper_class ); ?>">
				<a href="<?php echo esc_url( $feature_permalink ); ?>" class="post-permalink link-secret video-link">
					<div class="post-thumbnail">
						<?php if ( $enable_popup_video === '1' && $video !== '' ) { ?>
							<div class="video-poster">
								<?php if ( has_post_thumbnail() ) { ?>
									<?php Mitech_Image::the_post_thumbnail( array(
										'size'   => 'custom',
										'width'  => 480,
										'height' => 9999,
										'crop'   => false,
									) ); ?>
								<?php } else { ?>
									<?php Mitech_Templates::image_placeholder( 480, 480 ); ?>
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
									'size'   => 'custom',
									'width'  => 480,
									'height' => 9999,
									'crop'   => false,
								) ); ?>
							<?php } else { ?>
								<?php Mitech_Templates::image_placeholder( 480, 480 ); ?>
							<?php } ?>
						<?php } ?>
					</div>

					<?php if ( $overlay_style !== '' ) : ?>
						<?php get_template_part( 'loop/case-study/overlay', $overlay_style ); ?>
					<?php endif; ?>
				</a>
			</div>

			<?php if ( $caption_style !== '' ) : ?>
				<?php get_template_part( 'loop/case-study/caption', $caption_style ); ?>
			<?php endif; ?>

		</div>
	</div>
<?php endwhile; ?>
