<?php
$section  = 'error404_page';
$priority = 1;
$prefix   = 'error404_page_';

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => 'error404_page_background_body',
	'label'       => esc_html__( 'Background', 'mitech' ),
	'description' => esc_html__( 'Controls outer background area in boxed mode.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '#681F9D',
		'background-image'      => MITECH_THEME_IMAGE_URI . '/page-404-bg.jpg',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'fixed',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.error404',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => 'error404_page_image',
	'label'    => esc_html__( 'Image', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => MITECH_THEME_IMAGE_URI . '/page-404-image.png',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'error404_page_title',
	'label'       => esc_html__( 'Title', 'mitech' ),
	'description' => esc_html__( 'Controls the title that display on error 404 page.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Oops! Page not found!', 'mitech' ),
) );
