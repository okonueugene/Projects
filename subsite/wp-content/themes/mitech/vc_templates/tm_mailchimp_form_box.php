<?php
defined( 'ABSPATH' ) || exit;

$form_id  = '';
$el_class = $style = $title = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-mailchimp-form-box-' );
$this->get_inline_css( "#$css_id", $atts );
Mitech_VC::get_shortcode_custom_css( "#$css_id", $atts );
extract( $atts );

$css_class = 'tm-mailchimp-form-box';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

if ( $title !== '' ) {
	$css_class .= ' widget';
}

if ( $style !== '' ) {
	$css_class .= " style-$style";
}

if ( $form_id === '' ) {
	$form_id = Mitech_Helper::get_mailchimp_form_id();
}

$css_class .= Mitech_Helper::get_animation_classes();
?>
<?php if ( function_exists( 'mc4wp_show_form' ) && $form_id !== '' ) : ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">

		<?php if ( $title !== '' ): ?>
			<h2 class="widget-title"><?php echo esc_html( $title ); ?></h2>
		<?php endif; ?>

		<?php mc4wp_show_form( $form_id ); ?>
	</div>
<?php endif; ?>
