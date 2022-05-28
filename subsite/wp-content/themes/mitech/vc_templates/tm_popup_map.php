<?php
defined( 'ABSPATH' ) || exit;

$style = $el_class = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-popup-map-' );
$this->get_inline_css( "#$css_id", $atts );
Mitech_VC::get_shortcode_custom_css( "#$css_id", $atts );
extract( $atts );

$css_class = 'tm-popup-map';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

$css_class .= Mitech_Helper::get_animation_classes();

wp_enqueue_style( 'lightgallery' );
wp_enqueue_script( 'lightgallery' );
?>
<?php if ( $embed !== '' ) : ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">

		<?php
		if ( $text === '' ) {
			$text = esc_html__( 'View on Google map', 'mitech' );
		}
		?>

		<a href="<?php echo esc_url( $embed ); ?>" class="tm-button-map" data-iframe="true"
		   data-src="<?php echo esc_url( $embed ); ?>">
			<span class="button-icon"></span>
			<span class="button-text"><?php echo esc_html( $text ); ?></span>
		</a>

	</div>
<?php endif;
