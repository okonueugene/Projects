<?php
$section             = 'sidebars';
$priority            = 1;
$prefix              = 'sidebars_';
$sidebar_positions   = Mitech_Helper::get_list_sidebar_positions();
$registered_sidebars = Mitech_Helper::get_registered_sidebars();

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => sprintf( '<div class="desc">
			<strong class="insight-label insight-label-info">%s</strong>
			<p>%s</p>
			<p>%s</p>
		</div>', esc_html__( 'IMPORTANT NOTE: ', 'mitech' ), esc_html__( 'Sidebar 2 can only be used if sidebar 1 is selected.', 'mitech' ), esc_html__( 'Sidebar position option will control the position of sidebar 1. If sidebar 2 is selected, it will display on the opposite side.', 'mitech' ) ),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'General Settings', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'one_sidebar_breakpoint',
	'label'       => esc_html__( 'One Sidebar Breakpoint', 'mitech' ),
	'description' => esc_html__( 'Controls the breakpoint when has only one sidebar to make the sidebar 100% width.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'postMessage',
	'default'     => 992,
	'choices'     => array(
		'min'  => 460,
		'max'  => 1300,
		'step' => 10,
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'both_sidebar_breakpoint',
	'label'       => esc_html__( 'Both Sidebars Breakpoint', 'mitech' ),
	'description' => esc_html__( 'Controls the breakpoint when has both sidebars to make sidebars 100% width.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'postMessage',
	'default'     => 1199,
	'choices'     => array(
		'min'  => 460,
		'max'  => 1300,
		'step' => 10,
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'sidebars_below_content_mobile',
	'label'       => esc_html__( 'Sidebars Below Content', 'mitech' ),
	'description' => esc_html__( 'Move sidebars display after main content on smaller screens.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'No', 'mitech' ),
		'1' => esc_html__( 'Yes', 'mitech' ),
	),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Single Sidebar Layouts', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'single_sidebar_width',
	'label'       => esc_html__( 'Single Sidebar Width', 'mitech' ),
	'description' => esc_html__( 'Controls the width of the sidebar when only one sidebar is present. Input value as % unit. For e.g: 33.33333', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '33.333333',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => 'single_sidebar_offset',
	'label'       => esc_html__( 'Single Sidebar Offset', 'mitech' ),
	'description' => esc_html__( 'Controls the offset of the sidebar when only one sidebar is present. Enter value including any valid CSS unit. For e.g: 70px.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '30px',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Dual Sidebar Layouts', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'dual_sidebar_width',
	'label'       => esc_html__( 'Dual Sidebar Width', 'mitech' ),
	'description' => esc_html__( 'Controls the width of sidebars when dual sidebars are present. Enter value including any valid CSS unit. For e.g: 33.33333.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '25',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => 'dual_sidebar_offset',
	'label'       => esc_html__( 'Dual Sidebar Offset', 'mitech' ),
	'description' => esc_html__( 'Controls the offset of sidebars when dual sidebars are present. Enter value including any valid CSS unit. For e.g: 70px.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Pages', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'mitech' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on all pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'mitech' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on all pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_sidebar_special',
	'label'       => esc_html__( 'Special Sidebar', 'mitech' ),
	'description' => esc_html__( 'Select special sidebar that will display below of first sidebar on all pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Search Page', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'search_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'mitech' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on search results page.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'search_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'mitech' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on search results page.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'search_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'search_page_sidebar_special',
	'label'       => esc_html__( 'Special Sidebar', 'mitech' ),
	'description' => esc_html__( 'Select special sidebar that will display below of first sidebar on search results page.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'special_sidebar',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Front Latest Posts Page', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'home_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'mitech' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on front latest posts page.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'home_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'mitech' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on front latest posts page.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'home_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'home_page_sidebar_special',
	'label'       => esc_html__( 'Special Sidebar', 'mitech' ),
	'description' => esc_html__( 'Select special sidebar that will display below of first sidebar on front latest posts page.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'special_sidebar',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Blog Posts', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'post_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'mitech' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on single blog post pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'post_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'mitech' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on single blog post pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'post_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'post_page_sidebar_special',
	'label'       => esc_html__( 'Special Sidebar', 'mitech' ),
	'description' => esc_html__( 'Select special sidebar that will display below of first sidebar on single blog post pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Blog Archive', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'mitech' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on blog archive pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'mitech' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on blog archive pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'blog_archive_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_page_sidebar_special',
	'label'       => esc_html__( 'Special Sidebar', 'mitech' ),
	'description' => esc_html__( 'Select special sidebar that will display below of first sidebar on blog archive pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'special_sidebar',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Case Study Posts', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'case_study_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'mitech' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on single case study pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'case_study_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'mitech' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on single case study pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'case_study_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'case_study_page_sidebar_special',
	'label'       => esc_html__( 'Special Sidebar', 'mitech' ),
	'description' => esc_html__( 'Select special sidebar that will display below of first sidebar on single case study pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Case Study Archive', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'case_study_archive_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'mitech' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on case study archive pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'case_study_archive_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'mitech' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on case study archive pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'case_study_archive_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'case_study_archive_page_sidebar_special',
	'label'       => esc_html__( 'Special Sidebar', 'mitech' ),
	'description' => esc_html__( 'Select special sidebar that will display below of first sidebar on case study archive pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Single Product', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'mitech' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on single product pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'mitech' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on single product pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_page_sidebar_special',
	'label'       => esc_html__( 'Special Sidebar', 'mitech' ),
	'description' => esc_html__( 'Select special sidebar that will display below of first sidebar on single product pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Product Archive', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_archive_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'mitech' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on product archive pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'shop_sidebar',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_archive_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'mitech' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on product archive pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_archive_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'mitech' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'left',
	'choices'  => $sidebar_positions,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_archive_page_sidebar_special',
	'label'       => esc_html__( 'Special Sidebar', 'mitech' ),
	'description' => esc_html__( 'Select special sidebar that will display below of first sidebar on product archive pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );
