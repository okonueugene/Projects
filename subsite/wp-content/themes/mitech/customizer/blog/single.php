<?php
$section  = 'blog_single';
$priority = 1;
$prefix   = 'single_post_';

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_feature_enable',
	'label'    => esc_html__( 'Featured Image', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_title_enable',
	'label'    => esc_html__( 'Post Title', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_categories_enable',
	'label'    => esc_html__( 'Categories', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_tags_enable',
	'label'    => esc_html__( 'Tags', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_date_enable',
	'label'    => esc_html__( 'Post Meta Date', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_comment_count_enable',
	'label'    => esc_html__( 'Comment Count', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_author_enable',
	'label'    => esc_html__( 'Author Meta', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Customize::instance()->field_social_sharing_enable( array(
	'settings' => 'single_post_share_enable',
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_author_box_enable',
	'label'    => esc_html__( 'Author Info Box', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_pagination_enable',
	'label'    => esc_html__( 'Previous/Next Pagination', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_related_enable',
	'label'    => esc_html__( 'Related Post', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'            => 'number',
	'settings'        => 'single_post_related_number',
	'label'           => esc_html__( 'Number of related posts item', 'mitech' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => 10,
	'choices'         => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'single_post_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_comment_enable',
	'label'    => esc_html__( 'Comments List/Form', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'mitech' ),
		'1' => esc_html__( 'Show', 'mitech' ),
	),
) );
