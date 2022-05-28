<?php

class WPBakeryShortCode_TM_Gmaps extends WPBakeryShortCode {

	public function convertAttributesToNewMarker( $atts ) {
		if ( isset( $atts['markers'] ) && strlen( $atts['markers'] ) > 0 ) {
			$markers = vc_param_group_parse_atts( $atts['markers'] );

			if ( ! is_array( $markers ) ) {
				$temp         = explode( ',', $atts['markers'] );
				$paramMarkers = array();

				foreach ( $temp as $marker ) {
					$data = explode( '|', $marker );

					$newMarker            = array();
					$newMarker['address'] = isset( $data[0] ) ? $data[0] : '';
					$newMarker['icon']    = isset( $data[1] ) ? $data[1] : '';
					$newMarker['title']   = isset( $data[2] ) ? $data[2] : '';
					$newMarker['info']    = isset( $data[3] ) ? $data[3] : '';

					$paramMarkers[] = $newMarker;
				}

				$atts['markers'] = urlencode( json_encode( $paramMarkers ) );

			}

			return $atts;
		}
	}
}

vc_map( array(
	'name'     => esc_html__( 'Google Maps', 'mitech' ),
	'base'     => 'tm_gmaps',
	'icon'     => 'insight-i insight-i-map',
	'category' => MITECH_VC_SHORTCODE_CATEGORY,
	'params'   => array(
		array(
			'heading'     => esc_html__( 'Height', 'mitech' ),
			'description' => esc_html__( 'Enter map height (in pixels or %)', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'map_height',
			'value'       => '480',
		),
		array(
			'heading'     => esc_html__( 'Width', 'mitech' ),
			'description' => esc_html__( 'Enter map width (in pixels or %)', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'map_width',
			'value'       => '100%',
		),
		array(
			'heading'     => esc_html__( 'Zoom Level', 'mitech' ),
			'description' => esc_html__( 'Map zoom level', 'mitech' ),
			'type'        => 'number',
			'param_name'  => 'zoom',
			'value'       => 16,
			'max'         => 17,
			'min'         => 1,
		),
		array(
			'type'       => 'checkbox',
			'param_name' => 'zoom_enable',
			'value'      => array(
				esc_html__( 'Enable mouse scroll wheel zoom', 'mitech' ) => 'yes',
			),
		),
		array(
			'heading'     => esc_html__( 'Map Type', 'mitech' ),
			'description' => esc_html__( 'Choose a map type', 'mitech' ),
			'type'        => 'dropdown',
			'admin_label' => true,
			'param_name'  => 'map_type',
			'value'       => array(
				esc_html__( 'Roadmap', 'mitech' )   => 'roadmap',
				esc_html__( 'Satellite', 'mitech' ) => 'satellite',
				esc_html__( 'Hybrid', 'mitech' )    => 'hybrid',
				esc_html__( 'Terrain', 'mitech' )   => 'terrain',
			),
		),
		array(
			'heading'     => esc_html__( 'Map Style', 'mitech' ),
			'description' => esc_html__( 'Choose a map style. This approach changes the style of the Roadmap types (base imagery in terrain and satellite views is not affected, but roads, labels, etc. respect styling rules)', 'mitech' ),
			'type'        => 'image_radio',
			'admin_label' => true,
			'param_name'  => 'map_style',
			'value'       => array(
				'no_label_bright_colors'  => array(
					'url'   => MITECH_THEME_IMAGE_URI . '/maps/no-label-bright-colors.jpg',
					'title' => esc_attr__( 'No Label Bright Colors', 'mitech' ),
				),
				'grayscale'               => array(
					'url'   => MITECH_THEME_IMAGE_URI . '/maps/greyscale.png',
					'title' => esc_attr__( 'Grayscale', 'mitech' ),
				),
				'subtle_grayscale'        => array(
					'url'   => MITECH_THEME_IMAGE_URI . '/maps/subtle-grayscale.png',
					'title' => esc_attr__( 'Subtle Grayscale', 'mitech' ),
				),
				'apple_paps_esque'        => array(
					'url'   => MITECH_THEME_IMAGE_URI . '/maps/apple-maps-esque.png',
					'title' => esc_attr__( 'Apple Maps-esque', 'mitech' ),
				),
				'pale_dawn'               => array(
					'url'   => MITECH_THEME_IMAGE_URI . '/maps/pale-dawn.png',
					'title' => esc_attr__( 'Pale Dawn', 'mitech' ),
				),
				'midnight_commander'      => array(
					'url'   => MITECH_THEME_IMAGE_URI . '/maps/midnight-commander.png',
					'title' => esc_attr__( 'Midnight Commander', 'mitech' ),
				),
				'blue_water'              => array(
					'url'   => MITECH_THEME_IMAGE_URI . '/maps/blue-water.png',
					'title' => esc_attr__( 'Blue Water', 'mitech' ),
				),
				'retro'                   => array(
					'url'   => MITECH_THEME_IMAGE_URI . '/maps/retro.png',
					'title' => esc_attr__( 'Retro', 'mitech' ),
				),
				'paper'                   => array(
					'url'   => MITECH_THEME_IMAGE_URI . '/maps/paper.png',
					'title' => esc_attr__( 'Paper', 'mitech' ),
				),
				'ultra_light_with_labels' => array(
					'url'   => MITECH_THEME_IMAGE_URI . '/maps/ultra-light-with-labels.png',
					'title' => esc_attr__( 'Ultra Light with Labels', 'mitech' ),
				),
				'shades_of_grey'          => array(
					'url'   => MITECH_THEME_IMAGE_URI . '/maps/shades-of-grey.png',
					'title' => esc_attr__( 'Shades Of Grey', 'mitech' ),
				),
			),
			'std'         => 'ultra_light_with_labels',
		),
		array(
			'group'       => esc_html__( 'Markers', 'mitech' ),
			'heading'     => esc_html__( 'Marker Style', 'mitech' ),
			'description' => esc_html__( 'Select default style for all markers', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'marker_style',
			'value'       => array(
				esc_html__( 'Icon', 'mitech' )   => 'icon',
				esc_html__( 'Signal', 'mitech' ) => 'signal',
			),
			'std'         => 'icon',
		),
		array(
			'group'       => esc_html__( 'Markers', 'mitech' ),
			'heading'     => esc_html__( 'Marker Icon', 'mitech' ),
			'description' => esc_html__( 'Choose a image as default marker icon for all addresses. Leave blank to use default.', 'mitech' ),
			'type'        => 'attach_image',
			'param_name'  => 'marker_icon',
			'dependency'  => array(
				'element' => 'marker_style',
				'value'   => 'icon',
			),
		),
		array(
			'group'       => esc_html__( 'Markers', 'mitech' ),
			'heading'     => esc_html__( 'Markers', 'mitech' ),
			'description' => esc_html__( 'You can add multiple markers to the map', 'mitech' ),
			'type'        => 'param_group',
			'param_name'  => 'markers',
			'value'       => urlencode( json_encode( array(
				array(
					'address' => '40.7590615,-73.969231',
				),
			) ) ),
			'params'      => array(
				array(
					'heading'     => esc_html__( 'Address or Coordinate', 'mitech' ),
					'description' => sprintf( wp_kses( __( 'Enter address or coordinate. Find coordinates using the name and/or address of the place using <a href="%s" target="_blank">this simple tool here.</a>', 'mitech' ), array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) ), esc_url( 'https://universimmedia.pagesperso-orange.fr/geo/loc.htm' ) ),
					'type'        => 'textfield',
					'param_name'  => 'address',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Marker Style', 'mitech' ),
					'type'       => 'dropdown',
					'param_name' => 'marker_style',
					'value'      => array(
						esc_html__( 'Default', 'mitech' ) => '',
						esc_html__( 'Icon', 'mitech' )    => 'icon',
						esc_html__( 'Signal', 'mitech' )  => 'signal',
					),
					'std'        => '',
				),
				array(
					'heading'     => esc_html__( 'Marker Icon', 'mitech' ),
					'description' => esc_html__( 'Choose a image for marker address', 'mitech' ),
					'type'        => 'attach_image',
					'param_name'  => 'icon',
					'dependency'  => array(
						'element' => 'marker_style',
						'value'   => 'icon',
					),
				),
				array(
					'heading'    => esc_html__( 'Title', 'mitech' ),
					'type'       => 'textfield',
					'param_name' => 'title',
				),
				array(
					'heading'    => esc_html__( 'Content', 'mitech' ),
					'type'       => 'textarea',
					'param_name' => 'info',
				),
				array(
					'heading'     => esc_html__( 'Image', 'mitech' ),
					'description' => esc_html__( 'Choose a image that displays on left info box', 'mitech' ),
					'type'        => 'attach_image',
					'param_name'  => 'image',
				),
			),
		),
	),
) );
