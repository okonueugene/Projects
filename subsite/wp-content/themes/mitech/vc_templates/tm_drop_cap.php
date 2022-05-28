<?php
defined( 'ABSPATH' ) || exit;

$text = $style = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-drop-cap-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$css_class = 'tm-drop-cap';

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
	<?php
	$text = preg_replace( '/^([\<\sa-z\d\/\>]*)(([a-z\&\;]+)|([\"\'\w]))/', '$1<span class="drop-cap">$2</span>', $text );
	echo wp_kses( $text, array(
		'span' => array(
			'class' => array(),
		),
	) );
	?>
</div>
