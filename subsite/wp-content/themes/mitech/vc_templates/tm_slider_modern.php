<?php
defined( 'ABSPATH' ) || exit;

$style  = $el_class = $items = '';
$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-slider-modern-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$items = (array) vc_param_group_parse_atts( $items );
if ( count( $items ) <= 0 ) {
	return;
}

$css_class = 'tm-slider-modern';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

$css_class .= Mitech_Helper::get_animation_classes();
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php
	set_query_var( 'mitech_shortcode_atts', $atts );
	get_template_part( 'loop/shortcodes/slider-modern/style', $style );
	?>
</div>
