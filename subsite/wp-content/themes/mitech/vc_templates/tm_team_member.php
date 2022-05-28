<?php
defined( 'ABSPATH' ) || exit;

$style = $el_class = $animation = $photo = $name = $profile = $social_networks = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-team-member-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$css_class = 'tm-team-member';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

if ( in_array( $style, array( '01', '02', '03' ), true ) ) {
	$css_class .= ' group-style-01';
}

$css_class .= Mitech_Helper::get_animation_classes( $animation );
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php
	set_query_var( 'mitech_shortcode_atts', $atts );

	get_template_part( 'loop/shortcodes/team-member/style', $style );
	?>
</div>
