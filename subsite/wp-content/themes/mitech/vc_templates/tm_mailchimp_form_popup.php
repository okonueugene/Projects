<?php
defined( 'ABSPATH' ) || exit;

$el_class = $style = $heading = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = 'tm-mailchimp-form-popup';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

if ( $style !== '' ) {
	$css_class .= " style-$style";
}

if ( $heading === '' ) {
	return;
}

$css_class .= Mitech_Helper::get_animation_classes();
?>
<?php if ( function_exists( 'mc4wp_show_form' ) ) : ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>">
		<a href="javascript:void(0);" id="subscribe-open-popup-link" class="subscribe-open-popup-link">
			<?php echo esc_html( $heading ); ?>
		</a>
	</div>

	<script>
        jQuery( document ).ready( function ( $ ) {
            $( '#subscribe-open-popup-link' ).on( 'click', function () {
                $( 'html' ).addClass( 'mailchimp-form-popup-opened' );
            } );

            $( '#mailchimp-form-popup-close' ).on( 'click', function () {
                $( 'html' ).removeClass( 'mailchimp-form-popup-opened' );
            } );
        } );
	</script>
<?php endif; ?>
