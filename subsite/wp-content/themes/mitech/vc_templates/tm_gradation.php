<?php
defined( 'ABSPATH' ) || exit;

$style = $el_class = $items = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-gradation-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$items = (array) vc_param_group_parse_atts( $items );
if ( count( $items ) < 1 ) {
	return;
}

$css_class = 'tm-gradation tm-animation-queue';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
     data-animation-delay="400"
>
	<?php
	set_query_var( 'mitech_shortcode_atts', $atts );

	get_template_part( 'loop/shortcodes/gradation/style', $style );
	?>
</div>
