<?php
$section  = 'general';
$priority = 1;
$prefix   = 'general_';

$maintenance_pages = array();
if ( is_customize_preview() ) {
	$maintenance_pages = Mitech_Maintenance::instance()->get_maintenance_pages();
}

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'maintenance_mode_enable',
	'label'       => esc_html__( 'Maintenance Mode', 'mitech' ),
	'description' => esc_html__( 'Turn on to activate maintenance mode for unauthenticated users.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 0,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'maintenance_page',
	'label'       => esc_html__( 'Maintenance Page', 'mitech' ),
	'description' => esc_html__( 'Choose a maintenance template. If you haven\'t any pages then please add new page & choose Page Template is Maintenance.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $maintenance_pages,
) );
