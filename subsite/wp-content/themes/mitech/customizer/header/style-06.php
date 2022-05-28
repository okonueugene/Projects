<?php
$section  = 'header_style_06';
$priority = 1;
$prefix   = 'header_style_06_';

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'overlay',
	'label'    => esc_html__( 'Header Overlay', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'No', 'mitech' ),
		'1' => esc_html__( 'Yes', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'logo',
	'label'    => esc_html__( 'Logo', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'dark',
	'choices'  => array(
		'light' => esc_html__( 'Light', 'mitech' ),
		'dark'  => esc_html__( 'Dark', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'search_popup_enable',
	'label'    => esc_html__( 'Search', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'cart_enable',
	'label'    => esc_html__( 'Mini Cart', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0'             => esc_html__( 'Hide', 'mitech' ),
		'1'             => esc_html__( 'Show', 'mitech' ),
		'hide_on_empty' => esc_html__( 'Hide On Empty', 'mitech' ),
	),
) );

Mitech_Customize::instance()->field_wishlist_enable( array(
	'settings' => $prefix . 'wishlist_enable',
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
) );

Mitech_Customize::instance()->field_social_networks_enable( array(
	'settings' => $prefix . 'social_networks_enable',
	'section'  => $section,
	'priority' => $priority++,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => $prefix . 'header_social_networks_color',
	'label'           => esc_html__( 'Social Networks Color', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'text'       => esc_attr__( 'Text', 'mitech' ),
		'background' => esc_attr__( 'Background', 'mitech' ),
		'border'     => esc_attr__( 'Border', 'mitech' ),
	),
	'default'         => array(
		'text'       => '#696969',
		'background' => 'rgba(0, 0, 0, 0)',
		'border'     => '#e7e7e7',
	),
	'output'          => array(
		array(
			'choice'   => 'text',
			'element'  => '.header-06 .header-social-networks a',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-06 .header-social-networks a',
			'property' => 'background',
		),
		array(
			'choice'   => 'border',
			'element'  => '.header-06 .header-social-networks a',
			'property' => 'border-color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'social_networks_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => $prefix . 'header_social_networks_hover_color',
	'label'           => esc_html__( 'Social Networks Hover Color', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'text'       => esc_attr__( 'Text', 'mitech' ),
		'background' => esc_attr__( 'Background', 'mitech' ),
		'border'     => esc_attr__( 'Border', 'mitech' ),
	),
	'default'         => array(
		'text'       => '#fff',
		'background' => Mitech::PRIMARY_COLOR,
		'border'     => Mitech::PRIMARY_COLOR,
	),
	'output'          => array(
		array(
			'choice'   => 'text',
			'element'  => '.header-06 .header-social-networks a:hover',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-06 .header-social-networks a:hover',
			'property' => 'background',
		),
		array(
			'choice'   => 'border',
			'element'  => '.header-06 .header-social-networks a:hover',
			'property' => 'border-color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'social_networks_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Mitech_Customize::instance()->field_language_switcher_enable( array(
	'settings' => $prefix . 'language_switcher_enable',
	'section'  => $section,
	'priority' => $priority++,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'border_width',
	'label'     => esc_html__( 'Border Bottom Width', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.header-06 .page-header-inner',
			'property' => 'border-bottom-width',
			'units'    => 'px',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'border_color',
	'label'       => esc_html__( 'Border Color', 'mitech' ),
	'description' => esc_html__( 'Controls the header border bottom color.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#eee',
	'output'      => array(
		array(
			'element'  => '.header-06 .page-header-inner',
			'property' => 'border-color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'box_shadow',
	'label'       => esc_html__( 'Box Shadow', 'mitech' ),
	'description' => esc_html__( 'Input box shadow for header. For e.g: 0 0 5px #ccc', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'output'      => array(
		array(
			'element'  => '.header-06 .page-header-inner',
			'property' => 'box-shadow',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'mitech' ),
	'description' => esc_html__( 'Controls the background of header.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.header-06 .page-header-inner',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'header_icon_color',
	'label'       => esc_html__( 'Icon Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color of icons on header.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'default' => esc_attr__( 'Default', 'mitech' ),
		'hover'   => esc_attr__( 'Hover', 'mitech' ),
	),
	'default'     => array(
		'default' => '#333',
		'hover'   => Mitech::PRIMARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'default',
			'element'  => '
			.header-06 .header-right-more,
			.header-06 .wpml-ls-item-toggle,
			.header-06 .page-open-mobile-menu i,
			.header-06 .page-open-main-menu,
			.header-06 .popup-search-wrap i,
			.header-06 .header-wishlist a,
			.header-06 .mini-cart .mini-cart-icon',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '
			.header-06 .header-right-more:hover,
			.header-06 .page-open-mobile-menu:hover i,
			.header-06 .page-open-main-menu:hover,
			.header-06 .popup-search-wrap:hover i,
			.header-06 .mini-cart .mini-cart-icon:hover
			',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.header-06 .wpml-ls-slot-shortcode_actions:hover > .js-wpml-ls-item-toggle',
			'property' => 'color',
			'suffix'   => '!important',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'cart_badge_color',
	'label'       => esc_html__( 'Cart Badge Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color of cart badge.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'color'      => esc_attr__( 'Color', 'mitech' ),
		'background' => esc_attr__( 'Background', 'mitech' ),
	),
	'default'     => array(
		'color'      => '#fff',
		'background' => Mitech::PRIMARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'color',
			'element'  => '.header-06 .mini-cart .mini-cart-icon:after',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-06 .mini-cart .mini-cart-icon:after',
			'property' => 'background-color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Button', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'button_text',
	'label'    => esc_html__( 'Button Text', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'button_link',
	'label'    => esc_html__( 'Button link', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'button_link_target',
	'label'    => esc_html__( 'Open link in a new tab.', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'No', 'mitech' ),
		'1' => esc_html__( 'Yes', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => $prefix . 'button_style',
	'label'    => esc_html__( 'Button Style', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'solid',
	'choices'  => array(
		'solid' => esc_attr__( 'Solid', 'mitech' ),
		'flat'  => esc_attr__( 'Flat', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'button_color',
	'label'    => esc_html__( 'Button Color', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '',
	'choices'  => array(
		''       => esc_html__( 'Default', 'mitech' ),
		'custom' => esc_html__( 'Custom', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => $prefix . 'button_custom_color',
	'label'           => esc_html__( 'Button Color', 'mitech' ),
	'description'     => esc_html__( 'Controls the color of button.', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color'      => esc_attr__( 'Color', 'mitech' ),
		'background' => esc_attr__( 'Background', 'mitech' ),
		'border'     => esc_attr__( 'Border', 'mitech' ),
	),
	'default'         => array(
		'color'      => Mitech::PRIMARY_COLOR,
		'background' => 'rgba(0, 0, 0, 0)',
		'border'     => Mitech::PRIMARY_COLOR,
	),
	'output'          => array(
		array(
			'choice'   => 'color',
			'element'  => '.header-06 .header-button',
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => '.header-06 .header-button',
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-06 .header-button',
			'property' => 'background',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'button_color',
			'operator' => '==',
			'value'    => 'custom',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => $prefix . 'button_hover_custom_color',
	'label'           => esc_html__( 'Button Hover Color', 'mitech' ),
	'description'     => esc_html__( 'Controls the color of button when hover.', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color'      => esc_attr__( 'Color', 'mitech' ),
		'background' => esc_attr__( 'Background', 'mitech' ),
		'border'     => esc_attr__( 'Border', 'mitech' ),
	),
	'default'         => array(
		'color'      => '#fff',
		'background' => Mitech::PRIMARY_COLOR,
		'border'     => Mitech::PRIMARY_COLOR,
	),
	'output'          => array(
		array(
			'choice'   => 'color',
			'element'  => '.header-06 .header-button:hover',
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => '.header-06 .header-button:hover',
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-06 .header-button:hover',
			'property' => 'background',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'button_color',
			'operator' => '==',
			'value'    => 'custom',
		),
	),
) );
