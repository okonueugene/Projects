<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Mitech_Widgets' ) ) {
	class Mitech_Widgets {

		public function __construct() {
			// Register widget areas.
			add_action( 'widgets_init', array(
				$this,
				'register_sidebars',
			) );

			add_filter( 'widget_title', array( $this, 'repair_categories_empty_title' ), 10, 3 );
		}

		public function repair_categories_empty_title( $title, $instance, $base ) {
			if ( $base == 'categories' ) {
				if ( trim( $instance['title'] ) == '' ) {
					return '';
				}
			}

			return $title;
		}

		/**
		 * Register widget area.
		 *
		 * @access public
		 * @link   https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		public function register_sidebars() {

			$classes = Mitech_Helper::get_animation_classes();

			$defaults = array(
				'before_widget' => '<div id="%1$s" class="' . esc_attr( 'widget %2$s ' . "{$classes}" ) . '">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			);

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'blog_sidebar',
				'name'        => esc_html__( 'Blog Sidebar', 'mitech' ),
				'description' => esc_html__( 'Add widgets here.', 'mitech' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'special_sidebar',
				'name'        => esc_html__( 'Special Sidebar', 'mitech' ),
				'description' => esc_html__( 'Special sidebar will be display right after first sidebar.', 'mitech' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'page_sidebar',
				'name'        => esc_html__( 'Page Sidebar', 'mitech' ),
				'description' => esc_html__( 'Add widgets here.', 'mitech' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'shop_sidebar',
				'name'        => esc_html__( 'Shop Sidebar', 'mitech' ),
				'description' => esc_html__( 'Add widgets here.', 'mitech' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'off_sidebar',
				'name'        => esc_html__( 'Off Sidebar', 'mitech' ),
				'description' => esc_html__( 'Add widgets here.', 'mitech' ),
			) ) );
		}
	}

	new Mitech_Widgets();
}
