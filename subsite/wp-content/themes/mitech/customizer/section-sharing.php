<?php
$section  = 'social_sharing';
$priority = 1;
$prefix   = 'social_sharing_';

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'multicheck',
	'settings'    => $prefix . 'item_enable',
	'label'       => esc_attr__( 'Sharing Links', 'mitech' ),
	'description' => esc_html__( 'Check to the box to enable social share links.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array( 'facebook', 'twitter', 'linkedin' ),
	'choices'     => array(
		'facebook' => esc_attr__( 'Facebook', 'mitech' ),
		'twitter'  => esc_attr__( 'Twitter', 'mitech' ),
		'linkedin' => esc_attr__( 'Linkedin', 'mitech' ),
		'tumblr'   => esc_attr__( 'Tumblr', 'mitech' ),
		'email'    => esc_attr__( 'Email', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'sortable',
	'settings'    => $prefix . 'order',
	'label'       => esc_attr__( 'Order', 'mitech' ),
	'description' => esc_html__( 'Controls the order of social share links.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'twitter',
		'facebook',
		'linkedin',
		'tumblr',
		'email',
	),
	'choices'     => array(
		'facebook' => esc_attr__( 'Facebook', 'mitech' ),
		'twitter'  => esc_attr__( 'Twitter', 'mitech' ),
		'linkedin' => esc_attr__( 'Linkedin', 'mitech' ),
		'tumblr'   => esc_attr__( 'Tumblr', 'mitech' ),
		'email'    => esc_attr__( 'Email', 'mitech' ),
	),
) );
