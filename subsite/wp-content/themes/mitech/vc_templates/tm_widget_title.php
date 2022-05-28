<?php
defined( 'ABSPATH' ) || exit;

$widget_title = $el_class = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-widget-title-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$css_class = 'tm-widget-title widget';
$css_class .= " style-{$style}";

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

if ( $widget_title === '' ) {
	return;
}

$css_class .= Mitech_Helper::get_animation_classes();
?>
<div id="<?php echo esc_attr( $css_id ); ?>" class="<?php echo esc_attr( trim( $css_class ) ); ?>">
	<h2 class="widget-title"><?php echo esc_html( $widget_title ); ?></h2>
</div>
