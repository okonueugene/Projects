<?php
defined( 'ABSPATH' ) || exit;

/**
 * Shortcode attributes
 *
 * @var $atts
 * @var $el_class
 * @var $css
 * @var $el_id
 * @var $equal_height
 * @var $content_placement
 * @var $content - shortcode content
 * Shortcode class
 * @var $this    WPBakeryShortCode_VC_Row_Inner
 */
$el_class        = $equal_height = $content_placement = $css = $el_id = '';
$disable_element = '';
$output          = $after_output = '';
$effect          = $firefly_color = $firefly_min_size = $firefly_max_size = $firefly_total = '';
$atts            = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class    = $this->getExtraClass( $el_class );
$css_classes = array(
	'vc_row',
	'vc_inner',
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if ( $overlay_background !== '' ) {
	$css_classes[] = 'vc_container-has-overlay';
}

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if ( vc_shortcode_custom_css_has_property( $css, array( 'border', 'background' ) ) ) {
	$css_classes[] = 'vc_row-has-fill';
}

if ( ! empty( $atts['gap'] ) ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

if ( ! empty( $equal_height ) ) {
	$flex_row      = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row      = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$wrapper_attributes = array();
// build attributes for wrapper.

if ( $background_attachment === 'marque' ) {
	$css_classes[] = 'background-marque';
	$css_classes[] = $marque_direction;

	if ( $marque_pause_on_hover === '1' ) {
		$wrapper_attributes[] = 'data-marque-pause-on-hover="true"';
	}
}

if ( $effect !== '' ) {
	$css_classes[] = "has-effect tm-effect-$effect";

	if ( $effect === 'firefly' ) {
		wp_enqueue_script( 'firefly' );

		if ( $firefly_color !== '' ) {
			$wrapper_attributes[] = 'data-firefly-color="' . $firefly_color . '"';
		}

		if ( $firefly_total !== '' ) {
			$wrapper_attributes[] = 'data-firefly-total="' . $firefly_total . '"';
		}

		if ( $firefly_min_size !== '' ) {
			$wrapper_attributes[] = 'data-firefly-min="' . $firefly_min_size . '"';
		}

		if ( $firefly_max_size !== '' ) {
			$wrapper_attributes[] = 'data-firefly-max="' . $firefly_max_size . '"';
		}
	} elseif ( $effect === 'wavify' ) {
		wp_enqueue_script( 'wavify' );
	} elseif ( $effect === 'constellation' ) {
		wp_enqueue_script( 'constellation' );
	}
}

if ( $el_id === '' ) {
	$el_id = uniqid( 'tm-row-inner-' );
}
Mitech_VC::get_vc_row_inner_css( '#' . $el_id, $atts );
Mitech_VC::get_shortcode_custom_css( "#$el_id", $atts );
$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';

$css_class            = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';

if ( $overlay_background !== '' ) {
	$output .= '<div class="vc_container-overlay"></div>';
}

if ( $effect === 'firefly' ) {
	$output .= '<div class="firefly-wrapper"></div>';
} elseif ( $effect === 'grid' ) {
	$output .= '<div class="grid-wrapper"><div class="line line-1"></div><div class="line line-2"></div><div class="line line-3"></div><div class="line line-4"></div></div>';
} elseif ( $effect === 'wavify' ) {
	$wavify_items = (array) vc_param_group_parse_atts( $wavify_items );

	if ( count( $wavify_items ) > 0 ) {


		$output .= '<div class="wavify-wrapper">';

		ob_start();

		foreach ( $wavify_items as $wavify_item ) {
			?>
			<svg width="100%" height="100%" version="1.1" xmlns="https://www.w3.org/2000/svg" class="wavify-item"
				<?php if ( isset( $wavify_item['height'] ) ) : ?>
					data-wavify-height="<?php echo esc_attr( $wavify_item['height'] ); ?>"
				<?php endif; ?>

				<?php if ( isset( $wavify_item['background'] ) ) : ?>
					data-wavify-background="<?php echo esc_attr( $wavify_item['background'] ); ?>"
				<?php endif; ?>

				<?php if ( isset( $wavify_item['amplitude'] ) ) : ?>
					data-wavify-amplitude="<?php echo esc_attr( $wavify_item['amplitude'] ); ?>"
				<?php endif; ?>

				<?php if ( isset( $wavify_item['bones'] ) ) : ?>
					data-wavify-bones="<?php echo esc_attr( $wavify_item['bones'] ); ?>"
				<?php endif; ?>
			>
				<title>Wave</title>
				<defs></defs>
				<path d=""/>
			</svg>
			<?php
		}

		$wavify_template = ob_get_clean();


		$output .= $wavify_template;

		$output .= '</div>';
	}
} elseif ( $effect === 'constellation' ) {
	$_color = Mitech_Color::get_hex( $constellation_line_color );
	$_alpha = Mitech_Color::get_alpha( $constellation_line_color );

	$constellation_atts[] = 'data-line-color="' . esc_attr( $_color ) . '"';
	$constellation_atts[] = 'data-line-alpha="' . esc_attr( $_alpha ) . '"';

	$_color = Mitech_Color::get_hex( $constellation_star_color );
	$_alpha = Mitech_Color::get_alpha( $constellation_star_color );

	$constellation_atts[] = 'data-star-color="' . esc_attr( $_color ) . '"';
	$constellation_atts[] = 'data-star-alpha="' . esc_attr( $_alpha ) . '"';

	$constellation_atts[] = 'id="' . esc_attr( uniqid( 'constellation-' ) ) . '"';
	$output               .= '<div class="constellation-wrapper" ' . implode( ' ', $constellation_atts ) . '></div>';
}

$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= $after_output;

echo '' . $output;
