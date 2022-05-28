<?php
$nav = $slider_button_id = $pagination = '';
extract( $mitech_shortcode_atts );
$items = (array) vc_param_group_parse_atts( $items );

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
     data-lg-gutter="30"

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

				<?php foreach ( $items as $item ) { ?>

					<div class="swiper-slide">
						<div class="slide-wrap">
							<div class="row row-eq-height">
								<div class="slide-content col-lg-6 col-xl-5">
									<div class="slide-info">
										<?php if ( isset( $item['title'] ) ) : ?>
											<h5 class="heading"><?php echo esc_html( $item['title'] ); ?></h5>
										<?php endif; ?>

										<?php if ( isset( $item['sub_title'] ) ) : ?>
											<h6 class="sub-heading primary-color"><?php echo esc_html( $item['sub_title'] ); ?></h6>
										<?php endif; ?>

										<?php if ( isset( $item['text'] ) ) : ?>
											<div class="text"><?php echo esc_html( $item['text'] ); ?></div>
										<?php endif; ?>

										<?php if ( isset( $item['button'] ) ) : ?>
											<?php $button = vc_build_link( $item['button'] ); ?>
											<?php if ( $button['url'] !== '' && $button['title'] !== '' ) { ?>
												<?php
												$_button_classes = 'tm-button style-flat btn-slider-modern-button tm-button-nm';
												printf( '<a href="%s" %s %s class="%s"><span class="button-text">%s</span></a>', $button['url'], $button['target'] != '' ? 'target="' . esc_attr( $button['target'] ) . '"' : '', $button['rel'] != '' ? 'rel="' . esc_attr( $button['rel'] ) . '"' : '', $_button_classes, $button['title'] );
												?>
											<?php } ?>
										<?php endif; ?>

									</div>
								</div>

								<div class="col-lg-6 col-xl-7 col-content-middle col-lg-last col-xs-first">
									<div class="slide-image">
										<?php if ( isset( $item['image'] ) ) : ?>
											<div class="image-wrap">
												<div class="image">
													<?php Mitech_Image::the_attachment_by_id( array(
														'id'   => $item['image'],
														'size' => '960x9999',
														'crop' => false,
													) ); ?>
												</div>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>

				<?php } ?>

			</div>
		</div>
	</div>
</div>
