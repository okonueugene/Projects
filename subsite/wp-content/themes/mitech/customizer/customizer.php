<?php
/**
 * Theme Customizer
 *
 * @package Mitech
 * @since   1.0
 */

/**
 * Setup configuration
 */
Mitech_Kirki::add_config( 'theme', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );

/**
 * Add sections
 */
$priority = 1;

Mitech_Kirki::add_section( 'layout', array(
	'title'    => esc_html__( 'Site Layout & Background', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'color_', array(
	'title'    => esc_html__( 'Colors', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'typography', array(
	'title'    => esc_html__( 'Typography', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_panel( 'top_bar', array(
	'title'    => esc_html__( 'Top bar', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_panel( 'header', array(
	'title'    => esc_html__( 'Header', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'logo', array(
	'title'       => esc_html__( 'Logo', 'mitech' ),
	'description' => '<div class="desc">
			<strong class="insight-label insight-label-info">' . esc_html__( 'IMPORTANT NOTE: ', 'mitech' ) . '</strong>
			<p>' . esc_html__( 'These settings can be overridden by settings from Page Options Box in separator page.', 'mitech' ) . '</p>
			<p><img src="' . esc_url( MITECH_THEME_IMAGE_URI . '/customize/logo-settings.jpg' ) . '" alt="' . esc_attr__( 'logo-settings', 'mitech' ) . '"/></p>
		</div>',
	'priority'    => $priority++,
) );

Mitech_Kirki::add_panel( 'navigation', array(
	'title'    => esc_html__( 'Navigation', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_panel( 'title_bar', array(
	'title'    => esc_html__( 'Page Title Bar & Breadcrumb', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'sidebars', array(
	'title'    => esc_html__( 'Sidebars', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_panel( 'footer', array(
	'title'    => esc_html__( 'Footer', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_panel( 'blog', array(
	'title'    => esc_html__( 'Blog', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_panel( 'case_study', array(
	'title'    => esc_html__( 'Case Study', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_panel( 'shop', array(
	'title'    => esc_html__( 'Shop', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'socials', array(
	'title'    => esc_html__( 'Social Networks', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'social_sharing', array(
	'title'    => esc_html__( 'Social Sharing', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_panel( 'search', array(
	'title'    => esc_html__( 'Search & Popup Search', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'error404_page', array(
	'title'    => esc_html__( 'Error 404 Page', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_panel( 'maintenance', array(
	'title'    => esc_html__( 'Maintenance', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_panel( 'shortcode', array(
	'title'    => esc_html__( 'Shortcodes', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'pre_loader', array(
	'title'    => esc_html__( 'Pre Loader', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_panel( 'advanced', array(
	'title'    => esc_html__( 'Advanced', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'notices', array(
	'title'    => esc_html__( 'Notices & Newsletter Popup', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'performance', array(
	'title'    => esc_html__( 'Performance', 'mitech' ),
	'priority' => $priority++,
) );

Mitech_Kirki::add_section( 'custom_js', array(
	'title'    => esc_html__( 'Additional JS', 'mitech' ),
	'priority' => 200,
) );

/**
 * Load panel & section files
 */
require_once MITECH_CUSTOMIZER_DIR . '/section-color.php';

require_once MITECH_CUSTOMIZER_DIR . '/top_bar/_panel.php';
require_once MITECH_CUSTOMIZER_DIR . '/top_bar/general.php';
require_once MITECH_CUSTOMIZER_DIR . '/top_bar/style-01.php';
require_once MITECH_CUSTOMIZER_DIR . '/top_bar/style-02.php';
require_once MITECH_CUSTOMIZER_DIR . '/top_bar/style-03.php';
require_once MITECH_CUSTOMIZER_DIR . '/top_bar/style-04.php';

require_once MITECH_CUSTOMIZER_DIR . '/header/_panel.php';
require_once MITECH_CUSTOMIZER_DIR . '/header/general.php';
require_once MITECH_CUSTOMIZER_DIR . '/header/sticky.php';
require_once MITECH_CUSTOMIZER_DIR . '/header/more-options.php';
require_once MITECH_CUSTOMIZER_DIR . '/header/style-01.php';
require_once MITECH_CUSTOMIZER_DIR . '/header/style-02.php';
require_once MITECH_CUSTOMIZER_DIR . '/header/style-03.php';
require_once MITECH_CUSTOMIZER_DIR . '/header/style-04.php';
require_once MITECH_CUSTOMIZER_DIR . '/header/style-05.php';
require_once MITECH_CUSTOMIZER_DIR . '/header/style-06.php';
require_once MITECH_CUSTOMIZER_DIR . '/header/style-07.php';
require_once MITECH_CUSTOMIZER_DIR . '/header/style-08.php';
require_once MITECH_CUSTOMIZER_DIR . '/header/style-09.php';

require_once MITECH_CUSTOMIZER_DIR . '/navigation/_panel.php';
require_once MITECH_CUSTOMIZER_DIR . '/navigation/desktop-menu.php';
require_once MITECH_CUSTOMIZER_DIR . '/navigation/off-canvas-menu.php';
require_once MITECH_CUSTOMIZER_DIR . '/navigation/mobile-menu.php';

require_once MITECH_CUSTOMIZER_DIR . '/title_bar/_panel.php';
require_once MITECH_CUSTOMIZER_DIR . '/title_bar/general.php';
require_once MITECH_CUSTOMIZER_DIR . '/title_bar/style-01.php';

require_once MITECH_CUSTOMIZER_DIR . '/footer/_panel.php';
require_once MITECH_CUSTOMIZER_DIR . '/footer/general.php';
require_once MITECH_CUSTOMIZER_DIR . '/footer/simple.php';

require_once MITECH_CUSTOMIZER_DIR . '/advanced/_panel.php';
require_once MITECH_CUSTOMIZER_DIR . '/advanced/advanced.php';
require_once MITECH_CUSTOMIZER_DIR . '/advanced/light-gallery.php';

require_once MITECH_CUSTOMIZER_DIR . '/section-notices.php';

require_once MITECH_CUSTOMIZER_DIR . '/section-pre-loader.php';

require_once MITECH_CUSTOMIZER_DIR . '/shortcode/_panel.php';
require_once MITECH_CUSTOMIZER_DIR . '/shortcode/animation.php';

require_once MITECH_CUSTOMIZER_DIR . '/section-custom-js.php';
require_once MITECH_CUSTOMIZER_DIR . '/section-error404.php';
require_once MITECH_CUSTOMIZER_DIR . '/section-layout.php';
require_once MITECH_CUSTOMIZER_DIR . '/section-logo.php';

require_once MITECH_CUSTOMIZER_DIR . '/blog/_panel.php';
require_once MITECH_CUSTOMIZER_DIR . '/blog/archive.php';
require_once MITECH_CUSTOMIZER_DIR . '/blog/single.php';

require_once MITECH_CUSTOMIZER_DIR . '/case-study/_panel.php';
require_once MITECH_CUSTOMIZER_DIR . '/case-study/archive.php';
require_once MITECH_CUSTOMIZER_DIR . '/case-study/single.php';

require_once MITECH_CUSTOMIZER_DIR . '/shop/_panel.php';
require_once MITECH_CUSTOMIZER_DIR . '/shop/general.php';
require_once MITECH_CUSTOMIZER_DIR . '/shop/archive.php';
require_once MITECH_CUSTOMIZER_DIR . '/shop/single.php';
require_once MITECH_CUSTOMIZER_DIR . '/shop/cart.php';

require_once MITECH_CUSTOMIZER_DIR . '/search/_panel.php';
require_once MITECH_CUSTOMIZER_DIR . '/search/search-page.php';
require_once MITECH_CUSTOMIZER_DIR . '/search/search-popup.php';

require_once MITECH_CUSTOMIZER_DIR . '/maintenance/_panel.php';
require_once MITECH_CUSTOMIZER_DIR . '/maintenance/general.php';
require_once MITECH_CUSTOMIZER_DIR . '/maintenance/maintenance.php';

require_once MITECH_CUSTOMIZER_DIR . '/section-sharing.php';
require_once MITECH_CUSTOMIZER_DIR . '/section-sidebars.php';
require_once MITECH_CUSTOMIZER_DIR . '/section-socials.php';
require_once MITECH_CUSTOMIZER_DIR . '/section-typography.php';

require_once MITECH_CUSTOMIZER_DIR . '/section-performance.php';
