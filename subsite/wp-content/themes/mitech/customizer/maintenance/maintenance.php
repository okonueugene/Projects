<?php
$section  = 'maintenance';
$priority = 1;
$prefix   = 'maintenance_';

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'left_background',
	'label'       => esc_html__( 'Left Background', 'mitech' ),
	'description' => esc_html__( 'Controls the left background of maintenance template.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '',
		'background-image'      => MITECH_THEME_IMAGE_URI . '/page-maintenance-bg.jpg',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.page-template-maintenance .left-bg',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'right_background',
	'label'       => esc_html__( 'Right Background', 'mitech' ),
	'description' => esc_html__( 'Controls the right background of maintenance template.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '#fff',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.page-template-maintenance .right-bg',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => $prefix . 'logo',
	'label'    => esc_html__( 'Logo', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => MITECH_THEME_IMAGE_URI . '/logo/dark-logo.png',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => $prefix . 'width',
	'label'       => esc_html__( 'Logo Width', 'mitech' ),
	'description' => esc_html__( 'For e.g: 200px', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '160px',
	'output'      => array(
		array(
			'element'  => '.cs-logo',
			'property' => 'width',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'textarea',
	'settings' => $prefix . 'title',
	'label'    => esc_html__( 'Title', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => esc_html__( 'Something really good is coming very soon!', 'mitech' ),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'date',
	'settings' => $prefix . 'countdown',
	'label'    => esc_html__( 'Countdown', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => Mitech_Helper::get_sample_countdown_date(),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'mailchimp_enable',
	'label'    => esc_html__( 'Mailchimp Form', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Customize::instance()->field_social_networks_enable( array(
	'settings' => $prefix . 'social_networks_enable',
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
) );
