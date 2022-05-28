<?php
$section  = 'advanced';
$priority = 1;
$prefix   = 'advanced_';

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'scroll_top_enable',
	'label'       => esc_html__( 'Go To Top Button', 'mitech' ),
	'description' => esc_html__( 'Turn on to show go to top button.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'google_api_key',
	'label'       => esc_html__( 'Google Api Key', 'mitech' ),
	'description' => sprintf( wp_kses( __( 'Follow <a href="%s" target="_blank">this link</a> and click <strong>GET A KEY</strong> button.', 'mitech' ), array(
		'a'      => array(
			'href'   => array(),
			'target' => array(),
		),
		'strong' => array(),
	) ), esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key' ) ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'AIzaSyA2gHgnwnas_j_283ngFLGzpVffPH9wiHM',
	'transport'   => 'postMessage',
) );
