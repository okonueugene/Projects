<?php
defined( 'ABSPATH' ) || exit;

/**
 * Enqueue scripts and styles.
 */
if ( ! class_exists( 'Mitech_Enqueue' ) ) {
	class Mitech_Enqueue {

		protected static $instance = null;

		public function init() {
			add_action( 'enqueue_block_editor_assets', array( $this, 'gutenberg_editor' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );

			// Disable all contact form 7 scripts.
			add_filter( 'wpcf7_load_js', '__return_false' );
			add_filter( 'wpcf7_load_css', '__return_false' );

			// Re queue contact form 7 scripts when used.
			add_action( 'wp_enqueue_scripts', array( $this, 'requeue_wpcf7_scripts' ), 99 );

			// Disable woocommerce all styles.
			add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

			add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_woocommerce_styles_scripts' ), 99 );
			add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_woo_smart_wishlist_scripts' ), 99 );
		}

		function gutenberg_editor() {
			wp_enqueue_style( 'cerebrisans-font', MITECH_THEME_URI . '/assets/fonts/cerebrisans/cerebrisans.css', array(), null );
		}

		function requeue_wpcf7_scripts() {
			global $post;

			$footer_query = Mitech_Global::instance()->get_footer_post();
			$footer_post  = '';
			if ( $footer_query !== '' && isset( $footer_query->posts[0] ) ) {
				$footer_post = $footer_query->posts[0];
			}

			if (
				( is_a( $post, 'WP_Post' ) && ( has_shortcode( $post->post_content, 'contact-form-7' ) ||
				                                has_shortcode( $post->post_content, 'tm_contact_form_7' ) ||
				                                has_shortcode( $post->post_content, 'tm_contact_form_7_box' )
					) ) ||

				( is_a( $footer_post, 'WP_Post' ) && ( has_shortcode( $footer_post->post_content, 'contact-form-7' ) ||
				                                       has_shortcode( $footer_post->post_content, 'tm_contact_form_7' ) ||
				                                       has_shortcode( $footer_post->post_content, 'tm_contact_form_7_box' )
					) )
			) {

				if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
					wpcf7_enqueue_scripts();
				}

				if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
					wpcf7_enqueue_styles();
				}
			}
		}

		function dequeue_woocommerce_styles_scripts() {
			if ( function_exists( 'is_woocommerce' ) ) {
				if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
					// Scripts + Styles from Woo Smart Compare
					wp_dequeue_script( 'woosc-frontend' );
					wp_dequeue_script( 'dragarrange' );
					wp_dequeue_script( 'tableHeadFixer' );
				}
			}
		}

		function dequeue_woo_smart_wishlist_scripts() {
			if ( ! class_exists( 'WPCleverWoosw' ) ) {
				return;
			}

			// Dequeue feather font
			wp_dequeue_style( 'woosw-feather' );
		}

		function enqueue_woocommerce_styles_scripts() {
			wp_enqueue_script( 'woosc-frontend' );
			wp_enqueue_script( 'dragarrange' );
			wp_enqueue_script( 'tableHeadFixer' );
		}

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Enqueue scripts & styles.
		 *
		 * @access public
		 */
		public function enqueue() {
			$post_type = get_post_type();

			// Remove prettyPhoto, default light box of woocommerce.
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

			// Prevent enqueue ihotspot on all pages then only enqueue when use.
			wp_dequeue_script( 'ihotspot-js' );
			wp_dequeue_style( 'ihotspot' );

			// Remove font awesome from Yith Wishlist plugin.
			wp_dequeue_style( 'yith-wcwl-font-awesome' );

			// Remove hint from Woo Smart Compare plugin.
			wp_dequeue_style( 'hint' );

			// Remove font awesome from Visual Composer plugin.
			wp_deregister_style( 'font-awesome' );
			wp_dequeue_style( 'font-awesome' );

			/*
			 * Begin register scripts & styles to be enqueued later.
			 */
			wp_register_style( 'mitech-style-rtl', MITECH_THEME_URI . '/style-rtl.css', null, MITECH_THEME_VERSION );
			wp_register_style( 'mitech-woocommerce', MITECH_THEME_URI . '/woocommerce.css' );

			wp_register_style( 'font-awesome', MITECH_THEME_URI . '/assets/fonts/awesome/css/fontawesome-all.min.css', null, '5.6.3' );

			wp_register_style( 'justifiedGallery', MITECH_THEME_URI . '/assets/libs/justifiedGallery/css/justifiedGallery.min.css', null, '3.7.0' );
			wp_register_script( 'justifiedGallery', MITECH_THEME_URI . '/assets/libs/justifiedGallery/js/jquery.justifiedGallery.min.js', array( 'jquery' ), '3.7.0', true );

			wp_register_style( 'spinkit', MITECH_THEME_URI . '/assets/libs/spinkit/spinkit.min.css', null, null );

			wp_register_style( 'lightgallery', MITECH_THEME_URI . '/assets/libs/lightGallery/css/lightgallery.min.css', null, '1.6.12' );
			wp_register_script( 'lightgallery', MITECH_THEME_URI . '/assets/libs/lightGallery/js/lightgallery-all.min.js', array(
				'jquery',
			), '1.6.12', true );

			wp_register_style( 'lightslider', MITECH_THEME_URI . '/assets/libs/lightslider/css/lightslider.min.css' );
			wp_register_script( 'lightslider', MITECH_THEME_URI . '/assets/libs/lightslider/js/lightslider.min.js', array( 'jquery' ), MITECH_THEME_VERSION, true );

			wp_register_style( 'magnific-popup', MITECH_THEME_URI . '/assets/libs/magnific-popup/magnific-popup.min.css' );
			wp_register_script( 'magnific-popup', MITECH_THEME_URI . '/assets/libs/magnific-popup/jquery.magnific-popup.min.js', array( 'jquery' ), MITECH_THEME_VERSION, true );

			wp_register_style( 'growl', MITECH_THEME_URI . '/assets/libs/growl/css/jquery.growl.min.css', null, '1.3.3' );
			wp_register_script( 'growl', MITECH_THEME_URI . '/assets/libs/growl/js/jquery.growl.min.js', array( 'jquery' ), '1.3.3', true );

			// Fix VC waypoints.
			if ( ! wp_script_is( 'vc_waypoints', 'registered' ) ) {
				wp_register_script( 'vc_waypoints', MITECH_THEME_URI . '/assets/libs/vc-waypoints/vc-waypoints.min.js', array( 'jquery' ), null, true );
			}

			wp_register_script( 'time-circle', MITECH_THEME_URI . '/assets/libs/time-circle/TimeCircles.min.js', array( 'jquery' ), MITECH_THEME_VERSION, true );

			wp_register_style( 'flipclock', MITECH_THEME_URI . '/assets/libs/flipclock/flipclock.min.css', null, null );
			wp_register_script( 'flipclock', MITECH_THEME_URI . '/assets/libs/flipclock/flipclock.min.js', array( 'jquery' ), null, true );

			wp_register_script( 'matchheight', MITECH_THEME_URI . '/assets/libs/matchHeight/jquery.matchHeight-min.js', array( 'jquery' ), MITECH_THEME_VERSION, true );
			wp_register_script( 'gmap3', MITECH_THEME_URI . '/assets/libs/gmap3/gmap3.min.js', array( 'jquery' ), MITECH_THEME_VERSION, true );
			wp_register_script( 'countdown', MITECH_THEME_URI . '/assets/libs/jquery.countdown/js/jquery.countdown.min.js', array( 'jquery' ), MITECH_THEME_VERSION, true );
			wp_register_script( 'typed', MITECH_THEME_URI . '/assets/libs/typed/typed.min.js', array( 'jquery' ), null, true );
			wp_register_script( 'tilt', MITECH_THEME_URI . '/assets/libs/tilt/tilt.jquery.min.js', array( 'jquery' ), null, true );

			wp_register_script( 'scrollie', MITECH_THEME_URI . '/assets/libs/jquery-scrollie/jquery.scrollie.min.js', array( 'jquery' ), null, true );
			wp_register_script( 'mitech-scrolling-background', MITECH_THEME_URI . "/assets/js/scrolling-background.js", array(
				'jquery',
				'scrollie',
			), null, true );

			// Fix Wordpress old version not registered this script.
			if ( ! wp_script_is( 'imagesloaded', 'registered' ) ) {
				wp_register_script( 'imagesloaded', MITECH_THEME_URI . '/assets/libs/imagesloaded/imagesloaded.min.js', array( 'jquery' ), null, true );
			}

			wp_register_style( 'swiper', MITECH_THEME_URI . '/assets/libs/swiper/css/swiper.min.css', null, '4.5.0' );
			wp_register_script( 'swiper', MITECH_THEME_URI . '/assets/libs/swiper/js/swiper.min.js', array(
				'jquery',
				'imagesloaded',
			), '4.5.0', true );

			wp_register_script( 'isotope-masonry', MITECH_THEME_URI . '/assets/libs/isotope/js/isotope.pkgd.min.js', array( 'jquery' ), MITECH_THEME_VERSION, true );
			wp_register_script( 'isotope-packery', MITECH_THEME_URI . '/assets/libs/packery-mode/packery-mode.pkgd.min.js', array(
				'jquery',
				'imagesloaded',
				'isotope-masonry',
			), MITECH_THEME_VERSION, true );

			wp_register_script( 'sticky-kit', MITECH_THEME_URI . '/assets/js/jquery.sticky-kit.min.js', array(
				'jquery',
			), MITECH_THEME_VERSION, true );

			wp_register_script( 'picturefill', MITECH_THEME_URI . '/assets/libs/picturefill/picturefill.min.js', array( 'jquery' ), null, true );

			wp_register_script( 'mousewheel', MITECH_THEME_URI . '/assets/libs/mousewheel/jquery.mousewheel.min.js', array( 'jquery' ), MITECH_THEME_VERSION, true );

			wp_register_script( 'tween-max', MITECH_THEME_URI . '/assets/libs/tween-max/TweenMax.min.js', array(
				'jquery',
			), MITECH_THEME_VERSION, true );

			wp_register_script( 'hoverIntent', MITECH_THEME_URI . '/assets/libs/hoverIntent/jquery.hoverIntent.min.js', array(
				'jquery',
			), null, true );

			wp_register_script( 'easing', MITECH_THEME_URI . '/assets/libs/easing/jquery.easing.min.js', array( 'jquery' ), MITECH_THEME_VERSION, true );

			wp_register_script( 'laziestloader', MITECH_THEME_URI . '/assets/libs/laziestloader/jquery.laziestloader.min.js', array( 'jquery' ), '0.7.2', true );

			wp_register_script( 'firefly', MITECH_THEME_URI . '/assets/js/firefly.js', array( 'jquery' ), MITECH_THEME_VERSION, true );

			wp_register_script( 'wavify', MITECH_THEME_URI . '/assets/js/wavify.js', array(
				'jquery',
				'tween-max',
			), MITECH_THEME_VERSION, true );

			wp_register_script( 'particles', MITECH_THEME_URI . '/assets/libs/particles/particles.min.js', array( 'jquery' ), MITECH_THEME_VERSION, true );

			wp_register_script( 'constellation', MITECH_THEME_URI . '/assets/js/constellation.js', array(
				'jquery',
				'particles',
			), MITECH_THEME_VERSION, true );

			wp_register_script( 'odometer', MITECH_THEME_URI . '/assets/libs/odometer/odometer.min.js', array( 'jquery' ), MITECH_THEME_VERSION, true );

			wp_register_script( 'counter-up', MITECH_THEME_URI . '/assets/libs/countTo/jquery.countTo.js', array( 'jquery' ), MITECH_THEME_VERSION, true );

			wp_register_script( 'counter', MITECH_THEME_URI . '/assets/js/counter.js', array(
				'jquery',
				'vc_waypoints',
			), MITECH_THEME_VERSION, true );

			wp_register_script( 'chart-js', MITECH_THEME_URI . '/assets/libs/chart/Chart.min.js', array( 'jquery' ), MITECH_THEME_VERSION, true );

			wp_register_script( 'advanced-chart', MITECH_THEME_URI . '/assets/js/advanced-chart.js', array(
				'jquery',
				'vc_waypoints',
				'chart-js',
			), MITECH_THEME_VERSION, true );

			wp_register_script( 'circle-progress', MITECH_THEME_URI . '/assets/libs/circle-progress/circle-progress.min.js', array( 'jquery' ), null, true );
			wp_register_script( 'circle-progress-chart', MITECH_THEME_URI . '/assets/js/circle-progress-chart.js', array(
				'jquery',
				'vc_waypoints',
				'circle-progress',
			), null, true );

			wp_register_script( 'mitech-accordion', MITECH_THEME_URI . '/assets/js/accordion.js', array( 'jquery' ), MITECH_THEME_VERSION, true );

			wp_register_script( 'mitech-contact-form', MITECH_THEME_URI . '/assets/js/contact-form-7.js', array( 'jquery' ), MITECH_THEME_VERSION, true );

			wp_register_script( 'mitech-countdown', MITECH_THEME_URI . '/assets/js/countdown.js', array( 'jquery' ), MITECH_THEME_VERSION, true );

			/*
			 * End register scripts
			 */
			if ( MITECH_IS_RTL ) {
				wp_enqueue_style( 'mitech-style-rtl' );
			}

			wp_enqueue_style( 'font-awesome' );
			wp_enqueue_style( 'swiper' );
			wp_enqueue_style( 'spinkit' );
			wp_enqueue_style( 'lightgallery' );

			/*
			 * Enqueue the theme's style.css.
			 * This is recommended because we can add inline styles there
			 * and some plugins use it to do exactly that.
			 */
			wp_enqueue_style( 'mitech-style', get_template_directory_uri() . '/style.css' );

			if ( Mitech_Woo::instance()->is_activated() ) {
				wp_enqueue_style( 'mitech-woocommerce' );
			}

			if ( Mitech::setting( 'header_sticky_enable' ) ) {
				wp_enqueue_script( 'headroom', MITECH_THEME_URI . '/assets/js/headroom.js', array( 'jquery' ), MITECH_THEME_VERSION, true );
			}

			wp_enqueue_script( 'lightgallery' );

			wp_enqueue_script( 'jquery-smooth-scroll', MITECH_THEME_URI . '/assets/libs/smooth-scroll/jquery.smooth-scroll.min.js', array( 'jquery' ), MITECH_THEME_VERSION, true );
			wp_enqueue_script( 'swiper' );
			wp_enqueue_script( 'laziestloader' );
			wp_enqueue_script( 'hoverIntent' );
			wp_enqueue_script( 'smartmenus', MITECH_THEME_URI . '/assets/libs/smartmenus/jquery.smartmenus.min.js', array( 'jquery' ), MITECH_THEME_VERSION, true );

			wp_enqueue_style( 'perfect-scrollbar', MITECH_THEME_URI . '/assets/libs/perfect-scrollbar/css/perfect-scrollbar.min.css' );
			wp_enqueue_style( 'perfect-scrollbar-woosw', MITECH_THEME_URI . '/assets/libs/perfect-scrollbar/css/custom-theme.min.css' );
			wp_enqueue_script( 'perfect-scrollbar', MITECH_THEME_URI . '/assets/libs/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js', array( 'jquery' ), MITECH_THEME_VERSION, true );

			if ( Mitech::setting( 'notice_cookie_enable' ) === '1' && ! isset( $_COOKIE['notice_cookie_confirm'] ) ) {
				wp_enqueue_script( 'growl' );
				wp_enqueue_style( 'growl' );
			}

			if ( Mitech_Woo::instance()->is_activated() && Mitech::setting( 'shop_archive_quick_view' ) === '1' ) {
				wp_enqueue_style( 'magnific-popup' );
				wp_enqueue_script( 'magnific-popup' );

				wp_enqueue_style( 'lightslider' );
				wp_enqueue_script( 'lightslider' );
			}

			$is_product = false;

			//  Enqueue styles & scripts for single pages.
			if ( is_singular() ) {

				switch ( $post_type ) {
					case 'case_study':
						$_sticky = Mitech::setting( 'single_case_study_sticky_detail_enable' );


						if ( $_sticky == '1' ) {
							wp_enqueue_script( 'sticky-kit' );
						}

						wp_enqueue_style( 'lightgallery' );
						wp_enqueue_script( 'lightgallery' );

						wp_enqueue_script( 'isotope-packery' );

						break;

					case 'product':
						$is_product = true;

						wp_enqueue_style( 'lightgallery' );
						wp_enqueue_script( 'lightgallery' );

						wp_enqueue_style( 'lightslider' );
						wp_enqueue_script( 'lightslider' );

						break;
				}
			}

			/*
			 * The comment-reply script.
			 */
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				if ( $post_type === 'post' ) {
					if ( Mitech::setting( 'single_post_comment_enable' ) === '1' ) {
						wp_enqueue_script( 'comment-reply' );
					}
				} elseif ( $post_type === 'case_study' ) {
					if ( Mitech::setting( 'single_case_study_comment_enable' ) === '1' ) {
						wp_enqueue_script( 'comment-reply' );
					}
				} else {
					wp_enqueue_script( 'comment-reply' );
				}
			}

			$maintenance_templates = Mitech_Maintenance::instance()->get_maintenance_templates_dir();

			if ( is_page_template( $maintenance_templates ) ) {
				wp_enqueue_script( 'mitech-maintenance', MITECH_THEME_URI . '/assets/js/maintenance.js', array( 'jquery' ), MITECH_THEME_VERSION, true );
			}

			if ( is_page_template( 'templates/one-page-scroll.php' ) ) {
				wp_enqueue_script( 'full-page', MITECH_THEME_URI . '/assets/js/jquery.fullPage.js', array( 'jquery' ), null, true );
			}

			wp_enqueue_script( 'wpb_composer_front_js' );

			/*
			 * Enqueue main JS
			 */
			wp_enqueue_script( 'mitech-script', MITECH_THEME_URI . '/assets/js/main.js', array(
				'jquery',
				'vc_waypoints',
			), MITECH_THEME_VERSION, true );

			if ( Mitech_Woo::instance()->is_activated() ) {
				wp_enqueue_script( 'mitech-woo', MITECH_THEME_URI . '/assets/js/woo.js', array(
					'mitech-script',
				), MITECH_THEME_VERSION, true );
			}

			/*
			 * Enqueue custom variable JS
			 */

			$js_variables = array(
				'isRTL'                     => MITECH_IS_RTL,
				'templateUrl'               => MITECH_THEME_URI,
				'ajaxurl'                   => admin_url( 'admin-ajax.php' ),
				'primary_color'             => Mitech::setting( 'primary_color' ),
				'header_sticky_enable'      => Mitech::setting( 'header_sticky_enable' ),
				'header_sticky_height'      => Mitech::setting( 'header_sticky_height' ),
				'scroll_top_enable'         => Mitech::setting( 'scroll_top_enable' ),
				'light_gallery_auto_play'   => Mitech::setting( 'light_gallery_auto_play' ),
				'light_gallery_download'    => Mitech::setting( 'light_gallery_download' ),
				'light_gallery_full_screen' => Mitech::setting( 'light_gallery_full_screen' ),
				'light_gallery_zoom'        => Mitech::setting( 'light_gallery_zoom' ),
				'light_gallery_thumbnail'   => Mitech::setting( 'light_gallery_thumbnail' ),
				'light_gallery_share'       => Mitech::setting( 'light_gallery_share' ),
				'mobile_menu_breakpoint'    => Mitech::setting( 'mobile_menu_breakpoint' ),
				'isProduct'                 => $is_product,
				'noticeCookieEnable'        => Mitech::setting( 'notice_cookie_enable' ),
				'noticeCookieConfirm'       => isset( $_COOKIE['notice_cookie_confirm'] ) ? 'yes' : 'no',
				'noticeCookieMessages'      => Mitech_Notices::instance()->get_notice_cookie_messages(),
				'isShowNewsletterPopup'     => Mitech_Notices::instance()->is_show_newsletter_popup(),
			);
			wp_localize_script( 'mitech-script', '$insight', $js_variables );

			/**
			 * Custom JS
			 */
			if ( Mitech::setting( 'custom_js_enable' ) == 1 ) {
				wp_add_inline_script( 'mitech-script', html_entity_decode( Mitech::setting( 'custom_js' ) ) );
			}

			// VC custom css.
			$_mitech_query     = Mitech_Global::instance()->get_footer_post();
			$footer_custom_css = '';
			if ( $_mitech_query !== '' && $_mitech_query->have_posts() ) {
				while ( $_mitech_query->have_posts() ) : $_mitech_query->the_post();
					$footer_custom_css .= get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
				endwhile;

				wp_add_inline_style( 'mitech-style', html_entity_decode( $footer_custom_css, ENT_QUOTES ) );

				wp_reset_postdata();
			}
		}
	}

	Mitech_Enqueue::instance()->init();
}
