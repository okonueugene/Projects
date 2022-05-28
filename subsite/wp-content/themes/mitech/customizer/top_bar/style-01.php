<?php
$section  = 'top_bar_style_01';
$priority = 1;
$prefix   = 'top_bar_style_01_';

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'textarea',
	'settings' => $prefix . 'text',
	'label'    => esc_html__( 'Text', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => wp_kses( sprintf( __( '<a href="%s" class="font-medium display-inline">Now Hiring:</a> Are you a driven and motivated 1st Line IT Support Engineer?', 'mitech' ), defined( 'MITECH_TOP_BAR_LINK' ) ? MITECH_TOP_BAR_LINK : '#' ), 'mitech-default' ),
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
			'element'  => '.top-bar-01',
			'property' => 'padding-top',
			'units'    => 'px',
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
			'element'  => '.top-bar-01',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'typography',
	'label'       => esc_html__( 'Typography', 'mitech' ),
	'description' => esc_html__( 'These settings control the typography of texts of top bar section.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '',
		'line-height'    => '1.78',
		'letter-spacing' => '',
		'font-size'      => '14px',
	),
	'output'      => array(
		array(
			'element' => '.top-bar-01, .top-bar-01 a',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_color',
	'label'       => esc_html__( 'Background', 'mitech' ),
	'description' => esc_html__( 'Controls the background color of top bar.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.top-bar-01',
			'property' => 'background-color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'border_width',
	'label'     => esc_html__( 'Border Bottom Width', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 1,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.top-bar-01',
			'property' => 'border-bottom-width',
			'units'    => 'px',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'border_color',
	'label'       => esc_html__( 'Border Bottom Color', 'mitech' ),
	'description' => esc_html__( 'Controls the border bottom color of top bar.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#eee',
	'output'      => array(
		array(
			'element'  => '.top-bar-01',
			'property' => 'border-bottom-color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'text_color',
	'label'       => esc_html__( 'Text', 'mitech' ),
	'description' => esc_html__( 'Controls the color of text on top bar.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#696969',
	'output'      => array(
		array(
			'element'  => '.top-bar-01',
			'property' => 'color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'link_color',
	'label'       => esc_html__( 'Link Color', 'mitech' ),
	'description' => esc_html__( 'Controls the color of links on top bar.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'default' => esc_attr__( 'Default', 'mitech' ),
		'hover'   => esc_attr__( 'Hover', 'mitech' ),
	),
	'default'     => array(
		'default' => Mitech::THIRD_COLOR,
		'hover'   => Mitech::SECONDARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'default',
			'element'  => '.top-bar-01 a',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.top-bar-01 a:hover, .top-bar-01 a:focus',
			'property' => 'color',
		),
	),
) );
