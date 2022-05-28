<?php
defined( 'ABSPATH' ) || exit;

$style = $el_id = $el_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$items = (array) vc_param_group_parse_atts( $items );
if ( count( $items ) < 1 ) {
	return;
}

if ( $el_id === '' ) {
	$el_id = uniqid( 'tm-timeline-' );
}

$this->get_inline_css( "#$el_id", $atts );
Mitech_VC::get_shortcode_custom_css( "#$el_id", $atts );

$css_class = 'tm-timeline';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

if ( $style !== '' ) {
	$css_class .= " style-$style";
}
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $el_id ); ?>">
	<?php
	set_query_var( 'items', $items );

	get_template_part( 'loop/shortcodes/timeline/style', $style );
	?>
</div>
