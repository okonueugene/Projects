<?php
defined( 'ABSPATH' ) || exit;

$style = $placeholder = '';
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$items = (array) vc_param_group_parse_atts( $items );

if ( count( $items ) < 1 ) {
	return;
}

$css_id = uniqid( 'tm-list-selection-' );
$this->get_inline_css( '#' . $css_id, $atts );
$css_class = 'tm-list-selection';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-{$style}";

$css_class .= Mitech_Helper::get_animation_classes();
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<select onChange="window.location.href=this.value">
		<?php if ( $placeholder !== '' ): ?>
			<option value="" disabled selected><?php echo esc_html( $placeholder ); ?></option>
		<?php endif; ?>

		<?php foreach ( $items as $item ) { ?>
			<option value="<?php echo esc_attr( $item['link'] ); ?>">
				<?php echo esc_html( $item['title'] ); ?>
			</option>
		<?php } ?>
	</select>
</div>
