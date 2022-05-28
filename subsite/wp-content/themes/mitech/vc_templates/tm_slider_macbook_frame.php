<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$loop = $auto_play = $nav = $pagination = $el_class = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-slider-macbook-frame-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-slider-macbook-frame mitech-swiper tm-swiper' . $el_class, $this->settings['base'], $atts );

if ( $nav !== '' ) {
	$css_class .= " nav-style-$nav";
}

if ( $pagination !== '' ) {
	$css_class .= " pagination-style-$pagination";
}

$css_class .= Mitech_Helper::get_animation_classes();

if ( $images === '' ) {
	return;
}
$images = explode( ',', $images );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
     data-lg-items="auto"
     data-lg-gutter="170"
     data-md-gutter="100"
     data-sm-gutter="50"
     data-centered="1"
     data-loop="1"

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
>

	<div class="swiper-inner">

		<div class="macbook-frame-wrap">
			<div class="macbook-frame">
				<img src="<?php echo MITECH_THEME_IMAGE_URI . '/macbook-frame.png'; ?>"
				     alt="<?php esc_html_e( 'Macbook Frame', 'mitech' ); ?>">
			</div>
		</div>

		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php foreach ( $images as $image ) {
					?>
					<div class="swiper-slide">
						<div class="image">
							<?php Mitech_Image::the_attachment_by_id( array(
								'id'   => $image,
								'size' => '602x381',
							) ); ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
