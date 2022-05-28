<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$style = $hotspot = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-image-hotspot ', $this->settings['base'], $atts );

if ( $style !== '' ) {
	$css_class .= " style-{$style}";
}

wp_enqueue_script( 'ihotspot-js' );
wp_enqueue_style( 'ihotspot' );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>">
	<?php echo do_shortcode( "[devvn_ihotspot id={$hotspot}][/devvn_ihotspot]" ); ?>
</div>
