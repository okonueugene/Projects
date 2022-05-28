<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Mitech_Notices' ) ) {

	class Mitech_Notices {
		protected static $instance = null;

		static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function init() {
			add_action( 'wp_footer', array( $this, 'newsletter_popup' ) );

			// Notice Cookie Confirm.
			add_action( 'wp_ajax_notice_cookie_confirm', array( $this, 'notice_cookie_confirm' ) );
			add_action( 'wp_ajax_nopriv_notice_cookie_confirm', array( $this, 'notice_cookie_confirm' ) );

			// Newsletter Popup Confirm.
			add_action( 'wp_ajax_newsletter_popup_confirm', array( $this, 'newsletter_popup_confirm' ) );
			add_action( 'wp_ajax_nopriv_newsletter_popup_confirm', array( $this, 'newsletter_popup_confirm' ) );
		}

		public function notice_cookie_confirm() {
			setcookie( 'notice_cookie_confirm', 'yes', time() + 365 * 86400, COOKIEPATH, COOKIE_DOMAIN );

			wp_die();
		}

		function newsletter_popup_confirm() {
			setcookie( 'newsletter_popup_confirm', 'yes', time() + 365 * 86400, COOKIEPATH, COOKIE_DOMAIN );

			wp_die();
		}

		/**
		 * Add newsletter popup template to footer
		 */
		function newsletter_popup() {
			if ( $this->is_show_newsletter_popup() ) {
				get_template_part( 'components/newsletter-popup' );
			}
		}

		function is_show_newsletter_popup() {
			$confirm = isset( $_COOKIE['newsletter_popup_confirm'] ) ? 'yes' : 'no';
			$enable  = Mitech::setting( 'newsletter_popup_enable' );
			$form_id = Mitech_Helper::get_mailchimp_form_id();

			if ( $enable === '1' && $confirm === 'no' && $form_id !== '' ) {
				return true;
			}

			return false;
		}

		function get_notice_cookie_messages() {
			$messages    = Mitech::setting( 'notice_cookie_messages' );
			$button_text = Mitech::setting( 'notice_cookie_button_text' );

			$messages .= '<a id="tm-button-cookie-notice-ok" class="tm-button tm-button-xs tm-button-full-wide style-flat">' . $button_text . '</a>';

			return $messages;
		}
	}

	Mitech_Notices::instance()->init();
}
