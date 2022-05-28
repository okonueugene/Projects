<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Mitech_Maintenance' ) ) {

	class Mitech_Maintenance {

		public static $templates = array(
			'blank.php',
			'maintenance.php',
		);

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function init() {
			add_action( 'wp', array( $this, 'maintenance_mode' ) );
		}

		function maintenance_mode() {
			$enable = Mitech::setting( 'maintenance_mode_enable' );

			if ( $enable || ( defined( 'MITECH_MAINTENANCE' ) && MITECH_MAINTENANCE === true ) ) {
				global $pagenow;
				global $post;
				$maintenance_page = Mitech::setting( 'maintenance_page' );

				if ( $maintenance_page !== '' && ! is_admin() && $post->ID != $maintenance_page && $pagenow !== 'wp-login.php' && ! current_user_can( 'manage_options' ) ) {
					wp_safe_redirect( get_permalink( $maintenance_page ) );
					exit;
				}
			}
		}

		function get_maintenance_templates() {
			return self::$templates;
		}

		function get_maintenance_templates_dir() {
			$results = array();

			foreach ( self::$templates as $value ) {
				$results[] = 'templates/' . $value;
			}

			return $results;
		}

		function get_maintenance_pages() {
			$maintenance_templates = $this->get_maintenance_templates();

			$args = array(
				'post_type'      => 'page',
				'posts_per_page' => -1,
				'no_found_rows'  => true,
				'meta_query'     => array(
					'relation' => 'OR',
				),
			);

			foreach ( $maintenance_templates as $value ) {
				$args['meta_query'][] = array(
					'key'     => '_wp_page_template',
					'value'   => $value,
					'compare' => 'LIKE',
				);
			}

			$query   = new WP_Query( $args );
			$results = array(
				'' => esc_html__( 'Select a page', 'mitech' ),
			);

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();

					$id             = get_the_ID();
					$results[ $id ] = get_the_title();
				}
			}

			wp_reset_postdata();

			return $results;
		}
	}

	Mitech_Maintenance::instance()->init();
}
