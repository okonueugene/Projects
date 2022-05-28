<?php
/*
Plugin Name: Mitech Extension
Description: Core functions for Mitech theme.
Author: ThemeMove
Author URI: http://thememove.com
Version: 1.0.1
Text Domain: mitech-extension
*/
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Mitech_Extension' ) ) {
	class Mitech_Extension {

		protected static $instance = null;

		function init() {
			$theme = get_option( 'template' );
			if ( $theme === 'mitech' ) {
				$this->define_constants();
				$this->includes();
				$this->init_hooks();
			}
		}

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function define_constants() {
			if ( ! defined( 'MTX_DIR_URL' ) ) {
				define( 'MTX_DIR_URL', plugin_dir_url( __FILE__ ) );
			}

			define( 'MTX_VERSION', '1.0.0' );
			define( 'MTX_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			define( 'MTX_INC_URL', trailingslashit( plugin_dir_path( __FILE__ ) . 'includes' ) );
			define( 'MTX_LIBS_URL', trailingslashit( plugin_dir_path( __FILE__ ) . 'libs' ) );
			define( 'MTX_ASSETS_URL', trailingslashit( MTX_DIR_URL . 'assets' ) );
			define( 'MTX_JS_URL', trailingslashit( MTX_ASSETS_URL . 'js' ) );
			define( 'MTX_CSS_URL', trailingslashit( MTX_ASSETS_URL . 'css' ) );
		}

		/**
		 * Include required core files.
		 *
		 * @since 1.0.1
		 */
		public function includes() {
			require_once MTX_INC_URL . 'class-performance.php';
			require_once MTX_INC_URL . 'class-aqua-resizer.php';
		}

		/**
		 * Hook into actions and filters.
		 *
		 * @since 1.0.0
		 */
		public function init_hooks() {
			add_action( 'plugins_loaded', array( $this, 'load_text_domain' ) );

			add_action( 'admin_bar_menu', array( $this, 'add_edit_footer_link' ), 90 );
		}

		/**
		 * Load plugin text domain.
		 *
		 * @since 1.0.0
		 */
		function load_text_domain() {
			load_plugin_textdomain( 'mitech-extension', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}

		function add_edit_footer_link( $wp_admin_bar ) {
			$footer_page = Mitech_Global::instance()->get_footer_type();

			if ( $footer_page === '' ) {
				return;
			}

			$args = array(
				'post_type'      => 'ic_footer',
				'posts_per_page' => 1,
				'post_name__in'  => array( $footer_page ),
				'fields'         => 'ids',
			);

			$footer_ids = get_posts( $args );

			if ( ! empty( $footer_ids ) ) {
				$args = array(
					'id'    => 'edit_footer',
					'title' => esc_html__( 'Edit Footer', 'mitech' ),
					'href'  => get_edit_post_link( $footer_ids[0] ),
				);

				$wp_admin_bar->add_node( $args );
			}
		}
	}

	Mitech_Extension::instance()->init();
}
