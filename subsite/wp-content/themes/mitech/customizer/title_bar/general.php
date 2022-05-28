<?php
$section  = 'title_bar';
$priority = 1;
$prefix   = 'title_bar_';

$default_text   = esc_html__( 'Use Global Title Bar', 'mitech' );
$title_bar_list = Mitech_Helper::get_title_bar_list( true, $default_text );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'layout',
	'label'       => esc_html__( 'Global Title Bar', 'mitech' ),
	'description' => esc_html__( 'Select default title bar that displays on all pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '01',
	'choices'     => Mitech_Helper::get_title_bar_list(),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_title_bar_layout',
	'label'       => esc_html__( 'All Pages', 'mitech' ),
	'description' => esc_html__( 'Select default Title Bar that displays on all single pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $title_bar_list,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'home_page_title_bar_layout',
	'label'       => esc_html__( 'Home Page', 'mitech' ),
	'description' => esc_html__( 'Select default Title Bar that displays on front latest posts page.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $title_bar_list,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_page_title_bar_layout',
	'label'       => esc_html__( 'Archive Blog', 'mitech' ),
	'description' => esc_html__( 'Select default Title Bar that displays on archive blog pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $title_bar_list,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'post_page_title_bar_layout',
	'label'       => esc_html__( 'Single Blog', 'mitech' ),
	'description' => esc_html__( 'Select default Title Bar that displays on all single blog post pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $title_bar_list,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'case_study_archive_page_title_bar_layout',
	'label'       => esc_html__( 'Archive Case Study', 'mitech' ),
	'description' => esc_html__( 'Select default Title Bar that displays on all archive case study pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $title_bar_list,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'case_study_page_title_bar_layout',
	'label'       => esc_html__( 'Single Case Study', 'mitech' ),
	'description' => esc_html__( 'Select default Title Bar that displays on all single case study pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $title_bar_list,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_archive_page_title_bar_layout',
	'label'       => esc_html__( 'Archive Product', 'mitech' ),
	'description' => esc_html__( 'Select default Title Bar that displays on all archive product (included cart, checkout, my-account...) pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $title_bar_list,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_page_title_bar_layout',
	'label'       => esc_html__( 'Single Product', 'mitech' ),
	'description' => esc_html__( 'Select default Title Bar that displays on all single product pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $title_bar_list,
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Heading', 'mitech' ) . '</div>',
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'search_title',
	'label'       => esc_html__( 'Search Heading', 'mitech' ),
	'description' => esc_html__( 'Enter text prefix that displays on search results page.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Search results for: ', 'mitech' ),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'home_title',
	'label'       => esc_html__( 'Home Heading', 'mitech' ),
	'description' => esc_html__( 'Enter text that displays on front latest posts page.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Blog', 'mitech' ),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_category_title',
	'label'       => esc_html__( 'Archive Category Heading', 'mitech' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive category page.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Category: ', 'mitech' ),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_tag_title',
	'label'       => esc_html__( 'Archive Tag Heading', 'mitech' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive tag page.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Tag: ', 'mitech' ),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_author_title',
	'label'       => esc_html__( 'Archive Author Heading', 'mitech' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive author page.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Author: ', 'mitech' ),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_year_title',
	'label'       => esc_html__( 'Archive Year Heading', 'mitech' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive year page.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Year: ', 'mitech' ),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_month_title',
	'label'       => esc_html__( 'Archive Month Heading', 'mitech' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive month page.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Month: ', 'mitech' ),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_day_title',
	'label'       => esc_html__( 'Archive Day Heading', 'mitech' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive day page.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Day: ', 'mitech' ),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_blog_title',
	'label'       => esc_html__( 'Single Blog Heading', 'mitech' ),
	'description' => esc_html__( 'Enter text that displays on single blog posts. Leave blank to use post title.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Blog', 'mitech' ),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_case_study_title',
	'label'       => esc_html__( 'Archive Case Study Heading', 'mitech' ),
	'description' => esc_html__( 'Enter text that displays on archive case study pages.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Case Studies', 'mitech' ),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_case_study_title',
	'label'       => esc_html__( 'Single Case Study Heading', 'mitech' ),
	'description' => esc_html__( 'Enter text that displays on single case study pages. Leave blank to use case study title.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Case Study', 'mitech' ),
) );

Mitech_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_product_title',
	'label'       => esc_html__( 'Single Product Heading', 'mitech' ),
	'description' => esc_html__( 'Enter text that displays on single product pages. Leave blank to use product title.', 'mitech' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Shop', 'mitech' ),
) );
