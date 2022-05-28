<?php
defined( 'ABSPATH' ) || exit;

/**
 * Theme Hook Alliance hook stub list.
 */

if ( ! class_exists( 'Mitech_THA' ) ) {

	class Mitech_THA {
		protected static $instance = null;

		static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function body_top() {
			do_action( 'mitech_body_top' );
		}

		function body_bottom() {
			do_action( 'mitech_body_bottom' );
		}

		function head_top() {
			do_action( 'mitech_head_top' );
		}

		function head_bottom() {
			do_action( 'mitech_head_bottom' );
		}

		function header_wrap_top() {
			do_action( 'mitech_header_wrap_top' );
		}

		function header_wrap_bottom() {
			do_action( 'mitech_header_wrap_bottom' );
		}

		function header_right_top() {
			do_action( 'mitech_header_right_top' );
		}

		function header_right_bottom() {
			do_action( 'mitech_header_right_bottom' );
		}

		function footer_before() {
			do_action( 'mitech_footer_before' );
		}

		function footer_after() {
			do_action( 'mitech_footer_after' );
		}
	}

}
