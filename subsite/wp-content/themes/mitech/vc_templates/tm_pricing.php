<?php
defined( 'ABSPATH' ) || exit;

$style = $el_class = $highlight = $animation = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = 'tm-pricing';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

$css_class .= Mitech_Helper::get_animation_classes( $animation );

if ( $highlight === '1' ) {
	$css_class .= ' highlight';
}

$css_id = uniqid( 'tm-pricing-' );
$this->get_inline_css( '#' . $css_id, $atts );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="inner">
		<?php
		set_query_var( 'mitech_shortcode_atts', $atts );
		get_template_part( 'loop/shortcodes/pricing/style', $style );
		?>
	</div>
</div>
