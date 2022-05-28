<?php
defined( 'ABSPATH' ) || exit;

$el_class = $style = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = 'tm-contact-form-7-box';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

if ( in_array( $style, array( '01', '02','03' ), true ) ) {
	$css_class .= " group-style-01";
}

wp_enqueue_script( 'mitech-contact-form' );

$css_class .= Mitech_Helper::get_animation_classes();
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>">
	<?php echo do_shortcode( '[contact-form-7 id="' . $id . '"]' ); ?>
	<div class="tm-form-loading" style="display: none;">
		<?php get_template_part( 'components/preloader/style', 'wave' ); ?>
	</div>
</div>
