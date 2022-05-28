<?php
$section  = 'header_more_options';
$priority = 1;
$prefix   = 'header_more_options_';

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'mitech' ),
	'description' => esc_html__( 'Controls the background of header more options.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '#ffffff',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.header-more-tools-opened .header-right-inner',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'icon_color',
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
			.header-more-tools-opened .header-right-inner .header-right-more,
			.header-more-tools-opened .header-right-inner .wpml-ls-item-toggle,
			.header-more-tools-opened .header-right-inner .page-open-main-menu,
			.header-more-tools-opened .header-right-inner .page-open-mobile-menu i,
			.header-more-tools-opened .header-right-inner .popup-search-wrap i,
			.header-more-tools-opened .header-right-inner .mini-cart .mini-cart-icon',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '
			.header-more-tools-opened .header-right-inner .header-right-more:hover,
			.header-more-tools-opened .header-right-inner .page-open-main-menu:hover,
			.header-more-tools-opened .header-right-inner .page-open-mobile-menu:hover i,
			.header-more-tools-opened .header-right-inner .popup-search-wrap:hover i,
			.header-more-tools-opened .header-right-inner .mini-cart .mini-cart-icon:hover
			',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.header-more-tools-opened .header-right-inner .wpml-ls-slot-shortcode_actions:hover > .js-wpml-ls-item-toggle',
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
			'element'  => '.header-more-tools-opened .header-right-inner .mini-cart .mini-cart-icon:after',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-more-tools-opened .header-right-inner .mini-cart .mini-cart-icon:after',
			'property' => 'background-color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => $prefix . 'social_networks_color',
	'label'     => esc_html__( 'Social Networks Color', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'text'       => esc_attr__( 'Text', 'mitech' ),
		'background' => esc_attr__( 'Background', 'mitech' ),
		'border'     => esc_attr__( 'Border', 'mitech' ),
	),
	'default'   => array(
		'text'       => '#696969',
		'background' => 'rgba(0, 0, 0, 0)',
		'border'     => 'rgba(0, 0, 0, 0)',
	),
	'output'    => array(
		array(
			'choice'   => 'text',
			'element'  => '.header-more-tools-opened .header-right-inner .header-social-networks a',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-more-tools-opened .header-right-inner .header-social-networks a',
			'property' => 'background',
		),
		array(
			'choice'   => 'border',
			'element'  => '.header-more-tools-opened .header-right-inner .header-social-networks a',
			'property' => 'border-color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => $prefix . 'social_networks_hover_color',
	'label'     => esc_html__( 'Social Networks Hover Color', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'text'       => esc_attr__( 'Text', 'mitech' ),
		'background' => esc_attr__( 'Background', 'mitech' ),
		'border'     => esc_attr__( 'Border', 'mitech' ),
	),
	'default'   => array(
		'text'       => Mitech::PRIMARY_COLOR,
		'background' => 'rgba(0, 0, 0, 0)',
		'border'     => 'rgba(0, 0, 0, 0)',
	),
	'output'    => array(
		array(
			'choice'   => 'text',
			'element'  => '.header-more-tools-opened .header-right-inner .header-social-networks a:hover',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-more-tools-opened .header-right-inner .header-social-networks a:hover',
			'property' => 'background',
		),
		array(
			'choice'   => 'border',
			'element'  => '.header-more-tools-opened .header-right-inner .header-social-networks a:hover',
			'property' => 'border-color',
		),
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
			'element'  => '.header-sticky-button .tm-button',
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => '.header-sticky-button.tm-button',
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-sticky-button.tm-button',
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
			'element'  => '.header-sticky-button.tm-button:hover',
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => '.header-sticky-button.tm-button:hover',
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-sticky-button.tm-button:hover',
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
