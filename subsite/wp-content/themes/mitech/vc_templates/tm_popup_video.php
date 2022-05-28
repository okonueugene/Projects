<?php
defined( 'ABSPATH' ) || exit;

$style = $el_class = $video = $poster_full_wide = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-popup-video-' );
$this->get_inline_css( "#$css_id", $atts );
Mitech_VC::get_shortcode_custom_css( "#$css_id", $atts );
extract( $atts );

$css_class = 'tm-popup-video';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

if ( in_array( $style, array( 'button-02', 'button-03' ), true ) ) {
	$css_class .= " group-button-style-01";
}

if ( $poster_full_wide === '1' ) {
	$css_class .= ' poster-full-wide';
}

$css_class .= Mitech_Helper::get_animation_classes();

wp_enqueue_style( 'lightgallery' );
wp_enqueue_script( 'lightgallery' );
?>
<?php if ( $video !== '' ) : ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">

		<?php
		set_query_var( 'mitech_shortcode_atts', $atts );

		get_template_part( 'loop/shortcodes/popup-video/style', $style );
		?>

	</div>
<?php endif;
