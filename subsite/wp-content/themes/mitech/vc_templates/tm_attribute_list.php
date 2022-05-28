<?php
defined( 'ABSPATH' ) || exit;

$style = $skin = $attributes = '';
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );
$css_id = uniqid( 'tm-attribute-list-' );
$this->get_inline_css( "#$css_id", $atts );
Mitech_VC::get_shortcode_custom_css( "#$css_id", $atts );
$attributes = (array) vc_param_group_parse_atts( $attributes );

if ( count( $attributes ) < 1 ) {
	return;
}

$css_class = 'tm-attribute-list';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

$css_class .= Mitech_Helper::get_animation_classes();
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="content-wrap">
		<ul class="list">
			<?php
			foreach ( $attributes as $attribute ) { ?>
				<?php if ( isset( $attribute['name'] ) && isset( $attribute['value'] ) ) : ?>
					<li class="item">
						<div class="name"><h6><?php echo esc_html( $attribute['name'] ); ?></h6></div>
						<div class="value"><?php echo wp_kses( $attribute['value'], 'mitech-default' ); ?></div>
					</li>
				<?php endif; ?>
			<?php } ?>
		</ul>
	</div>
</div>
