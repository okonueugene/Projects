<?php
defined( 'ABSPATH' ) || exit;

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-spacer-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$css_class = 'tm-spacer';
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"></div>
