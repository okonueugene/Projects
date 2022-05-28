<?php
defined( 'ABSPATH' ) || exit;

$el_class = $style = $smooth_scroll = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-separator-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$css_class = 'tm-separator';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

$css_class .= Mitech_Helper::get_animation_classes();

$separator_class = 'separator-wrap';

if ( $smooth_scroll !== '' ) {
	$separator_class .= ' smooth-scroll-link';
	$css_class       .= " clickable";
}
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="<?php echo esc_attr( $separator_class ); ?>"
		<?php if ( $smooth_scroll !== '' ) : ?>
			data-href="<?php echo esc_attr( $smooth_scroll ); ?>"
		<?php endif; ?>
	>

		<?php if ( in_array( $style, array( 'modern-dots'), true ) ) : ?>
			<div class="dot first-circle"></div>
			<div class="dot second-circle"></div>
			<div class="dot third-circle"></div>
		<?php endif; ?>

	</div>
</div>
