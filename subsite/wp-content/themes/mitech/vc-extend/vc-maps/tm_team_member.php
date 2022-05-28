<?php

class WPBakeryShortCode_TM_Team_Member extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Team Member', 'mitech' ),
	'base'                      => 'tm_team_member',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'allowed_container_element' => 'vc_row',
	'icon'                      => 'insight-i insight-i-member',
	'params'                    => array_merge( array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'mitech' ) => '01',
				esc_html__( '02', 'mitech' ) => '02',
				esc_html__( '03', 'mitech' ) => '03',
				esc_html__( '04', 'mitech' ) => '04',
			),
			'std'         => '01',
		),
		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__( 'Photo of member', 'mitech' ),
			'param_name'  => 'photo',
			'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Name', 'mitech' ),
			'admin_label' => true,
			'param_name'  => 'name',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Position', 'mitech' ),
			'param_name'  => 'position',
			'description' => esc_html__( 'Example: CEO/Founder', 'mitech' ),
		),
		array(
			'type'       => 'textarea',
			'heading'    => esc_html__( 'Description', 'mitech' ),
			'param_name' => 'desc',
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Profile url', 'mitech' ),
			'param_name' => 'profile',
		),
		Mitech_VC::get_animation_field(),
		Mitech_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Social Networks', 'mitech' ),
			'heading'    => esc_html__( 'Show tooltip as item title.', 'mitech' ),
			'type'       => 'checkbox',
			'param_name' => 'tooltip_enable',
			'value'      => array(
				esc_html__( 'Yes', 'mitech' ) => '1',
			),
		),
		array(
			'group'      => esc_html__( 'Social Networks', 'mitech' ),
			'heading'    => esc_html__( 'Tooltip Skin', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'tooltip_skin',
			'value'      => Mitech_VC::get_tooltip_skin_list(),
			'std'        => '',
			'dependency' => array(
				'element' => 'tooltip_enable',
				'value'   => '1',
			),
		),
		array(
			'group'      => esc_html__( 'Social Networks', 'mitech' ),
			'heading'    => esc_html__( 'Tooltip Position', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'tooltip_position',
			'value'      => array(
				esc_html__( 'Top', 'mitech' )    => 'top',
				esc_html__( 'Right', 'mitech' )  => 'right',
				esc_html__( 'Bottom', 'mitech' ) => 'bottom',
				esc_html__( 'Left', 'mitech' )   => 'left',
			),
			'std'        => 'top',
			'dependency' => array(
				'element' => 'tooltip_enable',
				'value'   => '1',
			),
		),
		array(
			'group'      => esc_html__( 'Social Networks', 'mitech' ),
			'type'       => 'param_group',
			'heading'    => esc_html__( 'Social Networks', 'mitech' ),
			'param_name' => 'social_networks',
			'params'     => array_merge( Mitech_VC::icon_libraries( array( 'allow_none' => true ) ), array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Link', 'mitech' ),
					'param_name'  => 'link',
					'admin_label' => true,
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title', 'mitech' ),
					'param_name'  => 'title',
					'admin_label' => true,
				),
			) ),
			'value'      => rawurlencode( wp_json_encode( array(
				array(
					'link'              => '#',
					'icon_type'         => 'fontawesome5',
					'icon_fontawesome5' => 'fab fa-facebook',
					'title'             => esc_html__( 'Facebook', 'mitech' ),
				),
				array(
					'link'              => '#',
					'icon_type'         => 'fontawesome5',
					'icon_fontawesome5' => 'fab fa-twitter',
					'title'             => esc_html__( 'Twitter', 'mitech' ),
				),
				array(
					'link'              => '#',
					'icon_type'         => 'fontawesome5',
					'icon_fontawesome5' => 'fab fa-instagram',
					'title'             => esc_html__( 'Instagram', 'mitech' ),
				),
			) ) ),
		),
	), Mitech_VC::get_vc_spacing_tab() ),
) );
