<?php
defined( 'ABSPATH' ) || exit;

$el_class = $style = $skin = $datetime = $number_color = $text_color = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-countdown-' );
$this->get_inline_css( '#' . $css_id, $atts );
extract( $atts );

$css_class = 'tm-countdown';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

if ( $skin !== '' ) {
	$css_class .= " skin-$skin";
}

$css_class .= Mitech_Helper::get_animation_classes();

// Use demo countdown date.
if ( $datetime === '' ) {
	$atts['datetime'] = Mitech_Helper::get_sample_countdown_date();
}
?>
<div id="<?php echo esc_attr( $css_id ); ?>" class="<?php echo esc_attr( $css_class ); ?>">
	<?php
	set_query_var( 'mitech_shortcode_atts', $atts );

	get_template_part( 'loop/shortcodes/countdown/style', $style );
	?>
</div>
