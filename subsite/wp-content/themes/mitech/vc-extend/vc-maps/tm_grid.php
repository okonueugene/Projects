<?php

class WPBakeryShortCode_TM_Grid extends WPBakeryShortCodesContainer {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;
		global $mitech_shortcode_md_css;
		global $mitech_shortcode_sm_css;
		global $mitech_shortcode_xs_css;

		Mitech_VC::get_grid_css( $selector, $atts );

		Mitech_VC::get_vc_spacing_css( $selector, $atts );

		$tmp = '';

		if ( $atts['content_align'] === 'top' ) {
			$tmp .= 'align-self: start;';
		} elseif ( $atts['content_align'] === 'center' ) {
			$tmp .= 'align-self: center;';
		} elseif ( $atts['content_align'] === 'bottom' ) {
			$tmp .= 'align-self: end;';
		}

		if ( $tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .tm-grid .grid-item{ $tmp }";
		}

		if ( isset( $atts['equal_height'] ) && $atts['equal_height'] !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .tm-grid .grid-item > div{ height: 100%; }";
		}

		if ( isset( $atts['max_width'] ) && $atts['max_width'] !== '' ) {
			Mitech_VC::get_responsive_css( array(
				'element' => "$selector .tm-grid",
				'atts'    => array(
					'width' => array(
						'media_str' => $atts['max_width'],
						'unit'      => 'px',
					),
				),
			) );
		}

		if ( isset( $atts['item_max_width'] ) && $atts['item_max_width'] !== '' ) {
			Mitech_VC::get_responsive_css( array(
				'element' => "$selector .grid-item",
				'atts'    => array(
					'max-width' => array(
						'media_str' => $atts['item_max_width'],
						'unit'      => 'px',
					),
				),
			) );

			if ( isset( $atts['centered_items'] ) && $atts['centered_items'] === '1' ) {
				$mitech_shortcode_lg_css .= "$selector .grid-item { margin-left: auto; margin-right: auto; }";
			}
		}

		$tmp = '';

		if ( $atts['align'] === 'left' ) {
			$tmp .= 'justify-content: flex-start';
		} elseif ( $atts['align'] === 'center' ) {
			$tmp .= 'justify-content: center;';
		} elseif ( $atts['align'] === 'right' ) {
			$tmp .= 'justify-content: flex-end;';
		}

		$mitech_shortcode_lg_css .= "$selector { $tmp }";

		$tmp = '';
		if ( $atts['md_align'] !== '' ) {

			if ( $atts['md_align'] === 'left' ) {
				$tmp .= 'justify-content: flex-start';
			} elseif ( $atts['md_align'] === 'center' ) {
				$tmp .= 'justify-content: center;';
			} elseif ( $atts['md_align'] === 'right' ) {
				$tmp .= 'justify-content: flex-end;';
			}

			$mitech_shortcode_md_css .= "$selector { $tmp }";
		}

		$tmp = '';
		if ( $atts['sm_align'] !== '' ) {

			if ( $atts['sm_align'] === 'left' ) {
				$tmp .= 'justify-content: flex-start';
			} elseif ( $atts['sm_align'] === 'center' ) {
				$tmp .= 'justify-content: center;';
			} elseif ( $atts['sm_align'] === 'right' ) {
				$tmp .= 'justify-content: flex-end;';
			}

			$mitech_shortcode_sm_css .= "$selector { $tmp }";
		}

		$tmp = '';
		if ( $atts['xs_align'] !== '' ) {
			if ( $atts['xs_align'] === 'left' ) {
				$tmp .= 'justify-content: flex-start';
			} elseif ( $atts['xs_align'] === 'center' ) {
				$tmp .= 'justify-content: center;';
			} elseif ( $atts['xs_align'] === 'right' ) {
				$tmp .= 'justify-content: flex-end;';
			}

			$mitech_shortcode_xs_css .= "$selector { $tmp }";
		}
	}
}

vc_map( array(
	'name'            => esc_html__( 'Grid Anything', 'mitech' ),
	'base'            => 'tm_grid',
	'category'        => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'            => 'insight-i insight-i-portfoliogrid',
	'as_parent'       => array( 'only' => 'tm_box_icon,tm_box_image,tm_box_large_image,tm_pricing,tm_counter,tm_team_member,tm_rotate_box,tm_group' ),
	'content_element' => true,
	'is_container'    => true,
	'js_view'         => 'VcColumnView',
	'params'          => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'None', 'mitech' )                     => '',
				esc_html__( 'Square', 'mitech' )                   => 'square',
				esc_html__( 'With rounded', 'mitech' )             => 'rounded',
				esc_html__( 'With separator', 'mitech' )           => 'border',
				esc_html__( 'With dashed separator', 'mitech' )    => 'dashed-inner',
				esc_html__( 'With short separator', 'mitech' )     => 'short-separator',
				esc_html__( 'With separator 02', 'mitech' )        => 'border-02',
				esc_html__( 'Wrapped border', 'mitech' )           => 'border-03',
				esc_html__( 'Wrapped border 02', 'mitech' )        => 'border-04',
				esc_html__( 'With separator rounded', 'mitech' )   => 'border-rounded',
				esc_html__( 'Modern Metro - 3 Columns', 'mitech' ) => 'modern-metro-3-columns',
			),
			'std'         => '',
		),
	), Mitech_VC::get_alignment_fields(), array(
		array(
			'heading'     => esc_html__( 'Columns', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'columns',
			'min'         => 1,
			'max'         => 6,
			'step'        => 1,
			'suffix'      => '',
			'media_query' => array(
				'lg' => '4',
				'md' => '3',
				'sm' => '2',
				'xs' => '1',
			),
			'dependency'  => array(
				'element'            => 'style',
				'value_not_equal_to' => 'modern-metro-3-columns',
			),
		),
		array(
			'heading'     => esc_html__( 'Columns Gutter', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'column_gutter',
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
		array(
			'heading'     => esc_html__( 'Row Gutter', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'row_gutter',
			'min'         => 0,
			'max'         => 200,
			'step'        => 1,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
		array(
			'heading'     => esc_html__( 'Grid Max Width', 'mitech' ),
			'description' => esc_html__( 'Controls the max width of grid', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'max_width',
			'min'         => 1,
			'max'         => 2000,
			'step'        => 1,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
		array(
			'heading'     => esc_html__( 'Grid Items Max Width', 'mitech' ),
			'description' => esc_html__( 'Controls the max width of items', 'mitech' ),
			'type'        => 'number_responsive',
			'param_name'  => 'item_max_width',
			'min'         => 1,
			'max'         => 1000,
			'step'        => 1,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
		array(
			'heading'    => esc_html__( 'Content position', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'content_align',
			'value'      => array(
				esc_html__( 'Default', 'mitech' ) => '',
				esc_html__( 'Top', 'mitech' )     => 'top',
				esc_html__( 'Center', 'mitech' )  => 'center',
				esc_html__( 'Bottom', 'mitech' )  => 'bottom',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Centered Items', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'centered_items',
			'value'      => array(
				esc_html__( 'Yes', 'mitech' ) => '1',
			),
		),
		array(
			'heading'    => esc_html__( 'Equal Height', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'equal_height',
			'value'      => array(
				esc_html__( 'Yes', 'mitech' ) => '1',
			),
		),
		Mitech_VC::get_animation_field(),
		Mitech_VC::equal_height_class_field(),
		Mitech_VC::extra_class_field(),
	), Mitech_VC::get_vc_spacing_tab(), Mitech_VC::get_custom_style_tab() ),
) );
