<?php

class WPBakeryShortCode_TM_W_Better_Custom_Menu extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;
		global $mitech_shortcode_md_css;
		global $mitech_shortcode_sm_css;
		global $mitech_shortcode_xs_css;

		$link_tmp       = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['link_color'], $atts['custom_link_color'] );
		$link_hover_tmp = Mitech_Helper::get_shortcode_css_color_inherit( 'color', $atts['link_hover_color'], $atts['custom_link_hover_color'] );


		if ( $atts['align'] !== '' ) {
			$mitech_shortcode_lg_css .= "$selector .menu { text-align: {$atts['align']}; }";
		}

		if ( $atts['md_align'] !== '' ) {
			$mitech_shortcode_md_css .= "$selector .menu { text-align: {$atts['md_align']} }";
		}

		if ( $atts['sm_align'] !== '' ) {
			$mitech_shortcode_sm_css .= "$selector .menu { text-align: {$atts['sm_align']} }";
		}

		if ( $atts['xs_align'] !== '' ) {
			$mitech_shortcode_xs_css .= "$selector .menu { text-align: {$atts['xs_align']} }";
		}

		if ( $link_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector a { $link_tmp }";
		}

		if ( $link_hover_tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector a:hover { $link_hover_tmp }";
		}
	}
}

$custom_menus = array();
if ( 'vc_edit_form' === vc_post_param( 'action' ) && vc_verify_admin_nonce() ) {
	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
	if ( is_array( $menus ) && ! empty( $menus ) ) {
		foreach ( $menus as $single_menu ) {
			if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
				$custom_menus[ $single_menu->name ] = $single_menu->slug;
			}
		}
	}
}

$styling_tab = esc_html__( 'Styling', 'mitech' );

vc_map( array(
	'name'     => esc_html__( 'Widget Better Custom Menu', 'mitech' ),
	'base'     => 'tm_w_better_custom_menu',
	'category' => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-custom-menu',
	'class'    => 'wpb_vc_wp_widget',
	'params'   => array_merge(
		array(
			array(
				'heading'     => esc_html__( 'Widget title', 'mitech' ),
				'type'        => 'textfield',
				'param_name'  => 'title',
				'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'mitech' ),
			),
			array(
				'heading'    => esc_html__( 'Style', 'mitech' ),
				'type'       => 'dropdown',
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Normal', 'mitech' )     => '01',
					esc_html__( '02 Columns', 'mitech' ) => '02',
					esc_html__( 'Inline', 'mitech' )     => '03',
				),
				'std'        => '01',
			),
			array(
				'heading'     => esc_html__( 'Menu', 'mitech' ),
				'description' => empty( $custom_menus ) ? wp_kses( __( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'mitech' ), array(
					'b' => array(),

				) ) : esc_html__( 'Select menu to display.', 'mitech' ),
				'type'        => 'dropdown',
				'param_name'  => 'nav_menu',
				'value'       => $custom_menus,
				'save_always' => true,
				'admin_label' => true,
			),
		),
		Mitech_VC::get_alignment_fields(),
		array(
			Mitech_VC::extra_class_field(),
			array(
				'group'            => $styling_tab,
				'heading'          => esc_html__( 'Link Color', 'mitech' ),
				'type'             => 'dropdown',
				'param_name'       => 'link_color',
				'value'            => array(
					esc_html__( 'Default Color', 'mitech' )   => '',
					esc_html__( 'Primary Color', 'mitech' )   => 'primary',
					esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
					esc_html__( 'Custom Color', 'mitech' )    => 'custom',
				),
				'std'              => '',
				'edit_field_class' => 'vc_col-sm-6 col-break',
			),
			array(
				'group'            => $styling_tab,
				'heading'          => esc_html__( 'Custom Link Color', 'mitech' ),
				'type'             => 'colorpicker',
				'param_name'       => 'custom_link_color',
				'dependency'       => array(
					'element' => 'link_color',
					'value'   => array( 'custom' ),
				),
				'std'              => '#fff',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'group'            => $styling_tab,
				'heading'          => esc_html__( 'Link Hover Color', 'mitech' ),
				'type'             => 'dropdown',
				'param_name'       => 'link_hover_color',
				'value'            => array(
					esc_html__( 'Default Color', 'mitech' )   => '',
					esc_html__( 'Primary Color', 'mitech' )   => 'primary',
					esc_html__( 'Secondary Color', 'mitech' ) => 'secondary',
					esc_html__( 'Custom Color', 'mitech' )    => 'custom',
				),
				'std'              => '',
				'edit_field_class' => 'vc_col-sm-6 col-break',
			),
			array(
				'group'            => $styling_tab,
				'heading'          => esc_html__( 'Custom Link Hover Color', 'mitech' ),
				'type'             => 'colorpicker',
				'param_name'       => 'custom_link_hover_color',
				'dependency'       => array(
					'element' => 'link_hover_color',
					'value'   => array( 'custom' ),
				),
				'std'              => '#fff',
				'edit_field_class' => 'vc_col-sm-6',
			),
		),
		Mitech_VC::get_custom_style_tab()
	),

) );
