<?php
$section  = 'performance';
$priority = 1;
$prefix   = 'performance_';

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'disable_emoji',
	'label'       => esc_html__( 'Disable Emojis', 'mitech' ),
	'description' => esc_html__( 'Remove Wordpress Emojis functionality.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'disable_embeds',
	'label'       => esc_html__( 'Disable Embeds', 'mitech' ),
	'description' => esc_html__( 'Remove Wordpress Embeds functionality.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );
