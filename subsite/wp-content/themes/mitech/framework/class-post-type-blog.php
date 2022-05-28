<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Mitech_Post' ) ) {
	class Mitech_Post {

		protected static $instance  = null;
		protected static $post_type = 'post';

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function init() {
			add_action( 'wp_ajax_post_infinite_load', array( $this, 'infinite_load' ) );
			add_action( 'wp_ajax_nopriv_post_infinite_load', array( $this, 'infinite_load' ) );

			add_filter( 'post_class', array( $this, 'post_class' ) );
		}

		function post_class( $classes ) {
			if ( ! has_post_thumbnail() ) {
				$classes[] = 'post-no-thumbnail';
			}

			return $classes;
		}

		function infinite_load() {
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

			if ( ! empty( $_POST['extra_taxonomy'] ) ) {
				$args = Mitech_VC::get_tax_query_of_taxonomies( $args, $_POST['extra_taxonomy'] );
			}

			$style        = isset( $_POST['style'] ) ? $_POST['style'] : 'grid_classic_01';
			$metro_layout = isset( $_POST['metro_layout'] ) ? $_POST['metro_layout'] : '';

			$mitech_query = new WP_Query( $args );
			$count        = $mitech_query->post_count;

			$response = array(
				'max_num_pages' => $mitech_query->max_num_pages,
				'found_posts'   => $mitech_query->found_posts,
				'count'         => $mitech_query->post_count,
			);

			ob_start();

			if ( $mitech_query->have_posts() ) :

				set_query_var( 'mitech_query', $mitech_query );
				set_query_var( 'count', $count );
				set_query_var( 'metro_layout', $metro_layout );

				get_template_part( 'loop/shortcodes/blog/style', $style );

			endif;
			wp_reset_postdata();

			$template = ob_get_contents();
			ob_clean();

			$response['template'] = $template;

			echo json_encode( $response );

			wp_die();
		}

		function get_related_posts( $args ) {
			$defaults = array(
				'post_id'      => '',
				'number_posts' => 3,
			);
			$args     = wp_parse_args( $args, $defaults );
			if ( $args['number_posts'] <= 0 || $args['post_id'] === '' ) {
				return false;
			}

			$categories = get_the_category( $args['post_id'] );

			if ( ! $categories ) {
				return false;
			}

			foreach ( $categories as $category ) {
				if ( $category->parent === 0 ) {
					$term_ids[] = $category->term_id;
				} else {
					$term_ids[] = $category->parent;
					$term_ids[] = $category->term_id;
				}
			}

			// Remove duplicate values from the array.
			$unique_array = array_unique( $term_ids );

			$query_args = array(
				'post_type'      => self::$post_type,
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => $args['number_posts'],
				'post__not_in'   => array( $args['post_id'] ),
				'no_found_rows'  => true,
				'tax_query'      => array(
					array(
						'taxonomy'         => 'category',
						'terms'            => $unique_array,
						'include_children' => false,
					),
				),
			);

			$query = new WP_Query( $query_args );

			wp_reset_postdata();

			return $query;
		}

		function get_the_post_format() {
			$format = '';
			if ( get_post_format() !== false ) {
				$format = get_post_format();
			}

			return $format;
		}

		function nav_page_links() { ?>
			<div class="blog-nav-links">
				<div class="nav-list">
					<div class="nav-item prev">
						<div class="inner">
							<?php
							$prev_post      = get_previous_post();
							$prev_thumbnail = '';
							if ( ! empty( $prev_post ) ) {
								$prev_thumbnail = Mitech_Image::get_the_post_thumbnail_url( array(
									'post_id' => $prev_post->ID,
									'size'    => '370x120',
								) );

								$prev_thumbnail = 'style="background-image: url(' . $prev_thumbnail . ');"';
							}

							previous_post_link( '%link', '<div ' . $prev_thumbnail . '><h6>%title</h6></div>' );
							?>
						</div>
					</div>

					<div class="nav-item next">
						<div class="inner">
							<?php
							$next_post      = get_next_post();
							$next_thumbnail = '';
							if ( ! empty( $next_post ) ) {
								$next_thumbnail = Mitech_Image::get_the_post_thumbnail_url( array(
									'post_id' => $next_post->ID,
									'size'    => '370x120',
								) );

								$next_thumbnail = 'style="background-image: url(' . $next_thumbnail . ');"';
							}

							next_post_link( '%link', '<div ' . $next_thumbnail . '><h6>%title</h6></div>' );
							?>
						</div>
					</div>
				</div>
			</div>

			<?php
		}

		function view_count() {
			if ( function_exists( 'the_views' ) ) : ?>
				<div class="post-view">
					<i class="meta-icon far fa-eye"></i>
					<?php the_views(); ?>
				</div>
			<?php
			endif;
		}

		function post_sharing( $args = array() ) {
			if ( ! class_exists( 'InsightCore' ) ) {
				return;
			}

			$social_sharing = Mitech::setting( 'social_sharing_item_enable' );
			if ( ! empty( $social_sharing ) ) {
				?>
				<div class="post-share">
					<div class="share-label">
						<?php esc_html_e( 'Share this post', 'mitech' ); ?>
					</div>
					<div class="share-media">
						<span class="share-icon far fa-share-alt"></span>

						<div class="share-list">
							<?php Mitech_Templates::get_sharing_list( $args ); ?>
						</div>
					</div>
				</div>
				<?php
			}
		}
	}

	Mitech_Post::instance()->init();
}
