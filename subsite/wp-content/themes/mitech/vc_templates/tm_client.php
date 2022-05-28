<?php
defined( 'ABSPATH' ) || exit;

$style = $effect = $hover = $el_class = $items =$alignment= '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-client-' );
$this->get_inline_css( '#' . $css_id, $atts );
extract( $atts );

$css_class = 'tm-client';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

if ( $effect !== '' ) {
	$css_class .= " effect-$effect";
} else {
	$css_class .= " effect-scale-up";
}

if ( $hover !== '' ) {
	$css_class .= " hover-$hover";
}

$css_class .=    ' '.esc_attr($alignment) ;

$items = (array) vc_param_group_parse_atts( $items );

if ( count( $items ) <= 0 ) {
	return;
}
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php
	set_query_var( 'mitech_shortcode_atts', $atts );

	get_template_part( 'loop/shortcodes/client/style', $style );
	?>
</div>
