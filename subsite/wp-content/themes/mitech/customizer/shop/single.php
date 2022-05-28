<?php
$section  = 'shop_single';
$priority = 1;
$prefix   = 'single_product_';

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_product_categories_enable',
	'label'       => esc_html__( 'Categories', 'mitech' ),
	'description' => esc_html__( 'Turn on to display the categories.', 'mitech' ),
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
	'settings'    => 'single_product_tags_enable',
	'label'       => esc_html__( 'Tags', 'mitech' ),
	'description' => esc_html__( 'Turn on to display the tags.', 'mitech' ),
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
	'settings'    => 'single_product_sharing_enable',
	'label'       => esc_html__( 'Sharing', 'mitech' ),
	'description' => esc_html__( 'Turn on to display the sharing.', 'mitech' ),
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
	'settings'    => 'single_product_up_sells_enable',
	'label'       => esc_html__( 'Up-sells products', 'mitech' ),
	'description' => esc_html__( 'Turn on to display the up-sells products section.', 'mitech' ),
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
	'settings'    => 'single_product_related_enable',
	'label'       => esc_html__( 'Related products', 'mitech' ),
	'description' => esc_html__( 'Turn on to display the related products section.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'mitech' ),
		'1' => esc_html__( 'On', 'mitech' ),
	),
) );
