<?php
defined( 'ABSPATH' ) || exit;

$el_class = $style = $nav = $pagination = $content_shadow = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-slider-group-' );
$this->get_inline_css( "#$css_id", $atts );
Mitech_VC::get_shortcode_custom_css( "#$css_id", $atts );
extract( $atts );

$css_class = 'tm-slider-group mitech-swiper tm-swiper';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

if ( $style !== '' ) {
	$css_class .= " style-{$style}";
}

if ( $nav !== '' ) {
	$css_class .= " nav-style-$nav";
}

if ( $content_shadow !== '' ) {
	$css_class .= " has-shadow-{$content_shadow}";
}

if ( $pagination !== '' ) {
	$css_class .= " pagination-style-$pagination";
}
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
     data-slide-wrap="1"
	<?php
	if ( $items_display !== '' ) {
		$arr = explode( ';', $items_display );
		foreach ( $arr as $value ) {
			$tmp = explode( ':', $value );
			echo ' data-' . $tmp[0] . '-items="' . $tmp[1] . '"';
		}
	}
	?>

	 data-slides-per-group="inherit"

	<?php if ( $gutter > 1 ) : ?>
		data-lg-gutter="<?php echo esc_attr( $gutter ); ?>"
	<?php endif; ?>

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
				<?php echo wpb_js_remove_wpautop( $content ); ?>
			</div>
		</div>
	</div>
</div>
