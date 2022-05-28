<?php
/**
 * Define constant
 */
$theme = wp_get_theme();
update_option( 'insight_core_purchase_code', 'purchase-code' );
update_option( 'insight_core_purchase_info', 
['item_name'=>'Mitech','created_at'=>'05.05.2020','buyer'=>'raz0r','licence'=>'valid','supported_until'=>'10.10.2030']
 );
if ( ! empty( $theme['Template'] ) ) {
	$theme = wp_get_theme( $theme['Template'] );
}

if ( ! defined( 'DS' ) ) {
	define( 'DS', DIRECTORY_SEPARATOR );
}

define( 'MITECH_THEME_NAME', $theme['Name'] );
define( 'MITECH_THEME_VERSION', $theme['Version'] );
define( 'MITECH_THEME_DIR', get_template_directory() );
define( 'MITECH_THEME_URI', get_template_directory_uri() );
define( 'MITECH_THEME_IMAGE_DIR', get_template_directory() . DS . 'assets' . DS . 'images' );
define( 'MITECH_THEME_IMAGE_URI', get_template_directory_uri() . '/assets/images' );
define( 'MITECH_CHILD_THEME_URI', get_stylesheet_directory_uri() );
define( 'MITECH_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'MITECH_FRAMEWORK_DIR', get_template_directory() . DS . 'framework' );
define( 'MITECH_CUSTOMIZER_DIR', MITECH_THEME_DIR . DS . 'customizer' );
define( 'MITECH_VC_MAPS_DIR', MITECH_THEME_DIR . DS . 'vc-extend' . DS . 'vc-maps' );
define( 'MITECH_VC_PARAMS_DIR', MITECH_THEME_DIR . DS . 'vc-extend' . DS . 'vc-params' );
define( 'MITECH_VC_SHORTCODE_CATEGORY', esc_html__( 'By', 'mitech' ) . ' ' . MITECH_THEME_NAME );
define( 'MITECH_PROTOCOL', is_ssl() ? 'https' : 'http' );
define( 'MITECH_IS_RTL', is_rtl() ? true : false );

/**
 * Load Framework.
 */
require_once MITECH_FRAMEWORK_DIR . '/class-static.php';
require_once MITECH_FRAMEWORK_DIR . '/class-debug.php';
require_once MITECH_FRAMEWORK_DIR . '/class-init.php';
require_once MITECH_FRAMEWORK_DIR . '/class-helper.php';
require_once MITECH_FRAMEWORK_DIR . '/class-aqua-resizer.php';
require_once MITECH_FRAMEWORK_DIR . '/class-functions.php';
require_once MITECH_FRAMEWORK_DIR . '/class-global.php';
require_once MITECH_FRAMEWORK_DIR . '/class-actions-filters.php';
require_once MITECH_FRAMEWORK_DIR . '/class-notices.php';
require_once MITECH_FRAMEWORK_DIR . '/class-admin.php';
require_once MITECH_FRAMEWORK_DIR . '/class-compatible.php';
require_once MITECH_FRAMEWORK_DIR . '/class-customize.php';
require_once MITECH_FRAMEWORK_DIR . '/class-nav-menu.php';
require_once MITECH_FRAMEWORK_DIR . '/class-enqueue.php';
require_once MITECH_FRAMEWORK_DIR . '/class-image.php';
require_once MITECH_FRAMEWORK_DIR . '/class-minify.php';
require_once MITECH_FRAMEWORK_DIR . '/class-color.php';
require_once MITECH_FRAMEWORK_DIR . '/class-maintenance.php';
require_once MITECH_FRAMEWORK_DIR . '/class-import.php';
require_once MITECH_FRAMEWORK_DIR . '/class-instagram.php';
require_once MITECH_FRAMEWORK_DIR . '/class-kirki.php';
require_once MITECH_FRAMEWORK_DIR . '/class-metabox.php';
require_once MITECH_FRAMEWORK_DIR . '/class-plugins.php';
require_once MITECH_FRAMEWORK_DIR . '/class-custom-css.php';
require_once MITECH_FRAMEWORK_DIR . '/class-templates.php';
require_once MITECH_FRAMEWORK_DIR . '/class-visual-composer.php';
require_once MITECH_FRAMEWORK_DIR . '/class-vc-icon-fontawesome5.php';
require_once MITECH_FRAMEWORK_DIR . '/class-vc-icon-ion.php';
require_once MITECH_FRAMEWORK_DIR . '/class-vc-icon-linea.php';
require_once MITECH_FRAMEWORK_DIR . '/class-vc-icon-linea-svg.php';
require_once MITECH_FRAMEWORK_DIR . '/class-walker-nav-menu.php';
require_once MITECH_FRAMEWORK_DIR . '/class-widgets.php';
require_once MITECH_FRAMEWORK_DIR . '/class-footer.php';
require_once MITECH_FRAMEWORK_DIR . '/class-post-type-blog.php';
require_once MITECH_FRAMEWORK_DIR . '/class-post-type-case-study.php';
require_once MITECH_FRAMEWORK_DIR . '/class-post-type-points-image.php';
require_once MITECH_FRAMEWORK_DIR . '/class-woo.php';
require_once MITECH_FRAMEWORK_DIR . '/tgm-plugin-activation.php';
require_once MITECH_FRAMEWORK_DIR . '/tgm-plugin-registration.php';
require_once MITECH_FRAMEWORK_DIR . '/class-tha.php';

/**
 * Init the theme
 */
Mitech_Init::instance();
