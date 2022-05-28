<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$heading = $text = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-image-hotspot-content ', $this->settings['base'], $atts );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>">
	<?php if ( $heading !== '' ) : ?>
		<h6 class="heading"><?php echo esc_html( $heading ); ?></h6>
	<?php endif; ?>

	<?php if ( $text !== '' ) : ?>
		<?php echo '<div class="text">' . $text . '</div>'; ?>
	<?php endif; ?>
</div>
