<?php
defined( 'ABSPATH' ) || exit;

$el_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = 'tm-group';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>">
	<?php echo wpb_js_remove_wpautop( $content ); ?>
</div>
