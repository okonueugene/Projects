<?php
$section  = 'shop_archive';
$priority = 1;
$prefix   = 'shop_archive_';

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'shop_archive_layout',
	'label'    => esc_html__( 'Layout', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'boxed',
	'choices'  => array(
		'boxed' => esc_html__( 'Boxed', 'mitech' ),
		'wide'  => esc_html__( 'Wide', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'shop_archive_style',
	'label'    => esc_html__( 'Style', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'grid',
	'choices'  => array(
		'grid' => esc_html__( 'Grid', 'mitech' ),
		'list' => esc_html__( 'List', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_style_switcher',
	'label'       => esc_html__( 'Layout Switcher', 'mitech' ),
	'description' => esc_html__( 'Turn on to show layout switcher that displays above products list.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_sorting',
	'label'       => esc_html__( 'Sorting', 'mitech' ),
	'description' => esc_html__( 'Turn on to show sorting select options that displays above products list.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_hover_image',
	'label'       => esc_html__( 'Hover Image', 'mitech' ),
	'description' => esc_html__( 'Turn on to show first gallery image when hover', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'None', 'mitech' ),
		'1' => esc_html__( 'Yes', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_quick_view',
	'label'       => esc_html__( 'Quick View', 'mitech' ),
	'description' => esc_html__( 'Turn on to display quick view button', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'mitech' ),
		'1' => esc_html__( 'On', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_compare',
	'label'       => esc_html__( 'Compare', 'mitech' ),
	'description' => esc_html__( 'Turn on to display compare button', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'mitech' ),
		'1' => esc_html__( 'On', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_wishlist',
	'label'       => esc_html__( 'Wishlist', 'mitech' ),
	'description' => esc_html__( 'Turn on to display love button', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'mitech' ),
		'1' => esc_html__( 'On', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'shop_archive_number_item',
	'label'       => esc_html__( 'Number items', 'mitech' ),
	'description' => esc_html__( 'Controls the number of products display on shop archive page', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 9,
	'choices'     => array(
		'min'  => 1,
		'max'  => 50,
		'step' => 1,
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'shop_archive_lg_columns',
	'label'     => esc_html__( 'Number of columns on Large device', 'mitech' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 3,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 6,
		'step' => 1,
	),
) );
