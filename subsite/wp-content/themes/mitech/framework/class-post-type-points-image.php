<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Mitech_Points_Image' ) ) {
	class Mitech_Points_Image {

		protected static $instance  = null;
		protected static $post_type = 'points_image';

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function get_list() {
			$query_args = array(
				'post_type'      => self::$post_type,
				'posts_per_page' => -1,
				'orderby'        => 'date',
				'order'          => 'DESC',
				'post_status'    => 'publish',
			);

			$results = array();

			$query = new WP_Query( $query_args );

			if ( $query->have_posts() ) :
				while ( $query->have_posts() ) : $query->the_post();
					$title             = get_the_title();
					$results[ $title ] = get_the_ID();
				endwhile;
			endif;
			wp_reset_postdata();

			return $results;
		}

		function get_vc_dropdown_option() {
			$results = array();

			if ( is_admin() ) {
				$results = $this->get_list();
			}

			return $results;
		}
	}
}
