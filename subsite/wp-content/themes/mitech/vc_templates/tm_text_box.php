<?php
defined( 'ABSPATH' ) || exit;

$style = $heading = $text = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-text-box-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$css_class = 'tm-text-box';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

$css_class .= Mitech_Helper::get_animation_classes();
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php if ( $heading !== '' ): ?>
		<h5 class="heading"><?php echo wp_kses( $heading, 'mitech-default' ); ?></h5>
	<?php endif; ?>

	<?php if ( $text !== '' ): ?>
		<div class="text">
			<?php echo wp_kses( $text, 'mitech-default' ); ?>
		</div>
	<?php endif; ?>
</div>
