<?php
defined( 'ABSPATH' ) || exit;

$style = $el_class = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-simple-product' );
$this->get_inline_css( "#$css_id", $atts );
Mitech_VC::get_shortcode_custom_css( "#$css_id", $atts );
extract( $atts );

$products = (array) vc_param_group_parse_atts( $products );

if ( count( $products ) < 1 ) {
	return;
}

$css_class = 'tm-simple-product';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

if ( $style !== '' ) {
	$css_class .= " style-$style";
}
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="tm-grid modern-grid">
		<?php foreach ( $products as $product ) {
			$_price = $_price_template = $_currency = '';
			if ( isset( $product['price'] ) ) {
				if ( isset( $product['currency'] ) ) {
					$_currency = "<span class='currency'>{$product['currency']}</span>";
				}

				if ( isset( $product['sale_price'] ) && $product['sale_price'] !== '' ) {
					$_price = $product['sale_price'];
				} else {
					$_price = $product['price'];
				}

				$_price_template = '<div class="price">' . "{$_currency}{$_price}</div>";

				if ( isset( $product['sale_price'] ) && $product['sale_price'] !== '' ) {
					$_price_template = '<div class="regular-price">' . "{$_currency}{$product['price']}" . '</div>' . $_price_template;
				}
			}

			?>
			<div class="s-product grid-item">

				<div class="product-wrapper">

					<?php if ( isset( $product['badge'] ) && $product['badge'] !== '' ): ?>
						<div class="s-product-badge">
							<span><?php echo esc_html( $product['badge'] ); ?></span>
						</div>
					<?php endif; ?>

					<?php if ( isset( $product['image'] ) ): ?>
						<div class="product-image">
							<?php Mitech_Image::the_attachment_by_id( array(
								'id'   => $product['image'],
								'size' => '570x470',
							) ) ?>
						</div>
					<?php endif; ?>

					<div class="product-info">

						<?php if ( isset( $product['name'] ) ): ?>
							<h3 class="product-name"><?php echo esc_html( $product['name'] ); ?></h3>
						<?php endif; ?>

						<?php if ( isset( $product['category'] ) ): ?>
							<div class="product-category"><?php echo esc_html( $product['category'] ); ?></div>
						<?php endif; ?>

						<?php if ( isset( $product['desc'] ) ): ?>
							<div class="product-desc"><?php echo esc_html( $product['desc'] ); ?></div>
						<?php endif; ?>

						<div class="product-footer">
							<?php if ( isset( $product['link'] ) ): ?>
								<?php
								$_button_classes = 'tm-button style-flat tm-simple-product-button';

								$button = vc_build_link( $product['link'] );
								?>
								<?php if ( $button['url'] !== '' ) { ?>
									<div class="tm-s-product-button">
										<?php
										$_button_title = $button['title'] != '' ? $button['title'] : esc_html__( 'Sign Up', 'mitech' );
										printf( '<a href="%s" %s %s class="%s">%s</a>', $button['url'], $button['target'] != '' ? 'target="' . esc_attr( $button['target'] ) . '"' : '', $button['rel'] != '' ? 'rel="' . esc_attr( $button['rel'] ) . '"' : '', $_button_classes, $_button_title );
										?>
									</div>
								<?php } ?>
							<?php endif; ?>

							<?php echo '<div class="s-product-price">' . $_price_template . '</div>'; ?>
						</div>
					</div>
				</div>

			</div>
		<?php } ?>
	</div>
</div>
