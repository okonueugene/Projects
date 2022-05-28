<?php
$section  = 'header_sticky';
$priority = 1;
$prefix   = 'header_sticky_';

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => $prefix . 'enable',
	'label'       => esc_html__( 'Enable', 'mitech' ),
	'description' => esc_html__( 'Enable this option to turn on header sticky feature.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'behaviour',
	'label'       => esc_html__( 'Behaviour', 'mitech' ),
	'description' => esc_html__( 'Controls the behaviour of header sticky when you scroll down to page', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'both',
	'choices'     => array(
		'both' => esc_html__( 'Sticky on scroll up/down', 'mitech' ),
		'up'   => esc_html__( 'Sticky on scroll up', 'mitech' ),
		'down' => esc_html__( 'Sticky on scroll down', 'mitech' ),
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
	'type'        => 'background',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'mitech' ),
	'description' => esc_html__( 'Controls the background of header when sticky.', 'mitech' ),
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
			'element' => '.page-header.headroom--not-top .page-header-inner',
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
			.page-header.headroom--not-top .header-right-more,
			.page-header.headroom--not-top .wpml-ls-item-toggle,
			.page-header.headroom--not-top .page-open-main-menu,
			.page-header.headroom--not-top .page-open-mobile-menu i,
			.page-header.headroom--not-top .popup-search-wrap i,
			.page-header.headroom--not-top .header-wishlist a,
			.page-header.headroom--not-top .mini-cart .mini-cart-icon',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '
			.page-header.headroom--not-top .header-right-more:hover,
			.page-header.headroom--not-top .page-open-main-menu:hover,
			.page-header.headroom--not-top .page-open-mobile-menu:hover i,
			.page-header.headroom--not-top .popup-search-wrap:hover i,
			.page-header.headroom--not-top .mini-cart .mini-cart-icon:hover
			',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.page-header.headroom--not-top .wpml-ls-slot-shortcode_actions:hover > .js-wpml-ls-item-toggle',
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
			'element'  => '.page-header.headroom--not-top .mini-cart .mini-cart-icon:after',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.page-header.headroom--not-top .mini-cart .mini-cart-icon:after',
			'property' => 'background-color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'height',
	'label'     => esc_html__( 'Height', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 80,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner .header-wrap',
			'property' => 'min-height',
			'units'    => 'px',
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
		'border'     => '#e7e7e7',
	),
	'output'    => array(
		array(
			'choice'   => 'text',
			'element'  => '.page-header.headroom--not-top .header-social-networks a',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.page-header.headroom--not-top .header-social-networks a',
			'property' => 'background',
		),
		array(
			'choice'   => 'border',
			'element'  => '.page-header.headroom--not-top .header-social-networks a',
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
		'text'       => '#fff',
		'background' => Mitech::PRIMARY_COLOR,
		'border'     => Mitech::PRIMARY_COLOR,
	),
	'output'    => array(
		array(
			'choice'   => 'text',
			'element'  => '.page-header.headroom--not-top .header-social-networks a:hover',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.page-header.headroom--not-top .header-social-networks a:hover',
			'property' => 'background',
		),
		array(
			'choice'   => 'border',
			'element'  => '.page-header.headroom--not-top .header-social-networks a:hover',
			'property' => 'border-color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_top',
	'label'     => esc_html__( 'Padding top', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner',
			'property' => 'padding-top',
			'units'    => 'px',
			'suffix'   => '!important',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_bottom',
	'label'     => esc_html__( 'Padding bottom', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner',
			'property' => 'padding-bottom',
			'units'    => 'px',
			'suffix'   => '!important',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Navigation', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'navigation_link_color',
	'label'       => esc_html__( 'Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color for main menu items.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'default' => esc_attr__( 'Default', 'mitech' ),
		'hover'   => esc_attr__( 'Hover', 'mitech' ),
	),
	'default'     => array(
		'default' => '#333',
		'hover'   => '#333',
	),
	'output'      => array(
		array(
			'choice'   => 'default',
			'element'  => '.page-header.headroom--not-top .menu--primary > ul > li > a',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '
            .page-header.headroom--not-top .menu--primary > li:hover > a,
            .page-header.headroom--not-top .menu--primary > ul > li > a:hover,
            .page-header.headroom--not-top .menu--primary > ul > li > a:focus,
            .page-header.headroom--not-top .menu--primary > .current-menu-ancestor > a,
            .page-header.headroom--not-top .menu--primary > .current-menu-item > a',
			'property' => 'color',
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
