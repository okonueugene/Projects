<?php
defined( 'ABSPATH' ) || exit;

$style = '';
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );
$css_id = uniqid( 'tm-services-list-' );
$this->get_inline_css( '#' . $css_id, $atts );

$items = (array) vc_param_group_parse_atts( $items );
if ( count( $items ) < 1 ) {
	return;
}

$css_class = 'tm-services-list';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

$css_class .= Mitech_Helper::get_animation_classes();
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php if ( $style === '02' ): ?>

		<div class="service-grid">
			<?php
			foreach ( $items as $item ) { ?>
				<div class="service-item">
					<div class="service-image">
						<div class="inner">
							<?php if ( isset( $item['image'] ) ) : ?>
								<?php Mitech_Image::the_attachment_by_id( array(
									'id'   => $item['image'],
									'size' => '340x500',
								) ); ?>
							<?php endif; ?>

							<?php
							if ( isset( $item['image'] ) ) :
								$_url = Mitech_Image::get_attachment_url_by_id( array(
									'id'   => $item['image'],
									'size' => '340x500',
								) );
							endif;
							?>
							<div class="blend-image"
							     style="background-image: url(<?php Mitech_Helper::e( $_url ); ?>)"></div>
							<div class="blend-bg"></div>
						</div>
					</div>

					<div class="service-info">

						<?php if ( isset( $item['title'] ) ) : ?>
							<h3 class="service-name">
								<?php echo wp_kses( $item['title'], 'mitech-default' ); ?>
							</h3>
						<?php endif; ?>

						<?php if ( isset( $item['text'] ) ) : ?>
							<div class="service-text">
								<?php echo wp_kses( $item['text'], 'mitech-default' ); ?>
							</div>
						<?php endif; ?>

					</div>
				</div>
			<?php } ?>
		</div>

	<?php else: ?>
		<?php
		foreach ( $items as $item ) { ?>
			<div class="service-item">
				<div class="service-image">
					<?php if ( isset( $item['image'] ) ) : ?>
						<?php Mitech_Image::the_attachment_by_id( array(
							'id'   => $item['image'],
							'size' => '745x640',
						) ); ?>
					<?php endif; ?>
				</div>

				<div class="service-info">

					<?php if ( isset( $item['title'] ) ) : ?>
						<h3 class="service-name">
							<?php echo wp_kses( $item['title'], 'mitech-default' ); ?>
						</h3>
					<?php endif; ?>

					<?php if ( isset( $item['text'] ) ) : ?>
						<div class="service-text">
							<?php echo wp_kses( $item['text'], 'mitech-default' ); ?>
						</div>
					<?php endif; ?>

				</div>
			</div>
		<?php } ?>
	<?php endif; ?>
</div>
