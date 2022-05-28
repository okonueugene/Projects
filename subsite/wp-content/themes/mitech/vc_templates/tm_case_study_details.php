<?php
defined( 'ABSPATH' ) || exit;

$el_class = $style = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = 'tm-case-study-details';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

$css_class .= Mitech_Helper::get_animation_classes();
$post_id   = get_the_ID();
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>">

	<?php Mitech_Case_Study::instance()->entry_details(); ?>

</div>
