<?php
defined( 'ABSPATH' ) || exit;

class Mitech_VC_Templates {

	protected static $instance = null;

	protected $template_count = 0;

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function init() {
		if ( ! class_exists( 'Vc_Manager' ) ) {
			return;
		}

		// Move item to first.
		add_filter( 'vc_get_all_templates', array( $this, 'add_theme_templates' ), 99 );

		add_filter( 'vc_templates_render_category', array( $this, 'render_template_block' ), 20 );

		add_filter( 'vc_load_default_templates', '__return_empty_array' ); // Hook in

		add_action( 'vc_load_default_templates_action', array( $this, 'custom_studio_templates_for_vc' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	public function enqueue_scripts() {
		if ( ! function_exists( 'get_current_screen' ) ) {
			return;
		}

		$screen = get_current_screen();

		if ( $screen->base !== 'post' ) {
			return;
		}

		wp_enqueue_script( 'vc-defaults-template', MITECH_THEME_URI . '/assets/admin/js/vc-defaults-template.js', array( 'jquery' ), null, true );
	}

	public function add_theme_templates( $data ) {
		foreach ( $data as $key => $template ) {
			if ( $template['category'] === 'default_templates' ) {
				$data[ $key ]['category_weight'] = 5;
				$data[ $key ]['category_name']   = esc_html__( 'Mitech Studio', 'mitech' );
			}
		}

		return $data;
	}

	public function render_template_block( $category ) {
		if ( 'default_templates' === $category['category'] ) {
			$category['output'] = '';

			if ( esc_attr( $category['category'] ) == 'default_templates' ) {
				$cats = $this->default_templates_categories();

				$category['output'] .= '<div class="library_categories"><ul>';

				foreach ( $cats as $cat_name => $cat_sort_text ) {
					$category['output'] .= '<li data-sort="' . $cat_name . '">' . $cat_sort_text . ' <span class="count">0</span></li>';
				}

				$category['output'] .= '</ul></div>';
			}

			$category['output'] .= '<div class="vc_col-md-12">';
			if ( isset( $category['category_name'] ) ) {
				$category['output'] .= '<h3>' . esc_html( $category['category_name'] ) . '</h3>';
			}
			if ( isset( $category['category_description'] ) ) {
				$category['output'] .= '<p class="vc_description">' . esc_html( $category['category_description'] ) . '</p>';
			}
			$category['output'] .= '</div>';
			$category['output'] .= '
				<div class="vc_column vc_col-sm-12">
					<div class="vc_ui-template-list vc_templates-list-default_templates vc_ui-list-bar" data-vc-action="collapseAll">';
			if ( ! empty( $category['templates'] ) ) {
				foreach ( $category['templates'] as $template ) {
					$category['output'] .= $this->render_template_list_item( $template );
				}
			}
			$category['output'] .= '
				</div>
			</div>';

		}

		return $category;
	}

	public function render_template_list_item( $template ) {
		$name                = isset( $template['name'] ) ? esc_html( $template['name'] ) : esc_html__( 'No title', 'mitech' );
		$template_id         = esc_attr( $template['unique_id'] );
		$template_id_hash    = md5( $template_id ); // needed for jquery target for TTA
		$template_name       = esc_html( $name );
		$template_name_lower = esc_attr( vc_slugify( $template_name ) );
		$template_type       = esc_attr( isset( $template['type'] ) ? $template['type'] : 'custom' );
		$custom_class        = isset( $template['custom_class'] ) ? $template['custom_class'] : '';

		$cat_display_name = $custom_class;

		if ( $cat_display_name !== '' ) {
			$cat_display_name = str_replace( ' ', ', ', $cat_display_name );
			$cat_display_name = str_replace( '_', ' ', $cat_display_name );
		}

		// Adding in preview img.
		$preview_img = esc_attr( isset( $template['image'] ) && $template['image'] != '' ? $template['image'] : get_template_directory_uri() . '/assets/admin/images/vc-templates/no-img.jpg' );

		$output = <<<HTML
					<div class="vc_ui-template vc_templates-template-type-$template_type $custom_class"
						data-template_id="$template_id"
						data-template_id_hash="$template_id_hash"
						data-category="$template_type"
						data-template_unique_id="$template_id"
						data-template_name="$template_name_lower"
						data-template_type="$template_type"
						data-vc-content=".vc_ui-template-content">
						<div class="vc_ui-list-bar-item">
HTML;

		if ( ! empty( $preview_img ) && $template_type == 'default_templates' ) {
			//lazy load images out of view
			if ( $this->template_count > 6 ) {
				$output .= '<div class="img-wrap"><img data-src="' . $preview_img . '" alt="' . $name . '" width="300" height="200" /></div><div class="display_cat">' . $cat_display_name . '</div>';
			} else {
				$output .= '<div class="img-wrap"><img src="' . $preview_img . '" alt="' . $name . '" width="300" height="200" /></div><div class="display_cat">' . $cat_display_name . '</div>';
			}

		}
		$output .= apply_filters( 'vc_templates_render_template', $name, $template );
		$output .= <<<HTML
						</div>
						<div class="vc_ui-template-content" data-js-content>
						</div>
					</div>
HTML;

		$this->template_count++;

		// End

		return $output;
	}

	public function default_templates_categories() {
		$results = array(
			'all'            => esc_html__( 'All', 'mitech' ),
			'about'          => esc_html__( 'About', 'mitech' ),
			'blog'           => esc_html__( 'Blog', 'mitech' ),
			'call_to_action' => esc_html__( 'Call To Action', 'mitech' ),
			'counters'       => esc_html__( 'Counters', 'mitech' ),
			'clients'        => esc_html__( 'Clients', 'mitech' ),
			'features'       => esc_html__( 'Features', 'mitech' ),
			'services'       => esc_html__( 'Services', 'mitech' ),
			'team'           => esc_html__( 'Team', 'mitech' ),
			'testimonials'   => esc_html__( 'Testimonials', 'mitech' ),
			'shop'           => esc_html__( 'Shop', 'mitech' ),
		);

		return $results;
	}

	public function custom_studio_templates_for_vc() {
		$template_image_dir = get_template_directory_uri() . '/assets/admin/images/vc-templates';

		$data = array(

			array(
				'name'         => esc_html__( 'About', 'mitech' ),
				'custom_class' => 'about',
				'image_path'   => $template_image_dir . '/about-01.jpg',
				'content'      => <<<CONTENT
[vc_row el_id="section-about"][vc_column][tm_spacer size="lg:106"][tm_heading custom_google_font="" align="center" font_size="xs:30;sm:36;md:42;lg:48" line_height="1.34"]Expand Your Business[/tm_heading][tm_spacer size="lg:10"][tm_heading tag="div" custom_google_font="" align="center"]Plan ahead to make progress and lead the trend.[/tm_heading][tm_spacer size="lg:70"][tm_grid style="short-separator" columns="xs:1;sm:1;lg:3" row_gutter="lg:40" column_gutter="lg:30"][tm_box_image style="03" align="center" image="12" heading="Social media boost" box_link="url:%23|title:Social%20media%20boost||"][tm_box_image style="03" align="center" image="11" heading="In-depth research analysis" box_link="url:%23|title:In-depth%20research%20analysis||"][tm_box_image style="03" align="center" image="10" heading="Scientifically proven progress" box_link="url:%23|title:Scientifically%20proven%20progress||"][/tm_grid][tm_spacer size="lg:120"][/vc_column][/vc_row]
CONTENT
			),
			array(
				'name'         => esc_html__( 'Clients Logo', 'mitech' ),
				'custom_class' => 'clients',
				'image_path'   => $template_image_dir . '/client-logo-01.jpg',
				'content'      => <<<CONTENT
[vc_row el_id="section-partners"][vc_column][tm_spacer size="lg:100"][tm_heading custom_google_font="" align="center" font_size="xs:30;sm:36;md:42;lg:48" line_height="1.34"]Trusted services from top-rated company[/tm_heading][tm_spacer size="lg:7"][tm_heading tag="div" custom_google_font="" align="center" line_height="2.14" max_width="560px"]It is about us being able to offer help with the branding campaign, product presentation, and advertisement running across social media. [/tm_heading][tm_spacer size="lg:84"][tm_client style="grid" gutter="30" columns="xs:2;sm:3;md:4;lg:6" items="%5B%7B%22image%22%3A%2239%22%2C%22image_hover%22%3A%2233%22%2C%22link%22%3A%22%7C%7C%7C%22%7D%2C%7B%22image%22%3A%2238%22%2C%22image_hover%22%3A%2232%22%2C%22link%22%3A%22%7C%7C%7C%22%7D%2C%7B%22image%22%3A%2237%22%2C%22image_hover%22%3A%2231%22%2C%22link%22%3A%22%7C%7C%7C%22%7D%2C%7B%22image%22%3A%2236%22%2C%22image_hover%22%3A%2230%22%2C%22link%22%3A%22%7C%7C%7C%22%7D%2C%7B%22image%22%3A%2235%22%2C%22image_hover%22%3A%2229%22%2C%22link%22%3A%22%7C%7C%7C%22%7D%2C%7B%22image%22%3A%2234%22%2C%22image_hover%22%3A%2228%22%2C%22link%22%3A%22%7C%7C%7C%22%7D%2C%7B%22image%22%3A%2246%22%2C%22image_hover%22%3A%2253%22%2C%22link%22%3A%22%7C%7C%7C%22%7D%2C%7B%22image%22%3A%2245%22%2C%22image_hover%22%3A%2252%22%2C%22link%22%3A%22%7C%7C%7C%22%7D%2C%7B%22image%22%3A%2244%22%2C%22image_hover%22%3A%2251%22%2C%22link%22%3A%22%7C%7C%7C%22%7D%2C%7B%22image%22%3A%2243%22%2C%22image_hover%22%3A%2250%22%2C%22link%22%3A%22%7C%7C%7C%22%7D%2C%7B%22image%22%3A%2242%22%2C%22image_hover%22%3A%2249%22%2C%22link%22%3A%22%7C%7C%7C%22%7D%2C%7B%22image%22%3A%2241%22%2C%22image_hover%22%3A%2248%22%2C%22link%22%3A%22%7C%7C%7C%22%7D%5D"][tm_spacer size="lg:100"][/vc_column][/vc_row]
CONTENT
			),
			array(
				'name'         => esc_html__( 'Subscribe', 'mitech' ),
				'custom_class' => 'about',
				'image_path'   => $template_image_dir . '/subscribe-01.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row" background_color="gradient" background_gradient="background: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxkZWZzPjxsaW5lYXJHcmFkaWVudCBpZD0iZ3JhZGllbnQiIHgxPSIwJSIgeTE9IjAlIiB4Mj0iMCUiIHkyPSIxMDAlIj48c3RvcCBvZmZzZXQ9IjAlIiBzdHlsZT0ic3RvcC1jb2xvcjojNUU2MEU3OyIgLz48c3RvcCBvZmZzZXQ9IjY1JSIgc3R5bGU9InN0b3AtY29sb3I6IzlDN0FGMjsiIC8+PC9saW5lYXJHcmFkaWVudD48L2RlZnM+PHJlY3QgZmlsbD0idXJsKCNncmFkaWVudCkiIGhlaWdodD0iMTAwJSIgd2lkdGg9IjEwMCUiIC8+PC9zdmc+);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #5E60E7), color-stop(65%, #9C7AF2));background: -moz-linear-gradient(-259deg,#5E60E7 0%,#9C7AF2 65%);background: -webkit-linear-gradient(-259deg,#5E60E7 0%,#9C7AF2 65%);background: -o-linear-gradient(-259deg,#5E60E7 0%,#9C7AF2 65%);background: -ms-linear-gradient(-259deg,#5E60E7 0%,#9C7AF2 65%);background: linear-gradient(-259deg,#5E60E7 0%,#9C7AF2 65%);"][vc_column][tm_spacer size="lg:103"][tm_heading custom_google_font="" align="center" text_color="custom" custom_text_color="#ffffff" font_size="sm:28;md:34;lg:40" line_height="1.4"]493 businesses signed up<br />last week. Join them![/tm_heading][tm_spacer size="lg:45"][tm_mailchimp_form style="02" button_bg_color="" font_color="" button_border_color="" button_icon_color="" button_bg_color_hover="" font_color_hover="" button_border_color_hover=""][tm_spacer size="lg:44"][tm_heading style="link-style-01" custom_google_font="" align="center" text_color="custom" custom_text_color="#ffffff"]What's next in Mitech? <a href="#">Learn more</a>[/tm_heading][tm_spacer size="lg:98"][/vc_column][/vc_row]
CONTENT
			),
		);

		foreach ($data as $test ) {
			vc_add_default_templates( $test );
		}
	}
}

Mitech_VC_Templates::instance()->init();
