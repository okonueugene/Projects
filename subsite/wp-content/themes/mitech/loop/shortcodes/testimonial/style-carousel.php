<?php
extract( $mitech_shortcode_atts );

$slider_class = 'mitech-swiper tm-swiper equal-height';

if ( $nav !== '' ) {
	$slider_class .= " nav-style-$nav";
}

if ( $pagination !== '' ) {
	$slider_class .= " pagination-style-$pagination";
}
?>

<div class="<?php echo esc_attr( trim( $slider_class ) ); ?>"
	<?php if ( $carousel_items_display !== '' ) {
		$arr = explode( ';', $carousel_items_display );
		foreach ( $arr as $value ) {
			$tmp = explode( ':', $value );
			echo ' data-' . $tmp[0] . '-items="' . $tmp[1] . '"';
		}
	}
	?>

	<?php if ( $carousel_gutter !== '' ) {
		$arr = explode( ';', $carousel_gutter );
		foreach ( $arr as $value ) {
			$tmp = explode( ':', $value );
			echo ' data-' . $tmp[0] . '-gutter="' . $tmp[1] . '"';
		}
	}
	?>

	 data-slides-per-group="inherit"

	<?php if ( $nav !== '' ) : ?>
		data-nav="1"
	<?php endif; ?>

	<?php if ( $nav === 'custom' ) : ?>
		data-custom-nav="<?php echo esc_attr( $slider_button_id ); ?>"
	<?php endif; ?>

	<?php if ( $pagination !== '' ) : ?>
		data-pagination="1"
	<?php endif; ?>

	<?php if ( $auto_play !== '' ) : ?>
		data-autoplay="<?php echo esc_attr( $auto_play ); ?>"
	<?php endif; ?>

	<?php if ( $loop === '1' ) : ?>
		data-loop="1"
	<?php endif; ?>

	 data-equal-height="1"
>
	<div class="swiper-inner">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php while ( $mitech_query->have_posts() ) :
					$mitech_query->the_post();

					$_meta = unserialize( get_post_meta( get_the_ID(), 'insight_testimonial_options', true ) );
					?>
					<div class="swiper-slide">
						<div class="testimonial-item">

							<div class="testimonial-info-wrap">
								<?php if ( has_post_thumbnail() ): ?>
									<div class="post-thumbnail">
										<?php Mitech_Image::the_post_thumbnail( array( 'size' => '90x90' ) ); ?>
									</div>
								<?php endif; ?>

								<div class="testimonial-info">
									<?php if ( isset( $_meta['rating'] ) && $_meta['rating'] !== '' ): ?>
										<div class="testimonial-rating">
											<?php Mitech_Templates::get_rating_template( $_meta['rating'] ); ?>
										</div>
									<?php endif; ?>

									<div class="testimonial-main-info">
										<h6 class="testimonial-name"><?php the_title(); ?></h6>

										<?php if ( isset( $_meta['by_line'] ) ) : ?>
											<div
												class="testimonial-by-line"><?php echo esc_html( $_meta['by_line'] ); ?></div>
										<?php endif; ?>
									</div>
								</div>
							</div>

							<div class="testimonial-content">
								<div class="testimonial-desc"><?php the_content(); ?></div>
							</div>
						</div>
					</div>

				<?php endwhile; ?>
			</div>
		</div>
	</div>
</div>
