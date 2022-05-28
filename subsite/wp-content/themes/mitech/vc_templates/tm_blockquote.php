<?php
defined( 'ABSPATH' ) || exit;

$style = $el_class = $text = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-blockquote-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$css_class = 'tm-blockquote';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

$css_class .= Mitech_Helper::get_animation_classes();

if ( $text === '' ) {
	return;
}
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<blockquote>
		<?php if ( $text !== '' ) : ?>
			<?php echo '<div class="quote-text">' . $text . '</div>'; ?>
		<?php endif; ?>
	</blockquote>
</div>
