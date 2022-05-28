<?php
defined( 'ABSPATH' ) || exit;

$style = $el_class = $animation = $align = $custom_text_color = $custom_google_font = '';
$icon  = $icon_class = '';
extract( $this->getAttributes( $atts ) );

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-heading-' );
$this->get_inline_css( "#$css_id" );
Mitech_VC::get_shortcode_custom_css( "#$css_id", $atts );
extract( $atts );

extract( $this->getStyles( $el_class, $css, $google_fonts_data, $atts ) );

$css_class .= " $style $align";

if ( in_array( $style, array( 'typed-text' ), true ) ) {
	wp_enqueue_script( 'typed' );
}

if ( isset( ${"icon_" . $icon_type} ) ) {
	$icon_class = esc_attr( ${"icon_" . $icon_type} );
}

if ( $icon_class !== '' ) {
	$icon = '<span class="icon ' . $icon_class . '"></span>';
}

if ( $animation === '' ) {
	$animation = Mitech::setting( 'shortcode_heading_css_animation' );
}

$css_class .= Mitech_Helper::get_animation_classes( $animation );
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php
	$_style = '';

	if ( $custom_google_font === '1' ) {
		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && ! empty( $settings ) ) {
			$subsets = '&subset=' . implode( ',', $settings );
		} else {
			$subsets = '';
		}

		if ( isset( $google_fonts_data['values']['font_family'] ) ) {
			wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
		}

		if ( ! empty( $styles ) ) {
			$_style .= implode( ';', $styles );
		}
	}

	$content = wpb_js_remove_wpautop( $content );

	$html_before = '';
	$html_after  = '';
	if ( in_array( $style, array( 'below-separator' ) ) ) {
		$html_after .= '<div class="separator"></div>';
	}

	printf( '%s<%s class="heading" style="%s">%s%s</%s>%s', $html_before, $tag, esc_attr( $_style ), $icon, $content, $tag, $html_after );
	?>
</div>

<?php if ( in_array( $style, array( 'typed-text' ), true ) ): ?>
	<?php
	$typed_list = (array) vc_param_group_parse_atts( $typed_list );
	$arr        = array();
	if ( count( $typed_list ) > 0 ) {
		foreach ( $typed_list as $item ) {
			if ( isset( $item['text'] ) && $item['text'] !== '' ) {
				$arr[] = $item['text'];
			}
		}
	}
	?>
	<script>
		jQuery( 'document' ).ready( function( $ ) {
			var id = '<?php echo "#{$css_id}"; ?>';
			var string = '<?php echo json_encode( $arr ); ?>';
			string = JSON.parse( string );
			var text = $( id + ' mark' )
				.text();
			if ( text !== '' ) {
				string.unshift( text );
			}
			Typed.new( id + ' mark', {
				strings: string,
				loop: true,
				typeSpeed: 50,
				backDelay: 1500
			} );
		} );
	</script>
<?php endif; ?>
