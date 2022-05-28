<?php
defined( 'ABSPATH' ) || exit;

$el_class        = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = $css_animation = '';
$effect          = $firefly_color = $firefly_min_size = $firefly_max_size = $firefly_total = $constellation_star_color = $constellation_line_color = '';
$separator_type  = $separator_position = '';
$disable_element = '';
$scrolling_color = '';
$output          = $after_output = '';
$atts            = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );

$css_classes = array(
	'vc_section',
	$el_class,
);

if ( $separator_type !== '' ) {
	$css_classes[] = 'vc_row-has-separator';
}

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if ( $video_bg || $parallax ) {
	$css_classes[] = 'vc_section-has-fill';
}


$wrapper_attributes = array();
// build attributes for wrapper

if ( $background_attachment === 'marque' ) {
	$css_classes[] = 'background-marque';
	$css_classes[] = $marque_direction;

	if ( $marque_pause_on_hover === '1' ) {
		$wrapper_attributes[] = 'data-marque-pause-on-hover="true"';
	}
}

if ( $scrolling_color !== '' ) {
	$css_classes[]        = ' vc_container-scrolling';
	$wrapper_attributes[] = 'data-scrolling-background="' . $scrolling_color . '"';

	wp_enqueue_script( 'mitech-scrolling-background' );
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
	$el_id = uniqid( 'tm-section-' );
}
$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
Mitech_VC::get_vc_section_css( "#$el_id", $atts );
Mitech_VC::get_shortcode_custom_css( "#$el_id", $atts );

if ( $overlay_background !== '' ) {
	$css_classes[] = 'vc_container-has-overlay';
}

if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	}
	$after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = 'vc_row-o-full-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row      = true;
	$css_classes[] = 'vc_section-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_section-flex';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

$parallax_speed = $parallax_speed_bg;
if ( $has_video_bg ) {
	$parallax       = $video_bg_parallax;
	$parallax_speed = $parallax_speed_video;
	$parallax_image = $video_bg_url;
	$css_classes[]  = 'vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
	$css_classes[]        = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( false !== strpos( $parallax, 'fade' ) ) {
		$css_classes[]        = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( false !== strpos( $parallax, 'fixed' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

if ( ! empty( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id  = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}
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

if ( $separator_type !== '' ) {
	$separator_classes = 'vc_row-separator';
	$separator_classes .= " $separator_type";
	$separator_classes .= " $separator_position";
	$output            .= '<div class="' . $separator_classes . '">' . Mitech_VC::get_separator_svg( $atts, $separator_type ) . '</div>';
}

$output .= '</div>';
$output .= $after_output;

echo '' . $output;
