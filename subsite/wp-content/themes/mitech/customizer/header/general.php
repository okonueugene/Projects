<?php
$section  = 'header';
$priority = 1;
$prefix   = 'header_';

$header_default_text = esc_html__( 'Use Global Header', 'mitech' );
$headers             = Mitech_Helper::get_header_list( true, $header_default_text );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'global_header',
	'label'       => esc_html__( 'Global Header', 'mitech' ),
	'description' => esc_html__( 'Select default header type for your site.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '01',
	'choices'     => Mitech_Helper::get_header_list(),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_page_header_type',
	'label'       => esc_html__( 'Single Page', 'mitech' ),
	'description' => esc_html__( 'Select default header type that displays on all single pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $headers,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'archive_blog_header_type',
	'label'       => esc_html__( 'Blog Archive', 'mitech' ),
	'description' => esc_html__( 'Select header type that displays on blog archive pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $headers,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_post_header_type',
	'label'       => esc_html__( 'Single Blog', 'mitech' ),
	'description' => esc_html__( 'Select default header type that displays on all single blog post pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $headers,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'archive_case_study_header_type',
	'label'       => esc_html__( 'Archive Case Study', 'mitech' ),
	'description' => esc_html__( 'Select default header type that displays on archive case study page.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $headers,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_case_study_header_type',
	'label'       => esc_html__( 'Single Case Study', 'mitech' ),
	'description' => esc_html__( 'Select default header type that displays on all single case study pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $headers,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'archive_product_header_type',
	'label'       => esc_html__( 'Archive Product', 'mitech' ),
	'description' => esc_html__( 'Select default header type that displays on archive product page.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '08',
	'choices'     => $headers,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_product_header_type',
	'label'       => esc_html__( 'Single Product', 'mitech' ),
	'description' => esc_html__( 'Select default header type that displays on all single product pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '08',
	'choices'     => $headers,
) );
