<?php
$section  = 'header_style_09';
$priority = 1;
$prefix   = 'header_style_09_';

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'overlay',
	'label'    => esc_html__( 'Header Overlay', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
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
	'default'  => '0',
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
	'default'  => '0',
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
		'text'       => '#262626',
		'background' => 'rgba(0, 0, 0, 0)',
		'border'     => 'rgba(38, 38, 38, 0.4)',
	),
	'output'          => array(
		array(
			'choice'   => 'text',
			'element'  => '.header-09 .header-social-networks a',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-09 .header-social-networks a',
			'property' => 'background',
		),
		array(
			'choice'   => 'border',
			'element'  => '.header-09 .header-social-networks a',
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
		'text'       => '#262626',
		'background' => Mitech::PRIMARY_COLOR,
		'border'     => Mitech::PRIMARY_COLOR,
	),
	'output'          => array(
		array(
			'choice'   => 'text',
			'element'  => '.header-09 .header-social-networks a:hover',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-09 .header-social-networks a:hover',
			'property' => 'background',
		),
		array(
			'choice'   => 'border',
			'element'  => '.header-09 .header-social-networks a:hover',
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
			'element'  => '.header-09 .page-header-inner',
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
	'default'     => '#E4E8F6',
	'output'      => array(
		array(
			'element'  => '.header-09 .page-header-inner',
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
			'element'  => '.header-09 .page-header-inner',
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
			'element' => '.header-09 .page-header-inner',
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
		'default' => '#262626',
		'hover'   => '#262626',
	),
	'output'      => array(
		array(
			'choice'   => 'default',
			'element'  => '
			.header-09 .header-right-more,
			.header-09 .wpml-ls-item-toggle,
			.header-09 .page-open-mobile-menu i,
			.header-09 .popup-search-wrap i,
			.header-09 .header-wishlist a,
			.header-09 .mini-cart .mini-cart-icon',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '
			.header-09 .header-right-more:hover,
			.header-09 .page-open-mobile-menu:hover i,
			.header-09 .popup-search-wrap:hover i,
			.header-09 .mini-cart .mini-cart-icon:hover
			',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.header-09 .wpml-ls-slot-shortcode_actions:hover > .js-wpml-ls-item-toggle',
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
			'element'  => '.header-09 .mini-cart .mini-cart-icon:after',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-09 .mini-cart .mini-cart-icon:after',
			'property' => 'background-color',
		),
	),
) );

/*--------------------------------------------------------------
# Navigation
--------------------------------------------------------------*/

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Main Menu Level 1', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'navigation_item_padding',
	'label'     => esc_html__( 'Item Padding', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => array(
		'top'    => '22px',
		'bottom' => '22px',
		'left'   => '24px',
		'right'  => '24px',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.desktop-menu .header-09 .menu--primary .menu__container > li > a',
			),
			'property' => 'padding',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'navigation_item_inner_padding',
	'label'     => esc_html__( 'Item Padding', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => array(
		'top'    => '9px',
		'bottom' => '9px',
		'left'   => '0',
		'right'  => '0',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.desktop-menu .header-09 .menu--primary .menu__container > li > a > .menu-item-wrap',
			),
			'property' => 'padding',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'navigation_typography',
	'label'       => esc_html__( 'Typography', 'mitech' ),
	'description' => esc_html__( 'These settings control the typography for menu items.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '600',
		'font-size'      => '16px',
		'line-height'    => '1.18',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output'      => array(
		array(
			'element' => '.header-09 .menu--primary a',
		),
	),
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
		'border'  => esc_attr__( 'Border', 'mitech' ),
	),
	'default'     => array(
		'default' => '#262626',
		'hover'   => '#262626',
		'border'  => Mitech::SECONDARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'border',
			'element'  => '.header-09 .menu--primary .menu__container > li > a > .menu-item-wrap:after',
			'property' => 'background-color',
		),
		array(
			'choice'   => 'default',
			'element'  => '.header-09 .menu--primary a',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '
            .header-09 .menu--primary li:hover > a,
            .header-09 .menu--primary > ul > li > a:hover,
            .header-09 .menu--primary > ul > li > a:focus,
            .header-09 .menu--primary .current-menu-ancestor > a,
            .header-09 .menu--primary .current-menu-item > a',
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
	'default'  => 'flat',
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
	'default'  => 'custom',
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
		'color'      => '#fff',
		'background' => Mitech::PRIMARY_COLOR,
		'border'     => Mitech::PRIMARY_COLOR,
	),
	'output'          => array(
		array(
			'choice'   => 'color',
			'element'  => '.header-09 .header-button',
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => '.header-09 .header-button',
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-09 .header-button',
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
			'element'  => '.header-09 .header-button:hover',
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => '.header-09 .header-button:hover',
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-09 .header-button:hover',
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
