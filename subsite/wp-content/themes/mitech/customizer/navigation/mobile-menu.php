<?php
$section  = 'navigation_mobile';
$priority = 1;
$prefix   = 'mobile_menu_';

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => $prefix . 'breakpoint',
	'label'       => esc_html__( 'Breakpoint', 'mitech' ),
	'description' => esc_html__( 'Controls the breakpoint of the mobile menu.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'postMessage',
	'default'     => 1199,
	'choices'     => array(
		'min'  => 460,
		'max'  => 1300,
		'step' => 10,
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => $prefix . 'effect',
	'label'     => esc_html__( 'Opened Effect', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'postMessage',
	'default'   => 'push-to-left',
	'choices'   => array(
		'slide-to-right' => esc_html__( 'Slide To Right', 'mitech' ),
		'slide-to-left'  => esc_html__( 'Slide To Left', 'mitech' ),
		'push-to-right'  => esc_html__( 'Push To Right', 'mitech' ),
		'push-to-left'   => esc_html__( 'Push To Left', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'header_bg',
	'label'       => esc_html__( 'Header Background Color', 'mitech' ),
	'description' => esc_html__( 'Controls the background color of the mobile menu header.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-mobile-menu-header',
			'property' => 'background',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'close_button_color',
	'label'       => esc_html__( 'Close Button Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color of close button.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'default' => esc_attr__( 'Default Color', 'mitech' ),
		'hover'   => esc_attr__( 'Hover Color', 'mitech' ),
	),
	'output'      => array(
		array(
			'choice'   => 'default',
			'element'  => '.page-close-mobile-menu',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.page-close-mobile-menu:hover',
			'property' => 'color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'background_type',
	'label'    => esc_html__( 'Background Type', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'solid',
	'choices'  => array(
		'solid'    => esc_html__( 'Solid', 'mitech' ),
		'gradient' => esc_html__( 'Gradient', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'color-alpha',
	'settings'        => $prefix . 'bg_color',
	'label'           => esc_html__( 'Color', 'mitech' ),
	'description'     => esc_html__( 'Controls the background color of the mobile menu.', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'default'         => Mitech::PRIMARY_COLOR,
	'output'          => array(
		array(
			'element'  => '.page-mobile-main-menu > .inner',
			'property' => 'background',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'background_type',
			'operator' => '==',
			'value'    => 'solid',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => $prefix . 'background_gradient_color',
	'label'           => esc_html__( 'Background Gradient', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color_1' => esc_attr__( 'Color 1', 'mitech' ),
		'color_2' => esc_attr__( 'Color 2', 'mitech' ),
	),
	'default'         => array(
		'color_1' => Mitech::PRIMARY_COLOR,
		'color_2' => Mitech::SECONDARY_COLOR,
	),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'background_type',
			'operator' => '==',
			'value'    => 'gradient',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => $prefix . 'text_align',
	'label'     => esc_html__( 'Text Align', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => 'left',
	'choices'   => array(
		'left'   => esc_html__( 'Left', 'mitech' ),
		'center' => esc_html__( 'Center', 'mitech' ),
		'right'  => esc_html__( 'Right', 'mitech' ),
	),
	'output'    => array(
		array(
			'element'  => '.page-mobile-main-menu .menu__container',
			'property' => 'text-align',
		),
	),
) );

// Level 1.

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Level 1', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'item_padding',
	'label'     => esc_html__( 'Item Padding', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => array(
		'top'    => '19px',
		'bottom' => '19px',
		'left'   => '0',
		'right'  => '0',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.page-mobile-main-menu .menu__container > li > a',
			),
			'property' => 'padding',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'typo',
	'label'       => esc_html__( 'Typography', 'mitech' ),
	'description' => esc_html__( 'Controls the typography for mobile menu items.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '500',
		'line-height'    => '1.5',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output'      => array(
		array(
			'element' => '.page-mobile-main-menu .menu__container a',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'item_font_size',
	'label'       => esc_html__( 'Font Size', 'mitech' ),
	'description' => esc_html__( 'Controls the font size of items level 1.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 16,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 8,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .menu__container > li > a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_color',
	'label'       => esc_html__( 'Link Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color of items level 1.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .menu__container > li > a',
			'property' => 'color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color when hover of items level 1.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .menu__container > li > a:hover,
            .page-mobile-main-menu .menu__container > li.opened > a',
			'property' => 'color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'divider_color',
	'label'       => esc_html__( 'Divider Color', 'mitech' ),
	'description' => esc_html__( 'Controls the divider color between items level 1', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(255, 255, 255, 0.15)',
	'output'      => array(
		array(
			'element'  => '
			.page-mobile-main-menu .menu__container > li + li > a,
			.page-mobile-main-menu .menu__container > li.opened > a',
			'property' => 'border-color',
		),
	),
) );

// Mobile Menu Drop down Menu.

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Sub Items', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'sub_item_padding',
	'label'     => esc_html__( 'Item Padding', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => array(
		'top'    => '10px',
		'bottom' => '10px',
		'left'   => '0',
		'right'  => '0',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.page-mobile-main-menu .sub-menu a',
				'.page-mobile-main-menu .children a',
			),
			'property' => 'padding',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'sub_item_font_size',
	'label'       => esc_html__( 'Font Size', 'mitech' ),
	'description' => esc_html__( 'Controls the font size of sub items.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 14,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 8,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '
			.page-mobile-main-menu .sub-menu a,
			.page-mobile-main-menu .children a,
			.page-mobile-main-menu .tm-list__item
			',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'sub_link_color',
	'label'       => esc_html__( 'Link Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color of sub items.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(255, 255, 255, 0.7)',
	'output'      => array(
		array(
			'element'  => '
			.page-mobile-main-menu .sub-menu a,
			.page-mobile-main-menu .children a,
			.page-mobile-main-menu .tm-list__item',
			'property' => 'color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'sub_link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color when hover of sub items.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '
			.page-mobile-main-menu .sub-menu a:hover,
			.page-mobile-main-menu .children a:hover,
            .page-mobile-main-menu .tm-list__item:hover,
            .page-mobile-main-menu .sub-menu .opened > a',
			'property' => 'color',
		),
	),
) );

// Widget Title
Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Widget Title', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'widget_title_typo',
	'label'       => esc_html__( 'Typography', 'mitech' ),
	'description' => esc_html__( 'Controls the typography for widget title.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '700',
		'line-height'    => '1.5',
		'letter-spacing' => '',
		'text-transform' => 'uppercase',
		'font-size'      => '14px',
		'color'          => '#fff',
	),
	'output'      => array(
		array(
			'element' => '.page-mobile-main-menu .widgettitle, .page-mobile-main-menu .widget-title',
		),
	),
) );
