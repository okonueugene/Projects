<?php
defined( 'ABSPATH' ) || exit;

$el_class = $style = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-soundcloud-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$css_class = 'tm-soundcloud';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

$css_class .= Mitech_Helper::get_animation_classes();
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php echo wpb_js_remove_wpautop( $content ); ?>
</div>
