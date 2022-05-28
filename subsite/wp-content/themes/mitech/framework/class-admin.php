<?php
defined( 'ABSPATH' ) || exit;

// Do nothing if not an admin page.
if ( ! is_admin() ) {
	return;
}

/**
 * Hook & filter that run only on admin pages.
 */
if ( ! class_exists( 'Mitech_Admin' ) ) {
	class Mitech_Admin {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function init() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

			add_action( 'load-post.php', array( $this, 'load_post' ) );
			add_action( 'load-post-new.php', array( $this, 'load_post' ) );
		}

		/**
		 * Enqueue scrips & styles.
		 *
		 * @access public
		 */
		function enqueue_scripts() {
			wp_enqueue_style( 'mitech-admin', MITECH_THEME_URI . '/assets/admin/css/style.min.css' );

			// Don't load vc_clipboard scripts on all pages. just load on post page.
			wp_dequeue_script( 'vc_clipboard' );
		}

		function load_post() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_post_scripts' ) );
		}

		function enqueue_post_scripts() {
			wp_enqueue_script( 'vc_clipboard' );
		}
	}

	Mitech_Admin::instance()->init();
}
