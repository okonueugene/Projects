<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Mitech_Metabox' ) ) {
	class Mitech_Metabox {

		/**
		 * Mitech_Metabox constructor.
		 */
		public function __construct() {
			add_filter( 'insight_core_meta_boxes', array( $this, 'register_meta_boxes' ) );
		}

		/**
		 * Register Metabox
		 *
		 * @param $meta_boxes
		 *
		 * @return array
		 */
		public function register_meta_boxes( $meta_boxes ) {
			$page_registered_sidebars = Mitech_Helper::get_registered_sidebars( true );

			$general_options = array(
				array(
					'title'  => esc_attr__( 'Layout', 'mitech' ),
					'fields' => array(
						array(
							'id'      => 'site_layout',
							'type'    => 'select',
							'title'   => esc_html__( 'Layout', 'mitech' ),
							'desc'    => esc_html__( 'Controls the layout of this page.', 'mitech' ),
							'options' => array(
								''      => esc_attr__( 'Default', 'mitech' ),
								'boxed' => esc_attr__( 'Boxed', 'mitech' ),
								'wide'  => esc_attr__( 'Wide', 'mitech' ),
							),
							'default' => '',
						),
						array(
							'id'    => 'site_width',
							'type'  => 'text',
							'title' => esc_html__( 'Site Width', 'mitech' ),
							'desc'  => esc_html__( 'Controls the site width for this page. Enter value including any valid CSS unit. For e.g: 1200px. Leave blank to use global setting.', 'mitech' ),
						),
						array(
							'id'    => 'site_top_spacing',
							'type'  => 'text',
							'title' => esc_html__( 'Site Top Spacing', 'mitech' ),
							'desc'  => esc_html__( 'Controls the top spacing of this page. Enter value including any valid CSS unit. For e.g: 50px. Leave blank to use global setting.', 'mitech' ),
						),
						array(
							'id'    => 'site_bottom_spacing',
							'type'  => 'text',
							'title' => esc_html__( 'Site Bottom Spacing', 'mitech' ),
							'desc'  => esc_html__( 'Controls the bottom spacing of this page. Enter value including any valid CSS unit. For e.g: 50px. Leave blank to use global setting.', 'mitech' ),
						),
						array(
							'id'    => 'site_class',
							'type'  => 'text',
							'title' => esc_html__( 'Body Class', 'mitech' ),
							'desc'  => esc_html__( 'Add a class name to body then refer to it in custom CSS.', 'mitech' ),
						),
						array(
							'id'      => 'content_padding',
							'type'    => 'switch',
							'title'   => esc_attr__( 'Page Content Padding', 'mitech' ),
							'default' => '1',
							'options' => array(
								'0'      => esc_attr__( 'No Padding', 'mitech' ),
								'1'      => esc_attr__( 'Default', 'mitech' ),
								'top'    => esc_attr__( 'No Top Padding', 'mitech' ),
								'bottom' => esc_attr__( 'No Bottom Padding', 'mitech' ),
							),
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Background', 'mitech' ),
					'fields' => array(
						array(
							'id'      => 'site_background_message',
							'type'    => 'message',
							'title'   => esc_html__( 'Info', 'mitech' ),
							'message' => esc_html__( 'These options controls the background on boxed mode.', 'mitech' ),
						),
						array(
							'id'    => 'site_background_color',
							'type'  => 'color',
							'title' => esc_html__( 'Background Color', 'mitech' ),
							'desc'  => esc_html__( 'Controls the background color of the outer background area in boxed mode of this page.', 'mitech' ),
						),
						array(
							'id'    => 'site_background_image',
							'type'  => 'media',
							'title' => esc_html__( 'Background Image', 'mitech' ),
							'desc'  => esc_html__( 'Controls the background image of the outer background area in boxed mode of this page.', 'mitech' ),
						),
						array(
							'id'      => 'site_background_repeat',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Repeat', 'mitech' ),
							'desc'    => esc_html__( 'Controls the background repeat of the outer background area in boxed mode of this page.', 'mitech' ),
							'options' => array(
								'no-repeat' => esc_attr__( 'No repeat', 'mitech' ),
								'repeat'    => esc_attr__( 'Repeat', 'mitech' ),
								'repeat-x'  => esc_attr__( 'Repeat X', 'mitech' ),
								'repeat-y'  => esc_attr__( 'Repeat Y', 'mitech' ),
							),
						),
						array(
							'id'      => 'site_background_attachment',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Attachment', 'mitech' ),
							'desc'    => esc_html__( 'Controls the background attachment of the outer background area in boxed mode of this page.', 'mitech' ),
							'options' => array(
								''       => esc_attr__( 'Default', 'mitech' ),
								'fixed'  => esc_attr__( 'Fixed', 'mitech' ),
								'scroll' => esc_attr__( 'Scroll', 'mitech' ),
							),
						),
						array(
							'id'    => 'site_background_position',
							'type'  => 'text',
							'title' => esc_html__( 'Background Position', 'mitech' ),
							'desc'  => esc_html__( 'Controls the background position of the outer background area in boxed mode of this page.', 'mitech' ),
						),
						array(
							'id'    => 'site_background_size',
							'type'  => 'text',
							'title' => esc_html__( 'Background Size', 'mitech' ),
							'desc'  => esc_html__( 'Controls the background size of the outer background area in boxed mode of this page.', 'mitech' ),
						),
						array(
							'id'      => 'content_background_message',
							'type'    => 'message',
							'title'   => esc_html__( 'Info', 'mitech' ),
							'message' => esc_html__( 'These options controls the background of main content on this page.', 'mitech' ),
						),
						array(
							'id'    => 'content_background_color',
							'type'  => 'color',
							'title' => esc_html__( 'Background Color', 'mitech' ),
							'desc'  => esc_html__( 'Controls the background color of main content on this page.', 'mitech' ),
						),
						array(
							'id'    => 'content_background_image',
							'type'  => 'media',
							'title' => esc_html__( 'Background Image', 'mitech' ),
							'desc'  => esc_html__( 'Controls the background image of main content on this page.', 'mitech' ),
						),
						array(
							'id'      => 'content_background_repeat',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Repeat', 'mitech' ),
							'desc'    => esc_html__( 'Controls the background repeat of main content on this page.', 'mitech' ),
							'options' => array(
								'no-repeat' => esc_attr__( 'No repeat', 'mitech' ),
								'repeat'    => esc_attr__( 'Repeat', 'mitech' ),
								'repeat-x'  => esc_attr__( 'Repeat X', 'mitech' ),
								'repeat-y'  => esc_attr__( 'Repeat Y', 'mitech' ),
							),
						),
						array(
							'id'    => 'content_background_position',
							'type'  => 'text',
							'title' => esc_html__( 'Background Position', 'mitech' ),
							'desc'  => esc_html__( 'Controls the background position of main content on this page.', 'mitech' ),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Header', 'mitech' ),
					'fields' => array(
						array(
							'id'      => 'top_bar_type',
							'type'    => 'select',
							'title'   => esc_html__( 'Top Bar Type', 'mitech' ),
							'desc'    => esc_html__( 'Select top bar type that displays on this page.', 'mitech' ),
							'default' => '',
							'options' => Mitech_Helper::get_top_bar_list( true ),
						),
						array(
							'id'      => 'header_type',
							'type'    => 'select',
							'title'   => esc_attr__( 'Header Type', 'mitech' ),
							'desc'    => wp_kses(
								sprintf(
									__( 'Select header type that displays on this page. When you choose Default, the value in %s will be used.', 'mitech' ),
									'<a href="' . admin_url( '/customize.php?autofocus[section]=header' ) . '">Customize</a>'
								), 'mitech-a' ),
							'default' => '',
							'options' => Mitech_Helper::get_header_list( true ),
						),
						array(
							'id'      => 'menu_display',
							'type'    => 'select',
							'title'   => esc_html__( 'Primary menu', 'mitech' ),
							'desc'    => esc_html__( 'Select which menu displays on this page.', 'mitech' ),
							'default' => '',
							'options' => Mitech_Nav_Menu::get_all_menus(),
						),
						array(
							'id'      => 'menu_one_page',
							'type'    => 'switch',
							'title'   => esc_attr__( 'One Page Menu', 'mitech' ),
							'default' => '0',
							'options' => array(
								'0' => esc_attr__( 'Disable', 'mitech' ),
								'1' => esc_attr__( 'Enable', 'mitech' ),
							),
						),
						array(
							'id'      => 'custom_logo',
							'type'    => 'media',
							'title'   => esc_html__( 'Custom Logo', 'mitech' ),
							'desc'    => esc_html__( 'Select custom logo for this page.', 'mitech' ),
							'default' => '',
						),
						array(
							'id'      => 'custom_logo_width',
							'type'    => 'text',
							'title'   => esc_html__( 'Custom Logo Width', 'mitech' ),
							'desc'    => esc_html__( 'Controls the width of logo. For e.g: 150px', 'mitech' ),
							'default' => '',
						),
						array(
							'id'      => 'custom_sticky_logo_width',
							'type'    => 'text',
							'title'   => esc_html__( 'Custom Sticky Logo Width', 'mitech' ),
							'desc'    => esc_html__( 'Controls the width of sticky logo. For e.g: 150px', 'mitech' ),
							'default' => '',
						),
					),
				),
				array(
					'title'  => esc_html__( 'Page Title Bar', 'mitech' ),
					'fields' => array(
						array(
							'id'      => 'page_title_bar_layout',
							'type'    => 'select',
							'title'   => esc_html__( 'Layout', 'mitech' ),
							'default' => '',
							'options' => Mitech_Helper::get_title_bar_list( true ),
						),
						array(
							'id'      => 'page_title_bar_background_color',
							'type'    => 'color',
							'title'   => esc_html__( 'Background Color', 'mitech' ),
							'default' => '',
						),
						array(
							'id'      => 'page_title_bar_background',
							'type'    => 'media',
							'title'   => esc_html__( 'Background Image', 'mitech' ),
							'default' => '',
						),
						array(
							'id'      => 'page_title_bar_background_overlay',
							'type'    => 'color',
							'title'   => esc_html__( 'Background Overlay', 'mitech' ),
							'default' => '',
						),
						array(
							'id'    => 'page_title_bar_custom_heading',
							'type'  => 'text',
							'title' => esc_html__( 'Custom Heading Text', 'mitech' ),
							'desc'  => esc_html__( 'Insert custom heading for the page title bar. Leave blank to use default.', 'mitech' ),
						),
						array(
							'id'    => 'page_title_bar_custom_sub_title',
							'type'  => 'text',
							'title' => esc_html__( 'Custom Sub Title', 'mitech' ),
							'desc'  => esc_html__( 'Insert custom Sub Title for the page title bar. Leave blank to use default.', 'mitech' ),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Sidebars', 'mitech' ),
					'fields' => array(
						array(
							'id'      => 'page_sidebar_1',
							'type'    => 'select',
							'title'   => esc_html__( 'Sidebar 1', 'mitech' ),
							'desc'    => esc_html__( 'Select sidebar 1 that will display on this page.', 'mitech' ),
							'default' => 'default',
							'options' => $page_registered_sidebars,
						),
						array(
							'id'      => 'page_sidebar_2',
							'type'    => 'select',
							'title'   => esc_html__( 'Sidebar 2', 'mitech' ),
							'desc'    => esc_html__( 'Select sidebar 2 that will display on this page.', 'mitech' ),
							'default' => 'default',
							'options' => $page_registered_sidebars,
						),
						array(
							'id'      => 'page_sidebar_position',
							'type'    => 'switch',
							'title'   => esc_html__( 'Sidebar Position', 'mitech' ),
							'desc'    => wp_kses(
								sprintf(
									__( 'Select position of Sidebar 1 for this page. If sidebar 2 is selected, it will display on the opposite side. If you set as "Default" then the value in %s will be used.', 'mitech' ),
									'<a href="' . admin_url( '/customize.php?autofocus[section]=sidebars' ) . '">Customize -> Sidebar</a>'
								), 'mitech-a' ),
							'default' => 'default',
							'options' => Mitech_Helper::get_list_sidebar_positions( true ),
						),
						array(
							'id'      => 'page_sidebar_special',
							'type'    => 'select',
							'title'   => esc_html__( 'Sidebar Special', 'mitech' ),
							'desc'    => esc_html__( 'Select sidebar special that will display on this page.', 'mitech' ),
							'default' => 'default',
							'options' => $page_registered_sidebars,
						),
					),
				),
				array(
					'title'  => esc_html__( 'Sliders', 'mitech' ),
					'fields' => array(
						array(
							'id'      => 'revolution_slider',
							'type'    => 'select',
							'title'   => esc_html__( 'Revolution Slider', 'mitech' ),
							'desc'    => esc_html__( 'Select the unique name of the slider.', 'mitech' ),
							'options' => Mitech_Helper::get_list_revslider(),
						),
						array(
							'id'      => 'slider_position',
							'type'    => 'select',
							'title'   => esc_html__( 'Slider Position', 'mitech' ),
							'default' => 'below',
							'options' => array(
								'above' => esc_attr__( 'Above Header', 'mitech' ),
								'below' => esc_attr__( 'Below Header', 'mitech' ),
							),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Footer', 'mitech' ),
					'fields' => array(
						array(
							'id'      => 'footer_page',
							'type'    => 'select',
							'title'   => esc_html__( 'Footer Page', 'mitech' ),
							'default' => '',
							'options' => Mitech_Footer::instance()->get_list_footers( true ),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Page Template', 'mitech' ),
					'fields' => array(
						array(
							'id'      => 'one_page_scroll_message',
							'type'    => 'message',
							'title'   => esc_html__( 'Info', 'mitech' ),
							'message' => esc_html__( 'All below options working on page with Template is "One Page Scroll".', 'mitech' ),
						),
						array(
							'id'      => 'one_page_scroll_nav_enable',
							'type'    => 'switch',
							'title'   => esc_html__( 'Navigation Display', 'mitech' ),
							'default' => '1',
							'options' => array(
								'0' => esc_html__( 'None', 'mitech' ),
								'1' => esc_html__( 'Yes', 'mitech' ),
							),
						),
						array(
							'id'      => 'one_page_scroll_effect',
							'type'    => 'select',
							'title'   => esc_html__( 'Scroll Effect', 'mitech' ),
							'default' => '1',
							'options' => array(
								'1' => esc_attr__( 'Slide', 'mitech' ),
								'2' => esc_attr__( 'Scale Up', 'mitech' ),
								'3' => esc_attr__( 'Cube', 'mitech' ),
							),
						),
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_page_options',
				'title'      => esc_html__( 'Page Options', 'mitech' ),
				'post_types' => array( 'page' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => $general_options,
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_post_options',
				'title'      => esc_html__( 'Page Options', 'mitech' ),
				'post_types' => array( 'post' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array_merge( array(
							array(
								'title'  => esc_html__( 'Post', 'mitech' ),
								'fields' => array(
									array(
										'id'    => 'post_gallery',
										'type'  => 'gallery',
										'title' => esc_html__( 'Gallery Format', 'mitech' ),
									),
									array(
										'id'    => 'post_video',
										'type'  => 'text',
										'title' => esc_html__( 'Video URL', 'mitech' ),
										'desc'  => esc_html__( 'Input the url of video vimeo or youtube. For e.g: https://www.youtube.com/watch?v=9No-FiEInLA', 'mitech' ),
									),
									array(
										'id'    => 'post_audio',
										'type'  => 'textarea',
										'title' => esc_html__( 'Audio Format', 'mitech' ),
									),
									array(
										'id'    => 'post_quote_text',
										'type'  => 'text',
										'title' => esc_html__( 'Quote Format - Source Text', 'mitech' ),
									),
									array(
										'id'    => 'post_quote_name',
										'type'  => 'text',
										'title' => esc_html__( 'Quote Format - Source Name', 'mitech' ),
									),
									array(
										'id'    => 'post_quote_url',
										'type'  => 'text',
										'title' => esc_html__( 'Quote Format - Source Url', 'mitech' ),
									),
									array(
										'id'    => 'post_link',
										'type'  => 'text',
										'title' => esc_html__( 'Link Format', 'mitech' ),
									),
								),
							),
						), $general_options ),
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_product_options',
				'title'      => esc_html__( 'Page Options', 'mitech' ),
				'post_types' => array( 'product' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => $general_options,
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_case_study_options',
				'title'      => esc_html__( 'Page Options', 'mitech' ),
				'post_types' => array( 'case_study' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array_merge( array(
							array(
								'title'  => esc_html__( 'Case Study', 'mitech' ),
								'fields' => array(
									array(
										'id'      => 'case_study_layout_style',
										'type'    => 'select',
										'title'   => esc_html__( 'Single Case Study Style', 'mitech' ),
										'desc'    => esc_html__( 'Select style of this single case study post page.', 'mitech' ),
										'default' => '',
										'options' => array(
											''                 => esc_html__( 'Default', 'mitech' ),
											'blank'            => esc_html__( 'Blank (Build with Visual Composer)', 'mitech' ),
											'image_list'       => esc_html__( 'Image List', 'mitech' ),
											'image_slider'     => esc_html__( 'Image Slider', 'mitech' ),
											'image_grid'       => esc_html__( 'Image Grid', 'mitech' ),
											'big_image_slider' => esc_html__( 'Big Image Slider', 'mitech' ),
										),
									),
									array(
										'id'    => 'case_study_gallery',
										'type'  => 'gallery',
										'title' => esc_html__( 'Gallery', 'mitech' ),
									),
									array(
										'id'    => 'case_study_video_url',
										'type'  => 'text',
										'title' => esc_html__( 'Video URL', 'mitech' ),
										'desc'  => esc_html__( 'Input the url of video vimeo or youtube. For e.g: https://www.youtube.com/watch?v=9No-FiEInLA', 'mitech' ),
									),
									array(
										'id'    => 'case_study_url',
										'type'  => 'text',
										'title' => esc_html__( 'Url', 'mitech' ),
									),
									array(
										'id'    => 'case_study_client',
										'type'  => 'text',
										'title' => esc_html__( 'Client', 'mitech' ),
									),
									array(
										'id'    => 'case_study_date',
										'type'  => 'text',
										'title' => esc_html__( 'Date', 'mitech' ),
									),
									array(
										'id'    => 'case_study_awards',
										'type'  => 'editor',
										'title' => esc_html__( 'Awards', 'mitech' ),
									),
								),
							),
						), $general_options ),
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_testimonial_options',
				'title'      => esc_html__( 'Testimonial Options', 'mitech' ),
				'post_types' => array( 'testimonial' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array(
							array(
								'title'  => esc_html__( 'Testimonial Details', 'mitech' ),
								'fields' => array(
									array(
										'id'      => 'subject',
										'type'    => 'text',
										'title'   => esc_html__( 'Subject', 'mitech' ),
										'default' => '',
									),
									array(
										'id'      => 'by_line',
										'type'    => 'text',
										'title'   => esc_html__( 'By Line', 'mitech' ),
										'desc'    => esc_html__( 'Enter a byline for the customer giving this testimonial (for example: "CEO of Thememove").', 'mitech' ),
										'default' => '',
									),
									array(
										'id'      => 'url',
										'type'    => 'text',
										'title'   => esc_html__( 'Url', 'mitech' ),
										'desc'    => esc_html__( 'Enter a URL that applies to this customer (for example: https://www.thememove.com/).', 'mitech' ),
										'default' => '',
									),
									array(
										'id'      => 'rating',
										'type'    => 'select',
										'title'   => esc_attr__( 'Rating', 'mitech' ),
										'default' => '',
										'options' => array(
											''  => esc_attr__( 'Select a rating', 'mitech' ),
											'1' => esc_attr__( '1 Star', 'mitech' ),
											'2' => esc_attr__( '2 Stars', 'mitech' ),
											'3' => esc_attr__( '3 Stars', 'mitech' ),
											'4' => esc_attr__( '4 Stars', 'mitech' ),
											'5' => esc_attr__( '5 Stars', 'mitech' ),
										),
									),
								),
							),
						),
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_footer_options',
				'title'      => esc_html__( 'Footer Options', 'mitech' ),
				'post_types' => array( 'ic_footer' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array(
							array(
								'title'  => esc_html__( 'Effect', 'mitech' ),
								'fields' => array(
									array(
										'id'      => 'effect',
										'type'    => 'switch',
										'title'   => esc_html__( 'Footer Effect', 'mitech' ),
										'desc'    => esc_html__( 'Do not apply these special effects for footer with large height.', 'mitech' ),
										'default' => '',
										'options' => array(
											''         => esc_attr__( 'Normal', 'mitech' ),
											'parallax' => esc_attr__( 'Parallax', 'mitech' ),
											'fixed'    => esc_attr__( 'Fixed', 'mitech' ),
											'overlay'  => esc_attr__( 'Overlay', 'mitech' ),
										),
									),
								),
							),
						),
					),
				),
			);

			return $meta_boxes;
		}

	}

	new Mitech_Metabox();
}
