<?php
defined( 'ABSPATH' ) || exit;

$style = $el_class = $items = $heading = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-restaurant-menu-' );
$this->get_inline_css( '#' . $css_id, $atts );
extract( $atts );

$items = (array) vc_param_group_parse_atts( $items );
if ( count( $items ) < 1 ) {
	return;
}

$css_class = 'tm-restaurant-menu';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";
$css_class .= Mitech_Helper::get_animation_classes();
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<ul class="menu-list">
		<?php
		foreach ( $items as $item ) {
			?>
			<li class="menu-item">
				<div class="menu-header">
					<?php if ( isset( $item['title'] ) ) : ?>
						<h5 class="menu-title"><?php echo esc_html( $item['title'] ); ?></h5>
					<?php endif; ?>
					<?php if ( isset( $item['price'] ) ) : ?>
						<div class="menu-price"><?php echo esc_html( $item['price'] ); ?></div>
					<?php endif; ?>
					<?php if ( isset( $item['badge'] ) && $item['badge'] !== '' ): ?>
						<div
							class="menu-badge <?php echo esc_attr( $item['badge'] ); ?>"><?php esc_html_e( 'New', 'mitech' ); ?></div>
					<?php endif; ?>
				</div>
				<?php if ( isset( $item['text'] ) ) : ?>
					<div class="menu-text"><?php echo esc_html( $item['text'] ); ?></div>
				<?php endif; ?>
			</li>
		<?php } ?>
	</ul>
</div>
