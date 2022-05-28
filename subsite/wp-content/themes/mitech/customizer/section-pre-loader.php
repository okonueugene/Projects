<?php
$section  = 'pre_loader';
$priority = 1;
$prefix   = 'pre_loader_';

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'enable',
	'label'    => esc_html__( 'Enable Preloader', 'mitech' ),
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
	'settings' => $prefix . 'style',
	'label'    => esc_html__( 'Style', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'three-bounce',
	'choices'  => Mitech_Helper::get_preloader_list(),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'color-alpha',
	'settings'  => $prefix . 'background_color',
	'label'     => esc_html__( 'Background Color', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => '#fff',
	'output'    => array(
		array(
			'element'  => '.page-loading .loader-section',
			'property' => 'background-color',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'color-alpha',
	'settings'        => $prefix . 'shape_color',
	'label'           => esc_html__( 'Shape Color', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'default'         => Mitech::PRIMARY_COLOR,
	'output'          => array(
		array(
			'element'  => '
			.page-loading .sk-bg-self,
			.page-loading .sk-bg-child > div,
			.page-loading .sk-bg-child-before > div:before
			',
			'property' => 'background-color',
			'suffix'   => '!important',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'pre_loader_style',
			'operator' => '!=',
			'value'    => 'gif-image',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'image',
	'settings'        => 'pre_loader_image',
	'label'           => esc_html__( 'Gif Image', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => MITECH_THEME_IMAGE_URI . '/main-preloader.gif',
	'active_callback' => array(
		array(
			'setting'  => 'pre_loader_style',
			'operator' => '==',
			'value'    => 'gif-image',
		),
	),
) );
