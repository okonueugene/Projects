<?php
defined( 'ABSPATH' ) || exit;

/**
 * Custom functions, filters, actions for WooCommerce.
 */
if ( ! class_exists( 'Mitech_Woo' ) ) {
	class Mitech_Woo {

		protected static $instance = null;
		const MINIMUM_PLUGIN_VERSION = '4.0.2';

		public static $product_image_size_width  = '';
		public static $product_image_size_height = '';
		public static $product_image_crop        = true;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function init() {
			if ( ! $this->is_activated() ) {
				return;
			}

			add_filter( 'insight_core_tgm_plugins', array( $this, 'register_related_plugins' ) );

			add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'header_add_to_cart_fragment' ) );

			add_filter( 'woocommerce_checkout_fields', array( $this, 'override_checkout_fields' ) );

			add_action( 'wp_head', array( $this, 'wp_init' ) );

			add_action( 'after_switch_theme', array( $this, 'change_woocommerce_image_dimensions' ), 1 );

			// Remove bracket around widget filter layered nav count
			add_filter( 'woocommerce_layered_nav_count', array( $this, 'remove_bracket_around_nav_count' ), 10, 2 );

			/* Begin hook for shop archive */
			add_filter( 'loop_shop_per_page', array( $this, 'loop_shop_per_page' ), 20 );

			add_filter( 'woocommerce_pagination_args', array( $this, 'override_pagination_args' ) );

			// Add link to the product title
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
			add_action( 'woocommerce_shop_loop_item_title', array(
				$this,
				'template_loop_product_title',
			), 10 );

			/* End hook for shop archive */

			/*
			 * Begin hooks for single product
			 */

			// Move product rating after product price.
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating' );
			add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15 );

			add_action( 'woocommerce_product_meta_end', array( $this, 'add_sharing_in_product_meta' ), 25 );

			// Remove tab heading in on single product pages.
			add_filter( 'woocommerce_product_description_heading', '__return_empty_string' );
			add_filter( 'woocommerce_product_additional_information_heading', '__return_empty_string' );

			add_filter( 'woocommerce_review_gravatar_size', array( $this, 'woocommerce_review_gravatar_size' ) );

			// Check old version installed.
			if ( defined( 'WOOSCP_VERSION' ) || ( defined( 'WOOSC_VERSION' ) && version_compare( WOOSC_VERSION, self::MINIMUM_PLUGIN_VERSION, '<' ) ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_compare_plugin_version' ] );
			}

			// Hide default smart compare & smart wishlist button.
			add_filter( 'woosw_button_position_archive', '__return_false' );
			add_filter( 'woosw_button_position_single', '__return_false' );
			add_filter( 'woosc_button_position_archive', '__return_false' );
			add_filter( 'woosc_button_position_single', '__return_false' );

			// Change wishlist, compare button color on popup.
			add_filter( 'woosc_bar_btn_color_default', array( $this, 'change_compare_wishlist_button_color' ) );
			add_filter( 'woosw_color_default', array( $this, 'change_compare_wishlist_button_color' ) );

			// Add compare & wishlist button again.
			add_action( 'woocommerce_after_add_to_cart_button', array( $this, 'get_wishlist_button_template' ) );
			add_action( 'woocommerce_after_add_to_cart_button', array( $this, 'get_compare_button_template' ) );

			add_action( 'woocommerce_before_add_to_cart_quantity', array( $this, 'add_quantity_open_wrapper' ) );
			add_action( 'woocommerce_after_add_to_cart_quantity', array( $this, 'add_quantity_close_wrapper' ) );

			/*
			 * End hooks for single product
			 */

			/****** Hooks for cart page. ******/

			// Check for empty-cart get param to clear the cart.
			add_action( 'init', array( $this, 'woocommerce_clear_cart_url' ) );

			// Edit cart empty messages.
			remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10 );
			add_action( 'woocommerce_cart_is_empty', array( $this, 'change_empty_cart_messages' ), 10 );

			// Shortcode Product Infinity.
			add_action( 'wp_ajax_product_infinite_load', array( $this, 'product_infinite_load' ) );
			add_action( 'wp_ajax_nopriv_product_infinite_load', array( $this, 'product_infinite_load' ) );

			// Switch Shop Layout View.
			add_action( 'wp_ajax_shop_style_change', array( $this, 'shop_style_change' ) );
			add_action( 'wp_ajax_nopriv_shop_style_change', array( $this, 'shop_style_change' ) );

			add_action( 'after_setup_theme', array( $this, 'modify_theme_support' ), 10 );
		}

		/**
		 * Check woocommerce plugin active
		 *
		 * @return boolean true if plugin activated
		 */
		function is_activated() {
			if ( class_exists( 'WooCommerce' ) ) {
				return true;
			}

			return false;
		}


		function register_related_plugins( $plugins ) {
			$new_plugins = array(
				array(
					'name' => esc_html__( 'WPC Smart Compare for WooCommerce', 'mitech' ),
					'slug' => 'woo-smart-compare',
				),
				array(
					'name' => esc_html__( 'WPC Smart Wishlist for WooCommerce', 'mitech' ),
					'slug' => 'woo-smart-wishlist',
				),
			);

			$plugins = array_merge( $plugins, $new_plugins );

			return $plugins;
		}

		function woocommerce_clear_cart_url() {
			global $woocommerce;

			if ( isset( $_GET['empty-cart'] ) ) {
				$woocommerce->cart->empty_cart();
			}
		}

		function change_empty_cart_messages() {
			?>
			<div class="empty-cart-messages">
				<div class="empty-cart-icon">
					<span class="fal fa-shopping-cart"></span>
				</div>
				<h2 class="empty-cart-heading"><?php esc_html_e( 'Your cart is currently empty.', 'mitech' ); ?></h2>
				<p class="empty-cart-text"><?php esc_html_e( 'You may check out all the available products and buy some in the shop.', 'mitech' ); ?></p>
			</div>
			<?php
		}

		function add_quantity_open_wrapper() {
			?>
			<div class="quantity-button-wrapper">
			<label><?php esc_html_e( 'Quantity', 'mitech' ); ?></label>
			<?php
		}

		function add_quantity_close_wrapper() {
			global $product;

			echo wc_get_stock_html( $product ); // WPCS: XSS ok.
			?>
			</div>
			<?php
		}

		function add_sharing_in_product_meta() {
			if ( Mitech::setting( 'single_product_sharing_enable' ) === '1' ) :
				Mitech_Templates::product_sharing();
			endif;
		}

		/**
		 * Modify image width theme support.
		 */
		function modify_theme_support() {
			$theme_support                          = get_theme_support( 'woocommerce' );
			$theme_support                          = is_array( $theme_support ) ? $theme_support[0] : array();
			$theme_support['single_image_width']    = 760;
			$theme_support['thumbnail_image_width'] = 400;

			remove_theme_support( 'woocommerce' );
			add_theme_support( 'woocommerce', $theme_support );
		}

		/**
		 * Returns true if on a page which uses WooCommerce templates exclude single product (cart and checkout are standard pages with shortcodes and which are also included)
		 *
		 * @access public
		 * @return bool
		 */
		function is_woocommerce_page_without_product() {
			if ( function_exists( 'is_shop' ) && is_shop() ) {
				return true;
			}

			if ( function_exists( 'is_product_taxonomy' ) && is_product_taxonomy() ) {
				return true;
			}

			if ( is_post_type_archive( 'product' ) ) {
				return true;
			}

			$woocommerce_keys = array(
				"woocommerce_shop_page_id",
				"woocommerce_terms_page_id",
				"woocommerce_cart_page_id",
				"woocommerce_checkout_page_id",
				"woocommerce_pay_page_id",
				"woocommerce_thanks_page_id",
				"woocommerce_myaccount_page_id",
				"woocommerce_edit_address_page_id",
				"woocommerce_view_order_page_id",
				"woocommerce_change_password_page_id",
				"woocommerce_logout_page_id",
				"woocommerce_lost_password_page_id",
			);

			foreach ( $woocommerce_keys as $wc_page_id ) {
				if ( get_the_ID() == get_option( $wc_page_id, 0 ) ) {
					return true;
				}
			}

			return false;
		}

		/**
		 * Returns true if on a page which uses WooCommerce templates (cart and checkout are standard pages with shortcodes and which are also included)
		 *
		 * @access public
		 * @return bool
		 */
		function is_woocommerce_page() {
			if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
				return true;
			}

			$woocommerce_keys = array(
				"woocommerce_shop_page_id",
				"woocommerce_terms_page_id",
				"woocommerce_cart_page_id",
				"woocommerce_checkout_page_id",
				"woocommerce_pay_page_id",
				"woocommerce_thanks_page_id",
				"woocommerce_myaccount_page_id",
				"woocommerce_edit_address_page_id",
				"woocommerce_view_order_page_id",
				"woocommerce_change_password_page_id",
				"woocommerce_logout_page_id",
				"woocommerce_lost_password_page_id",
			);

			foreach ( $woocommerce_keys as $wc_page_id ) {
				if ( get_the_ID() == get_option( $wc_page_id, 0 ) ) {
					return true;
				}
			}

			return false;
		}

		/**
		 * Returns true if on a archive product pages.
		 *
		 * @access public
		 * @return bool
		 */
		function is_product_archive() {
			if ( is_post_type_archive( 'product' ) || ( function_exists( 'is_product_taxonomy' ) && is_product_taxonomy() ) ) {
				return true;
			}

			return false;
		}

		/**
		 * Custom product title instead of default product title
		 *
		 * @see woocommerce_template_loop_product_title()
		 */
		function template_loop_product_title() {
			?>
			<h2 class="woocommerce-loop-product__title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
			<?php
		}

		function loop_shop_per_page() {
			if ( isset( $_GET['shop_archive_number_item'] ) && $_GET['shop_archive_number_item'] !== '' ) {
				$number = $_GET['shop_archive_number_item'];
			} else {
				$number = Mitech::setting( 'shop_archive_number_item' );
			}

			return isset( $_GET['product_per_page'] ) ? wc_clean( $_GET['product_per_page'] ) : $number;
		}

		function override_pagination_args( $args ) {
			$args['prev_text'] = esc_html__( 'Prev', 'mitech' );
			$args['next_text'] = esc_html__( 'Next', 'mitech' );

			return $args;
		}

		function woocommerce_review_gravatar_size() {
			return 80;
		}

		function wp_init() {
			if ( Mitech::setting( 'single_product_up_sells_enable' ) === '0' ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
			}

			if ( Mitech::setting( 'single_product_related_enable' ) === '0' ) {
				// Clear the query arguments for related products so none show.
				add_filter( 'woocommerce_related_products_args', '__return_empty_array', 10 );
			}

			// Remove Cross Sells from default position at Cart. Then add them back UNDER the Cart Table.
			remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
			if ( Mitech::setting( 'shopping_cart_cross_sells_enable' ) === '1' ) {
				add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );
			}
		}

		function override_checkout_fields( $fields ) {
			$fields['billing']['billing_first_name']['placeholder'] = esc_attr__( 'First Name *', 'mitech' );
			$fields['billing']['billing_last_name']['placeholder']  = esc_attr__( 'Last Name *', 'mitech' );
			$fields['billing']['billing_company']['placeholder']    = esc_attr__( 'Company Name', 'mitech' );
			$fields['billing']['billing_email']['placeholder']      = esc_attr__( 'Email Address *', 'mitech' );
			$fields['billing']['billing_phone']['placeholder']      = esc_attr__( 'Phone *', 'mitech' );
			$fields['billing']['billing_address_1']['placeholder']  = esc_attr__( 'Address *', 'mitech' );
			$fields['billing']['billing_address_2']['placeholder']  = esc_attr__( 'Address', 'mitech' );
			$fields['billing']['billing_city']['placeholder']       = esc_attr__( 'Town / City *', 'mitech' );
			$fields['billing']['billing_postcode']['placeholder']   = esc_attr__( 'Zip *', 'mitech' );

			$fields['shipping']['shipping_first_name']['placeholder'] = esc_attr__( 'First Name *', 'mitech' );
			$fields['shipping']['shipping_last_name']['placeholder']  = esc_attr__( 'Last Name *', 'mitech' );
			$fields['shipping']['shipping_company']['placeholder']    = esc_attr__( 'Company Name', 'mitech' );
			$fields['shipping']['shipping_city']['placeholder']       = esc_attr__( 'Town / City *', 'mitech' );
			$fields['shipping']['shipping_postcode']['placeholder']   = esc_attr__( 'Zip *', 'mitech' );

			return $fields;
		}

		/**
		 * Ensure cart contents update when products are added to the cart via AJAX
		 * ========================================================================
		 *
		 * @param $fragments
		 *
		 * @return mixed
		 */
		function header_add_to_cart_fragment( $fragments ) {
			ob_start();
			$cart_html = $this->get_mini_cart();
			echo '' . $cart_html;
			$fragments['.mini-cart__button'] = ob_get_clean();

			return $fragments;
		}

		/**
		 * Get mini cart HTML
		 * ==================
		 *
		 * @return string
		 */
		function get_mini_cart() {
			$cart_html = '';
			$qty       = WC()->cart->get_cart_contents_count();
			$cart_html .= '<div class="mini-cart__button" title="' . esc_attr__( 'View your shopping cart', 'mitech' ) . '">';
			$cart_html .= '<span class="mini-cart-icon" data-count="' . $qty . '"></span>';
			$cart_html .= '</div>';

			return $cart_html;
		}

		function render_mini_cart() {
			$header_type = Mitech_Global::instance()->get_header_type();

			$enabled = Mitech::setting( "header_style_{$header_type}_cart_enable" );

			if ( $this->is_activated() && in_array( $enabled, array( '1', 'hide_on_empty' ) ) ) {
				global $woocommerce;
				$cart_url = '/cart';
				if ( isset( $woocommerce ) ) {
					$cart_url = wc_get_cart_url();
				}
				$classes = 'mini-cart';
				if ( $enabled === 'hide_on_empty' ) {
					$classes .= ' hide-on-empty';
				}
				?>
				<div id="mini-cart" class="<?php echo esc_attr( $classes ); ?>"
				     data-url="<?php echo esc_url( $cart_url ); ?>">
					<?php echo '' . $this->get_mini_cart(); ?>
					<div class="widget_shopping_cart_content"></div>
				</div>
			<?php }
		}

		/**
		 * @return string
		 */
		function get_percentage_price() {
			global $product;

			if ( $product->is_type( 'simple' ) || $product->is_type( 'external' ) ) {
				$_regular_price = $product->get_regular_price();
				$_sale_price    = $product->get_sale_price();

				$percentage = round( ( ( $_regular_price - $_sale_price ) / $_regular_price ) * 100 );

				return "-{$percentage}%";
			} else {
				return esc_html__( 'Sale', 'mitech' );
			}
		}

		function get_wishlist_button_template( $args = array() ) {
			if ( ( Mitech::setting( 'shop_archive_wishlist' ) !== '1' ) || ! class_exists( 'WPCleverWoosw' ) ) {
				return;
			}

			global $product;
			$product_id = $product->get_id();

			$defaults = array(
				'show_tooltip'     => true,
				'tooltip_position' => 'top',
				'style'            => '01',
			);
			$args     = wp_parse_args( $args, $defaults );

			$_wrapper_classes = "product-action wishlist-btn style-{$args['style']}";

			if ( $args['show_tooltip'] === true ) {
				$_wrapper_classes .= ' hint--rounded hint--bounce';
				$_wrapper_classes .= " hint--{$args['tooltip_position']}";
			}
			?>
			<div class="<?php echo esc_attr( $_wrapper_classes ); ?>"
			     aria-label="<?php esc_attr_e( 'Add to wishlist', 'mitech' ) ?>">
				<?php echo do_shortcode( '[woosw id="' . $product_id . '" type="link"]' ); ?>
			</div>
			<?php
		}

		function get_compare_button_template( $args = array() ) {
			if ( Mitech::setting( 'shop_archive_compare' ) !== '1' || wp_is_mobile() || ! class_exists( 'WPCleverWoosc' ) ) {
				return;
			}

			global $product;
			$product_id = $product->get_id();

			$defaults = array(
				'show_tooltip'     => true,
				'tooltip_position' => 'top',
				'style'            => '01',
			);
			$args     = wp_parse_args( $args, $defaults );

			$_wrapper_classes = "product-action compare-btn style-{$args['style']}";

			if ( $args['show_tooltip'] === true ) {
				$_wrapper_classes .= ' hint--rounded hint--bounce';
				$_wrapper_classes .= " hint--{$args['tooltip_position']}";
			}
			?>
			<div class="<?php echo esc_attr( $_wrapper_classes ); ?>"
			     aria-label="<?php esc_attr_e( 'Compare', 'mitech' ) ?>">
				<?php echo do_shortcode( '[woosc id="' . $product_id . '" type="link"]' ); ?>
			</div>
			<?php
		}

		public function change_compare_wishlist_button_color() {
			$primary_color = Mitech::setting( 'primary_color' );

			return $primary_color;
		}

		function get_quick_view_button_template( $args = array() ) {
			if ( ( Mitech::setting( 'shop_archive_quick_view' ) !== '1' ) || wp_is_mobile() ) {
				return;
			}

			global $product;
			$product_id = $product->get_id();

			$defaults = array(
				'show_tooltip'     => true,
				'tooltip_position' => 'top',
				'style'            => '01',
			);
			$args     = wp_parse_args( $args, $defaults );

			$_wrapper_classes = "product-action quick-view-btn style-{$args['style']}";

			if ( $args['show_tooltip'] === true ) {
				$_wrapper_classes .= ' hint--rounded hint--bounce';
				$_wrapper_classes .= " hint--{$args['tooltip_position']}";
			}
			?>
			<div class="<?php echo esc_attr( $_wrapper_classes ); ?>"
			     aria-label="<?php echo esc_attr__( 'Quick view', 'mitech' ) ?>"
			     data-pid="<?php echo esc_attr( $product_id ); ?>"
			     data-pnonce="<?php echo wp_create_nonce( 'woo_quick_view' ); ?>">
				<a class="quick-view-icon" href="#"></a>
			</div>
			<?php wc_get_template_part( 'content', 'quick-view' ); ?>
			<?php
		}

		public function product_infinite_load() {
			$args = array(
				'post_type'      => $_POST['post_type'],
				'posts_per_page' => $_POST['posts_per_page'],
				'orderby'        => $_POST['orderby'],
				'order'          => $_POST['order'],
				'paged'          => $_POST['paged'],
				'post_status'    => 'publish',
			);

			if ( ! empty( $_POST['taxonomies'] ) ) {
				$args = Mitech_VC::get_tax_query_of_taxonomies( $args, $_POST['taxonomies'] );
			}

			if ( in_array( $args['orderby'], array( 'meta_value', 'meta_value_num' ) ) ) {
				$args['meta_key'] = $_POST['meta_key'];
			}

			if ( isset( $_POST['minPrice'] ) && isset( $_POST['maxPrice'] ) ) {
				$args['meta_query'] = array(
					array(
						'key'     => '_price',
						'value'   => array( $_POST['minPrice'], $_POST['maxPrice'] ),
						'compare' => 'BETWEEN',
						'type'    => 'NUMERIC',
					),
				);
			}

			$style = 'grid';
			if ( isset( $_POST['style'] ) ) {
				$style = $_POST['style'];
			}

			$mitech_query = new WP_Query( $args );

			$response = array(
				'max_num_pages' => $mitech_query->max_num_pages,
				'found_posts'   => $mitech_query->found_posts,
				'count'         => $mitech_query->post_count,
			);

			ob_start();

			if ( $mitech_query->have_posts() ) :
				while ( $mitech_query->have_posts() ) : $mitech_query->the_post();
					wc_get_template_part( 'content', 'product' );
				endwhile;
			endif;
			wp_reset_postdata();

			$template = ob_get_contents();
			ob_clean();

			$response['template'] = $template;

			echo json_encode( $response );

			wp_die();
		}

		function change_woocommerce_image_dimensions() {
			global $pagenow;

			if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
				return;
			}

			// Update single image width
			update_option( 'woocommerce_single_image_width', 760 );

			// Update thumbnail image width
			update_option( 'woocommerce_thumbnail_image_width', 400 );

			// Update ratio
			update_option( 'woocommerce_thumbnail_cropping', 'custom' );
			update_option( 'woocommerce_thumbnail_cropping_custom_width', 3 );
			update_option( 'woocommerce_thumbnail_cropping_custom_height', 4 );
		}

		function get_product_image( $id, $class = '' ) {
			// Calculate product loop image size.
			if ( self::$product_image_size_width === '' ) {
				$width    = get_option( 'woocommerce_thumbnail_image_width' );
				$cropping = get_option( 'woocommerce_thumbnail_cropping' );
				$height   = $width;

				if ( $cropping === 'custom' ) {
					$ratio_w = get_option( 'woocommerce_thumbnail_cropping_custom_width' );
					$ratio_h = get_option( 'woocommerce_thumbnail_cropping_custom_height' );

					$height = ( $width * $ratio_h ) / $ratio_w;
					$height = (int) $height;
				} elseif ( $cropping === 'uncropped' ) {
					self::$product_image_crop = false;
					$height                   = 9999;
				}

				self::$product_image_size_width  = $width;
				self::$product_image_size_height = $height;
			}

			$args = array(
				'id'     => $id,
				'size'   => 'custom',
				'width'  => self::$product_image_size_width,
				'height' => self::$product_image_size_height,
				'crop'   => self::$product_image_crop,
			);

			if ( $class !== '' ) {
				$args['class'] = $class;
			}

			Mitech_Image::the_attachment_by_id( $args );
		}

		function remove_bracket_around_nav_count( $html, $count ) {
			return '<span class="count">' . absint( $count ) . '</span>';
		}

		function shop_style_change() {
			$layout = 'grid';

			if ( isset( $_POST['shop_style'] ) && $_POST['shop_style'] === 'list' ) {
				$layout = 'list';
			}

			setcookie( 'shop_style', $layout, time() + 365 * 86400, COOKIEPATH, COOKIE_DOMAIN );

			wp_die();
		}

		function get_shop_archive_style() {
			$layout = Mitech::setting( 'shop_archive_style' );

			if ( Mitech::setting( 'shop_archive_style_switcher' ) === '1' && isset( $_COOKIE['shop_style'] ) && $_COOKIE['shop_style'] !== '' ) {
				$layout = $_COOKIE['shop_style'];
			}

			return $layout;
		}

		public function admin_notice_minimum_compare_plugin_version() {
			mitech_notice_required_plugin_version( 'WPC Smart Compare for WooCommerce', self::MINIMUM_PLUGIN_VERSION );
		}
	}

	Mitech_Woo::instance()->init();
}
