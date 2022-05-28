<?php
defined( 'ABSPATH' ) || exit;

$style = $el_class = $text = $button = '';
$image = $image_size = $image_size_width = $image_size_height = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-banner-' );
$this->get_inline_css( "#$css_id", $atts );
Mitech_VC::get_shortcode_custom_css( "$css_id", $atts );
extract( $atts );

$css_class = 'tm-banner';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

if ( $style === '01' ) {
	$button_class = 'style-flat';
} elseif ( $style === '02' ) {
	$button_class = 'style-link-text';
}

$css_class .= Mitech_Helper::get_animation_classes();
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="banner-wrap">
		<?php if ( $image ) : ?>
			<div class="banner-image">
				<?php Mitech_Image::the_attachment_by_id( array(
					'id'     => $image,
					'size'   => $image_size,
					'width'  => $image_size_width,
					'height' => $image_size_height,
				) ); ?>
			</div>
		<?php endif; ?>

		<div class="banner-content-wrap">
			<div class="banner-content-inner">
				<div class="banner-content-main">
					<?php if ( $text ) : ?>
						<?php echo '<h6 class="banner-heading">' . $text . '</h6>'; ?>
					<?php endif; ?>

					<?php
					if ( $button && $button !== '' ) {
						$button = vc_build_link( $button );
						if ( $button['url'] !== '' ) {
							?>
							<a class="tm-button tm-button-nm tm-banner-button <?php echo esc_attr( $button_class ); ?>"
							   href="<?php echo esc_url( $button['url'] ) ?>"
								<?php if ( $button['target'] !== '' ) { ?>
									target="<?php echo esc_attr( $button['target'] ); ?>"
								<?php } ?>
							>
								<span class="button-text"><?php echo esc_html( $button['title'] ); ?></span>
							</a>
						<?php }
					} ?>
				</div>
			</div>
		</div>
	</div>
</div>
