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
     data-lg-items="1"

	<?php if ( $carousel_gutter !== '' ) {
		$arr = explode( ';', $carousel_gutter );
		foreach ( $arr as $value ) {
			$tmp = explode( ':', $value );
			echo ' data-' . $tmp[0] . '-gutter="' . $tmp[1] . '"';
		}
	}
	?>

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
							<?php if ( has_post_thumbnail() ): ?>
								<div class="post-thumbnail">
									<?php Mitech_Image::the_post_thumbnail( array( 'size' => '140x140' ) ); ?>
								</div>
							<?php endif; ?>

							<div class="testimonial-content">
								<div class="testimonial-desc"><?php the_content(); ?></div>

								<div class="testimonial-info">
									<h6 class="testimonial-name"><?php the_title(); ?></h6>

									<?php if ( isset( $_meta['by_line'] ) ) : ?>
										<div class="testimonial-by-line"><?php echo esc_html( $_meta['by_line'] ); ?></div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>

			</div>
		</div>
	</div>
</div>
