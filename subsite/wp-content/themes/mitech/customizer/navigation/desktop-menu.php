<?php
$section  = 'navigation';
$priority = 1;
$prefix   = 'navigation_';

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Main Menu Dropdown', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'dropdown_link_typography',
	'label'       => esc_html__( 'Typography', 'mitech' ),
	'description' => esc_html__( 'Controls the typography for all dropdown menu items.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '400',
		'line-height'    => '1.47',
		'letter-spacing' => '0em',
		'text-transform' => 'none',
	),
	'output'      => array(
		array(
			'element' => '
			.sm-simple .sub-menu a,
			.sm-simple .children a,
			.sm-simple .sub-menu .menu-item-title,
			.sm-simple .tm-list .item-wrapper
			',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'dropdown_link_font_size',
	'label'       => esc_html__( 'Font Size', 'mitech' ),
	'description' => esc_html__( 'Controls the font size for dropdown menu items.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 15,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.sm-simple .sub-menu a, .sm-simple .children a, .sm-simple .tm-list .item-title',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Styling
--------------------------------------------------------------*/

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dropdown_bg_color',
	'label'       => esc_html__( 'Background', 'mitech' ),
	'description' => esc_html__( 'Controls the background color for dropdown menu', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => array(
				'.sm-simple .sub-menu',
				'.sm-simple .children',
			),
			'property' => 'background-color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dropdown_border_bottom_color',
	'label'       => esc_html__( 'Border Bottom', 'mitech' ),
	'description' => esc_html__( 'Controls the border bottom color for dropdown menu', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Mitech::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => array(
				'.desktop-menu .sm-simple .sub-menu:after,
				.desktop-menu .sm-simple .children:after',
			),
			'property' => 'background-color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'dropdown_box_shadow',
	'label'       => esc_html__( 'Box Shadow', 'mitech' ),
	'description' => esc_html__( 'Input valid box-shadow for dropdown menu. For e.g: "0 0 37px rgba(0, 0, 0, .07)"', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0 2px 29px rgba(0, 0, 0, 0.05)',
	'output'      => array(
		array(
			'element'  => array(
				'.sm-simple .sub-menu',
				'.sm-simple .children',
			),
			'property' => 'box-shadow',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'dropdown_link_color',
	'label'       => esc_html__( 'Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color for dropdown menu items.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#ababab',
	'output'      => array(
		array(
			'element'  => array(
				'.sm-simple .sub-menu a',
				'.sm-simple .children a',
				'.sm-simple .tm-list .item-wrapper',
			),
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
			'element'  => array(
				'.sm-simple .sub-menu li:hover > a',
				'.sm-simple .children li:hover > a',
				'.sm-simple .tm-list li:hover .item-wrapper',
				'.sm-simple .sub-menu li:hover > a:after',
				'.sm-simple .children li:hover > a:after',
				'.sm-simple .sub-menu li.current-menu-item > a',
				'.sm-simple .sub-menu li.current-menu-ancestor > a',
			),
			'property' => 'color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dropdown_link_hover_bg_color',
	'label'       => esc_html__( 'Hover Background', 'mitech' ),
	'description' => esc_html__( 'Controls the background color when hover for dropdown menu items.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(255, 255, 255, 0)',
	'output'      => array(
		array(
			'element'  => array(
				'.sm-simple .sub-menu li:hover > a',
				'.sm-simple .children li:hover > a',
				'.sm-simple .tm-list li:hover > a',
				'.sm-simple .sub-menu li.current-menu-item > a',
				'.sm-simple .sub-menu li.current-menu-ancestor > a',
			),
			'property' => 'background-color',
		),
	),
) );
