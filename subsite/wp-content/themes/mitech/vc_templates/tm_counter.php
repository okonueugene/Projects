<?php
defined( 'ABSPATH' ) || exit;

$style = $el_class = $animation = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-counter-' );
$this->get_inline_css( '#' . $css_id, $atts );
extract( $atts );

$css_class = 'tm-counter';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";
$css_class .= " align-$align";

if ( $animation !== 'none' ) {
	$css_class .= ' has-animation';
	if ( $animation === 'odometer' ) {
		wp_enqueue_script( 'odometer' );
	} else {
		wp_enqueue_script( 'counter-up' );
	}
	wp_enqueue_script( 'counter' );
}

$css_class .= Mitech_Helper::get_animation_classes();
?>
<div id="<?php echo esc_attr( $css_id ); ?>" class="<?php echo esc_attr( trim( $css_class ) ); ?>"
     data-animation="<?php echo esc_attr( $animation ); ?>"
>
	<div class="counter-wrap">
		<?php
		set_query_var( 'mitech_shortcode_atts', $atts );

		get_template_part( 'loop/shortcodes/counter/style', $style );
		?>
	</div>
</div>
