<?php
defined( 'ABSPATH' ) || exit;

/**
 * Initialize Global Variables
 */
if ( ! class_exists( 'Mitech_Global' ) ) {
	class Mitech_Global {

		protected static $instance         = null;
		protected static $slider           = '';
		protected static $slider_position  = 'below';
		protected static $top_bar_type     = '01';
		protected static $header_type      = '01';
		protected static $title_bar_type   = '01';
		protected static $sidebar_1        = '';
		protected static $sidebar_2        = '';
		protected static $sidebar_position = '';
		protected static $sidebar_special  = 'none';
		protected static $sidebar_status   = 'none';
		protected static $footer_type      = '';
		protected static $footer_post      = '';
		protected static $popup_search     = false;
		protected static $off_sidebar      = false;

		function init() {
			add_action( 'wp', array( $this, 'init_global_variable' ) );
		}

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function init_global_variable() {
			global $mitech_page_options;
			if ( is_singular( 'case_study' ) ) {
				$mitech_page_options = unserialize( get_post_meta( get_the_ID(), 'insight_case_study_options', true ) );
			} elseif ( is_singular( 'post' ) ) {
				$mitech_page_options = unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
			} elseif ( is_singular( 'page' ) ) {
				$mitech_page_options = unserialize( get_post_meta( get_the_ID(), 'insight_page_options', true ) );
			} elseif ( is_singular( 'product' ) ) {
				$mitech_page_options = unserialize( get_post_meta( get_the_ID(), 'insight_product_options', true ) );
			}
			if ( function_exists( 'is_shop' ) && is_shop() ) {
				// Get page id of shop.
				$page_id             = wc_get_page_id( 'shop' );
				$mitech_page_options = unserialize( get_post_meta( $page_id, 'insight_page_options', true ) );
			}

			$this->set_slider();
			$this->set_top_bar_type();
			$this->set_header_type();
			$this->set_title_bar_type();
			$this->set_sidebars();
			$this->set_footer_type();
			$this->set_footer_post();
			$this->set_popup_search();
			$this->set_off_sidebar();
		}

		function set_slider() {
			$alias    = Mitech_Helper::get_post_meta( 'revolution_slider', '' );
			$position = Mitech_Helper::get_post_meta( 'slider_position', '' );

			self::$slider          = $alias;
			self::$slider_position = $position;
		}

		function get_slider_alias() {
			return self::$slider;
		}

		function get_slider_position() {
			return self::$slider_position;
		}

		function set_top_bar_type() {
			$type = Mitech_Helper::get_post_meta( 'top_bar_type', '' );

			if ( $type === '' ) {
				$type = Mitech::setting( 'global_top_bar' );
			}

			self::$top_bar_type = $type;
		}

		function get_top_bar_type() {
			return self::$top_bar_type;
		}

		function set_header_type() {
			$header_type = Mitech_Helper::get_post_meta( 'header_type', '' );

			if ( $header_type === '' ) {
				if ( Mitech_Woo::instance()->is_woocommerce_page_without_product() ) {

					$header_type = Mitech::setting( 'archive_product_header_type' );

				} elseif ( Mitech_Case_Study::instance()->is_archive() ) {

					$header_type = Mitech::setting( 'archive_case_study_header_type' );

				} elseif ( is_archive() ) {

					$header_type = Mitech::setting( 'archive_blog_header_type' );

				} elseif ( is_singular( 'post' ) ) {

					$header_type = Mitech::setting( 'single_post_header_type' );

				} elseif ( is_singular( 'case_study' ) ) {

					$header_type = Mitech::setting( 'single_case_study_header_type' );

				} elseif ( is_singular( 'product' ) ) {

					$header_type = Mitech::setting( 'single_product_header_type' );

				} elseif ( is_singular( 'page' ) ) {

					$header_type = Mitech::setting( 'single_page_header_type' );

				} else {
					$header_type = Mitech::setting( 'global_header' );
				}
			}

			if ( $header_type === '' ) {
				$header_type = Mitech::setting( 'global_header' );
			}

			$header_type = apply_filters( 'mitech_header_type', $header_type );

			self::$header_type = $header_type;
		}

		function get_header_type() {
			return self::$header_type;
		}

		function set_title_bar_type() {
			$type = Mitech_Helper::get_post_meta( 'page_title_bar_layout', '' );

			if ( $type === '' ) {
				if ( Mitech_Woo::instance()->is_woocommerce_page_without_product() ) {
					$type = Mitech::setting( 'product_archive_page_title_bar_layout' );
				} elseif ( Mitech_Case_Study::instance()->is_archive() ) {
					$type = Mitech::setting( 'case_study_archive_page_title_bar_layout' );
				} elseif ( is_archive() ) {
					$type = Mitech::setting( 'blog_archive_page_title_bar_layout' );
				} elseif ( is_singular( 'post' ) ) {
					$type = Mitech::setting( 'post_page_title_bar_layout' );
				} elseif ( is_singular( 'page' ) ) {
					$type = Mitech::setting( 'page_title_bar_layout' );
				} elseif ( is_singular( 'product' ) ) {
					$type = Mitech::setting( 'product_page_title_bar_layout' );
				} elseif ( is_singular( 'case_study' ) ) {
					$type = Mitech::setting( 'case_study_page_title_bar_layout' );
				} elseif ( is_home() ) {
					$type = Mitech::setting( 'home_page_title_bar_layout' );
				} else {
					$type = Mitech::setting( 'title_bar_layout' );
				}

				if ( $type === '' ) {
					$type = Mitech::setting( 'title_bar_layout' );
				}
			}

			$type = apply_filters( 'mitech_title_bar_type', $type );

			self::$title_bar_type = $type;
		}

		function get_title_bar_type() {
			return self::$title_bar_type;
		}

		function set_sidebars() {
			if ( is_search() && ! is_post_type_archive( 'product' ) ) {
				$page_sidebar1    = Mitech::setting( 'search_page_sidebar_1' );
				$page_sidebar2    = Mitech::setting( 'search_page_sidebar_2' );
				$sidebar_position = Mitech::setting( 'search_page_sidebar_position' );
				$sidebar_special  = Mitech::setting( 'search_page_sidebar_special' );
			} elseif ( Mitech_Woo::instance()->is_product_archive() ) {
				$page_sidebar1    = Mitech::setting( 'product_archive_page_sidebar_1' );
				$page_sidebar2    = Mitech::setting( 'product_archive_page_sidebar_2' );
				$sidebar_position = Mitech::setting( 'product_archive_page_sidebar_position' );
				$sidebar_special  = Mitech::setting( 'product_archive_page_sidebar_special' );
			} elseif ( Mitech_Case_Study::instance()->is_archive() ) {
				$page_sidebar1    = Mitech::setting( 'case_study_archive_page_sidebar_1' );
				$page_sidebar2    = Mitech::setting( 'case_study_archive_page_sidebar_2' );
				$sidebar_position = Mitech::setting( 'case_study_archive_page_sidebar_position' );
				$sidebar_special  = Mitech::setting( 'case_study_archive_page_sidebar_special' );
			} elseif ( is_archive() ) {
				$page_sidebar1    = Mitech::setting( 'blog_archive_page_sidebar_1' );
				$page_sidebar2    = Mitech::setting( 'blog_archive_page_sidebar_2' );
				$sidebar_position = Mitech::setting( 'blog_archive_page_sidebar_position' );
				$sidebar_special  = Mitech::setting( 'blog_archive_page_sidebar_special' );
			} elseif ( is_home() ) {
				$page_sidebar1    = Mitech::setting( 'home_page_sidebar_1' );
				$page_sidebar2    = Mitech::setting( 'home_page_sidebar_2' );
				$sidebar_position = Mitech::setting( 'home_page_sidebar_position' );
				$sidebar_special  = Mitech::setting( 'home_page_sidebar_special' );
			} elseif ( is_singular( 'post' ) ) {
				$page_sidebar1    = Mitech_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2    = Mitech_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				$sidebar_position = Mitech_Helper::get_post_meta( 'page_sidebar_position', 'default' );
				$sidebar_special  = Mitech_Helper::get_post_meta( 'page_sidebar_special', 'default' );

				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Mitech::setting( 'post_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Mitech::setting( 'post_page_sidebar_2' );
				}

				if ( $sidebar_position === 'default' ) {
					$sidebar_position = Mitech::setting( 'post_page_sidebar_position' );
				}

				if ( $sidebar_special === 'default' ) {
					$sidebar_special = Mitech::setting( 'post_page_sidebar_special' );
				}

			} elseif ( is_singular( 'case_study' ) ) {
				$page_sidebar1    = Mitech_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2    = Mitech_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				$sidebar_position = Mitech_Helper::get_post_meta( 'page_sidebar_position', 'default' );
				$sidebar_special  = Mitech_Helper::get_post_meta( 'page_sidebar_special', 'default' );

				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Mitech::setting( 'case_study_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Mitech::setting( 'case_study_page_sidebar_2' );
				}

				if ( $sidebar_position === 'default' ) {
					$sidebar_position = Mitech::setting( 'case_study_page_sidebar_position' );
				}

				if ( $sidebar_special === 'default' ) {
					$sidebar_special = Mitech::setting( 'case_study_page_sidebar_special' );
				}

			} elseif ( is_singular( 'product' ) ) {
				$page_sidebar1    = Mitech_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2    = Mitech_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				$sidebar_position = Mitech_Helper::get_post_meta( 'page_sidebar_position', 'default' );
				$sidebar_special  = Mitech_Helper::get_post_meta( 'page_sidebar_special', 'default' );

				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Mitech::setting( 'product_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Mitech::setting( 'product_page_sidebar_2' );
				}

				if ( $sidebar_position === 'default' ) {
					$sidebar_position = Mitech::setting( 'product_page_sidebar_position' );
				}

				if ( $sidebar_special === 'default' ) {
					$sidebar_special = Mitech::setting( 'product_page_sidebar_special' );
				}

			} else {
				$page_sidebar1    = Mitech_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2    = Mitech_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				$sidebar_position = Mitech_Helper::get_post_meta( 'page_sidebar_position', 'default' );
				$sidebar_special  = Mitech_Helper::get_post_meta( 'page_sidebar_special', 'default' );

				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Mitech::setting( 'page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Mitech::setting( 'page_sidebar_2' );
				}

				if ( $sidebar_position === 'default' ) {
					$sidebar_position = Mitech::setting( 'page_sidebar_position' );
				}

				if ( $sidebar_special === 'default' ) {
					$sidebar_special = Mitech::setting( 'page_sidebar_special' );
				}

			}

			if ( ! is_active_sidebar( $page_sidebar1 ) ) {
				$page_sidebar1 = 'none';
			}

			if ( ! is_active_sidebar( $page_sidebar2 ) ) {
				$page_sidebar2 = 'none';
			}

			self::$sidebar_special  = $sidebar_special;
			self::$sidebar_1        = $page_sidebar1;
			self::$sidebar_2        = $page_sidebar2;
			self::$sidebar_position = $sidebar_position;

			if ( $page_sidebar1 !== 'none' || $page_sidebar2 !== 'none' ) {
				self::$sidebar_status = 'one';
			}

			if ( $page_sidebar1 !== 'none' && $page_sidebar2 !== 'none' ) {
				self::$sidebar_status = 'both';
			}
		}

		function get_sidebar_1() {
			return self::$sidebar_1;
		}

		function get_sidebar_2() {
			return self::$sidebar_2;
		}

		function get_sidebar_special() {
			return self::$sidebar_special;
		}

		function get_sidebar_position() {
			return self::$sidebar_position;
		}

		function get_sidebar_status() {
			return self::$sidebar_status;
		}

		function set_footer_type() {
			$footer = Mitech_Helper::get_post_meta( 'footer_page', '' );

			if ( $footer === 'default' || $footer === '' ) {
				$footer = Mitech::setting( 'footer_page' );
			}

			self::$footer_type = $footer;
		}

		function get_footer_type() {
			return self::$footer_type;
		}

		function set_footer_post() {
			$footer = self::get_footer_type();

			if ( $footer === 'none' ) {
				return;
			}

			$_mitech_args = array(
				'post_type'   => 'ic_footer',
				'name'        => $footer,
				'post_status' => 'publish',
			);

			$_mitech_query = new WP_Query( $_mitech_args );

			if ( is_a( $_mitech_query, 'WP_Query' ) ) {
				self::$footer_post = $_mitech_query;
			}
		}

		function get_footer_post() {
			return self::$footer_post;
		}

		function set_popup_search() {
			$header_type = $this->get_header_type();
			$enable      = Mitech::setting( "header_style_{$header_type}_search_popup_enable" );

			if ( $enable === '1' ) {
				self::$popup_search = true;
			}
		}

		function get_popup_search() {
			return self::$popup_search;
		}

		function set_off_sidebar() {
			$header_type = $this->get_header_type();
			$enable      = Mitech::setting( "header_style_{$header_type}_off_sidebar_enable" );

			if ( $enable === '1' ) {
				self::$off_sidebar = true;
			}
		}

		function get_off_sidebar() {
			return self::$off_sidebar;
		}
	}

	Mitech_Global::instance()->init();
}
