<?php
defined( 'ABSPATH' ) || exit;

$el_class = $image = $action = $custom_link = $animation = $output = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-image-' );
$this->get_inline_css( "#$css_id", $atts );
Mitech_VC::get_shortcode_custom_css( "#$css_id", $atts );
extract( $atts );

$css_class = 'tm-image';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

if ( $action === 'popup' ) {
	wp_enqueue_style( 'lightgallery' );
	wp_enqueue_script( 'lightgallery' );
}

if ( $animation === '' ) {
	$animation = Mitech::setting( 'shortcode_image_css_animation' );
}
$css_class .= Mitech_Helper::get_animation_classes( $animation );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php if ( $image ) : ?>
		<?php
		$_image_tmp = Mitech_Image::get_attachment_by_id( array(
			'id'     => $image,
			'size'   => $image_size,
			'width'  => $image_size_width,
			'height' => $image_size_height,
		) );

		$_image = '<div class="image">' . $_image_tmp . '</div>';

		if ( $action === 'custom_link' ) {

			$_link = vc_build_link( $custom_link );
			if ( $_link['url'] !== '' ) {
				$output .= '<a href="' . esc_url( $_link['url'] ) . '"';

				if ( $_link['target'] !== '' ) {
					$output .= ' target="_blank"';
				}
				if ( $_link['title'] !== '' ) {
					$output .= 'title="' . $_link['title'] . '"';
				}

				$output .= ' >' . $_image . '</a>';
			}

		} elseif ( $action === 'popup' ) {
			$output .= '<div class="tm-light-gallery"><a href="' . Mitech_Image::get_attachment_url_by_id( array( 'id' => $image ) ) . '" class="zoom">' . $_image . '</a></div>';
		} elseif ( $action === 'go_to_home' ) {
			$output .= '<a href="' . esc_url( home_url( '/' ) ) . '">' . $_image . '</a>';
		} else {
			$output .= $_image;
		}

		echo '' . $output;
		?>
	<?php endif; ?>
</div>
