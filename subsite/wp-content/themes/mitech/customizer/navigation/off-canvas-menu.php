<?php
$section  = 'navigation_minimal_01';
$priority = 1;
$prefix   = 'navigation_minimal_01_';

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
	'type'            => 'background',
	'settings'        => $prefix . 'background',
	'label'           => esc_html__( 'Background', 'mitech' ),
	'description'     => esc_html__( 'Controls the background of canvas menu.', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => array(
		'background-color'      => '#fff',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'          => array(
		array(
			'element' => '.page-off-canvas-main-menu',
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
		'color_1' => '#5E61E7',
		'color_2' => '#9C7AF2',
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
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'close_button_color',
	'label'       => esc_html__( 'Close Button Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color of close button.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#333',
	'output'      => array(
		array(
			'element'  => '.page-close-main-menu:before, .page-close-main-menu:after',
			'property' => 'background-color',
		),
	),
) );

/*--------------------------------------------------------------
# Level 1
--------------------------------------------------------------*/
Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Main Menu Level 1', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'typography',
	'label'       => esc_html__( 'Typography', 'mitech' ),
	'description' => esc_html__( 'These settings control the typography for menu items.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '500',
		'line-height'    => '1.8',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output'      => array(
		array(
			'element' => '.page-off-canvas-main-menu .menu__container > li > a',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'item_font_size',
	'label'       => esc_html__( 'Font Size', 'mitech' ),
	'description' => esc_html__( 'Controls the font size for main menu items.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 40,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.page-off-canvas-main-menu .menu__container > li > a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'item_color',
	'label'       => esc_html__( 'Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color for main menu items.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#333',
	'output'      => array(
		array(
			'element'  => '.page-off-canvas-main-menu .menu__container > li > a',
			'property' => 'color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'item_hover_color',
	'label'       => esc_html__( 'Hover Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color when hover for main menu items.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Mitech::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '
            .page-off-canvas-main-menu .menu__container  > li > a:hover,
            .page-off-canvas-main-menu .menu__container  > li > a:focus
            ',
			'property' => 'color',
		),
	),
) );

/*--------------------------------------------------------------
# Main Menu Dropdown Menu
--------------------------------------------------------------*/
Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Main Menu Dropdown', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'dropdown_link_font_size',
	'label'       => esc_html__( 'Font Size', 'mitech' ),
	'description' => esc_html__( 'Controls the font size for dropdown menu items.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 20,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.page-off-canvas-main-menu .menu__container .sub-menu a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Styling
--------------------------------------------------------------*/

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'dropdown_link_color',
	'label'       => esc_html__( 'Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color for dropdown menu items.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#333',
	'output'      => array(
		array(
			'element'  => '
			.page-off-canvas-main-menu .menu__container .sub-menu a,
			.page-off-canvas-main-menu .menu__container .children a
			',
			'property' => 'color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'dropdown_link_hover_color',
	'label'       => esc_html__( 'Hover Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color when hover for dropdown menu items.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Mitech::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-off-canvas-main-menu .menu__container .sub-menu a:hover,
			.page-off-canvas-main-menu .menu__container .children a:hover',
			'property' => 'color',
		),
	),
) );
