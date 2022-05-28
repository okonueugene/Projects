<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Mitech_Case_Study' ) ) {
	class Mitech_Case_Study {

		protected static $instance  = null;
		protected static $post_type = 'case_study';
		protected static $tag       = 'case_study_tags';
		protected static $category  = 'case_study_category';


		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function init() {
			add_action( 'wp_ajax_case_study_infinite_load', array( $this, 'infinite_load' ) );
			add_action( 'wp_ajax_nopriv_case_study_infinite_load', array( $this, 'infinite_load' ) );

			add_action( 'pre_get_posts', array( $this, 'change_post_per_page' ) );
		}

		/**
		 * @param WP_Query $query Query instance.
		 */
		function change_post_per_page( $query ) {
			if ( $query->is_main_query() && ! is_admin() && $this->is_archive() ) {

				$number = Mitech::setting( 'archive_case_study_number_items' );

				if ( $number === '' ) {
					$number = get_option( 'posts_per_page' );
				}

				$query->set( 'posts_per_page', $number );
			}
		}

		function get_categories( $args = array() ) {
			$defaults = array(
				'all' => true,
			);
			$args     = wp_parse_args( $args, $defaults );
			$terms    = get_terms( array(
				'taxonomy' => self::$category,
			) );
			$results  = array();

			if ( $args['all'] === true ) {
				$results['-1'] = esc_html__( 'All', 'mitech' );
			}

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$results[ $term->slug ] = $term->name;
				}
			}

			return $results;
		}

		function get_tags( $args = array() ) {
			$defaults = array(
				'all' => true,
			);
			$args     = wp_parse_args( $args, $defaults );
			$terms    = get_terms( array(
				'taxonomy' => self::$tag,
			) );
			$results  = array();

			if ( $args['all'] === true ) {
				$results['-1'] = esc_html__( 'All', 'mitech' );
			}

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$results[ $term->slug ] = $term->name;
				}
			}

			return $results;
		}

		function get_related_items( $args ) {
			$defaults = array(
				'post_id'      => '',
				'number_posts' => 3,
			);
			$args     = wp_parse_args( $args, $defaults );
			if ( $args['number_posts'] <= 0 || $args['post_id'] === '' ) {
				return false;
			}
			$query_args              = array(
				'post_type'      => self::$post_type,
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => $args['number_posts'],
				'post__not_in'   => array( $args['post_id'] ),
				'no_found_rows'  => true,
			);
			$related_by              = Mitech::setting( 'case_study_related_by' );
			$query_args['tax_query'] = array();
			if ( ! empty( $related_by ) ) {
				foreach ( $related_by as $tax ) {
					$terms = get_the_terms( $args['post_id'], $tax );
					if ( $terms && ! is_wp_error( $terms ) ) {
						$term_ids = array();
						foreach ( $terms as $term ) {
							$term_ids[] = $term->term_id;
						}
						$query_args['tax_query'][] = array(
							'terms'    => $term_ids,
							'taxonomy' => $tax,
						);
					}
				}
				if ( count( $query_args['tax_query'] ) > 1 ) {
					$query_args['tax_query']['relation'] = 'OR';
				}
			}

			$query = new WP_Query( $query_args );

			wp_reset_postdata();

			return $query;
		}

		function get_latest_items( $args ) {
			$defaults = array(
				'number_posts' => 3,
			);
			$args     = wp_parse_args( $args, $defaults );
			if ( $args['number_posts'] <= 0 ) {
				return false;
			}

			$query_args = array(
				'post_type'           => self::$post_type,
				'orderby'             => 'date',
				'order'               => 'DESC',
				'ignore_sticky_posts' => 0,
				'meta_key'            => '_thumbnail_id',
				'posts_per_page'      => $args['number_posts'],
				'no_found_rows'       => true,
			);

			$query = new WP_Query( $query_args );

			wp_reset_postdata();

			return $query;
		}

		public function infinite_load() {
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

			$style              = isset( $_POST['style'] ) ? $_POST['style'] : 'grid';
			$image_size         = isset( $_POST['image_size'] ) ? $_POST['image_size'] : '';
			$overlay_style      = isset( $_POST['overlay_style'] ) ? $_POST['overlay_style'] : '';
			$caption_style      = isset( $_POST['caption_style'] ) ? $_POST['caption_style'] : '';
			$enable_popup_video = isset( $_POST['enable_popup_video'] ) ? $_POST['enable_popup_video'] : '';
			$metro_layout       = isset( $_POST['metro_layout'] ) ? $_POST['metro_layout'] : '';

			$mitech_query = new WP_Query( $args );
			$count        = $mitech_query->post_count;

			$response = array(
				'max_num_pages' => $mitech_query->max_num_pages,
				'found_posts'   => $mitech_query->found_posts,
				'count'         => $mitech_query->post_count,
				'test'          => $args,
			);

			ob_start();

			if ( $mitech_query->have_posts() ) :

				set_query_var( 'mitech_query', $mitech_query );
				set_query_var( 'count', $count );
				set_query_var( 'image_size', $image_size );
				set_query_var( 'overlay_style', $overlay_style );
				set_query_var( 'caption_style', $caption_style );
				set_query_var( 'enable_popup_video', $enable_popup_video );
				set_query_var( 'metro_layout', $metro_layout );

				get_template_part( 'loop/shortcodes/case-study/style', $style );

			endif;
			wp_reset_postdata();

			$template = ob_get_contents();
			ob_clean();

			$template = preg_replace( '~>\s+<~', '><', $template );

			$response['template'] = $template;

			echo json_encode( $response );

			wp_die();
		}

		function is_taxonomy() {
			return is_tax( get_object_taxonomies( self::$post_type ) );
		}

		function is_tag() {
			return is_tax( self::$tag );
		}

		function is_category() {
			return is_tax( self::$category );
		}

		/**
		 * Check if current page is archive pages
		 */
		function is_archive() {
			return $this->is_taxonomy() || is_post_type_archive( self::$post_type );
		}

		function has_tag() {
			if ( has_term( '', self::$tag ) ) {
				return true;
			}

			return false;
		}

		function has_category() {
			if ( has_term( '', self::$category ) ) {
				return true;
			}

			return false;
		}

		function nav_page_links() { ?>
			<div class="case-study-nav-links">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="nav-list">
								<div class="nav-item prev">
									<div class="inner">
										<?php
										$prev_post      = get_previous_post();
										$prev_thumbnail = '';
										if ( ! empty( $prev_post ) ) {
											$prev_thumbnail = Mitech_Image::get_the_post_thumbnail( array(
												'post_id' => $prev_post->ID,
												'size'    => '120x80',
											) );
										}

										previous_post_link( '%link', '<div>' . $prev_thumbnail . '<h6>%title</h6></div>' );
										?>
									</div>
								</div>

								<div class="nav-item next">
									<div class="inner">
										<?php
										$next_post      = get_next_post();
										$next_thumbnail = '';
										if ( ! empty( $next_post ) ) {
											$next_thumbnail = Mitech_Image::get_the_post_thumbnail( array(
												'post_id' => $next_post->ID,
												'size'    => '120x80',
											) );
										}

										next_post_link( '%link', '<div>' . $next_thumbnail . '<h6>%title</h6></div>' );
										?>
									</div>
								</div>
							</div>
							<?php
							$return_link = Mitech::setting( 'single_case_study_pagination_return_link' );
							?>
							<?php if ( $return_link !== '' ) : ?>
								<a href="<?php echo esc_url( $return_link ); ?>" class="entry-case-study-return-link">
									<span class="fa fa-th"></span>
								</a>
							<?php endif; ?>

						</div>
					</div>
				</div>
			</div>

			<?php
		}

		function get_the_post_meta( $name = '', $default = '' ) {
			$post_options = unserialize( get_post_meta( get_the_ID(), 'insight_case_study_options', true ) );

			if ( $post_options !== false && isset( $post_options[ $name ] ) ) {
				return $post_options[ $name ];
			}

			return $default;
		}

		function get_the_permalink() {
			$url = get_the_permalink();

			if ( Mitech::setting( 'archive_case_study_external_url' ) === '1' ) {
				$_url = $this->get_the_post_meta( 'case_study_url', '' );

				if ( $_url !== '' ) {
					$url = $_url;
				}
			}

			return $url;
		}

		function the_permalink() {
			$url = $this->get_the_permalink();

			echo esc_url( $url );
		}

		function the_categories() {
			?>
			<div class="post-categories">
				<?php echo get_the_term_list( get_the_ID(), self::$category, '', ', ', '' ); ?>
			</div>
			<?php
		}

		function the_categories_no_link() {
			$terms = get_the_terms( get_the_ID(), self::$category );

			if ( is_array( $terms ) ) { ?>
				<div class="post-categories">
					<?php
					$separator = ', ';
					$count     = 0;
					$temp      = '';
					foreach ( $terms as $term ) {
						if ( $count > 0 ) {
							$temp .= $separator;
						}

						$temp .= $term->name;

						$count++;
					}

					echo esc_html( $temp );
					?>
				</div>
				<?php
			}
		}

		function entry_video( $args = array() ) {
			$defaults = array(
				'position' => 'above',
			);
			$args     = wp_parse_args( $args, $defaults );

			$show_video = Mitech::setting( 'single_case_study_video_enable' );

			if ( $show_video === 'none' || $show_video !== $args['position'] ) {
				return;
			}

			$url = Mitech_Helper::get_post_meta( 'case_study_video_url', '' );
			if ( $url === '' ) {
				return;
			}

			$embed = wp_oembed_get( $url );

			if ( $embed === false ) {
				return;
			}

			$wrap_classes = 'entry-case-study-video';
			$wrap_classes .= " {$args['position']}";
			?>
			<div class="<?php echo esc_attr( $wrap_classes ); ?>">
				<?php echo '<div class="embed-responsive-16by9 embed-responsive">' . $embed . '</div>'; ?>
			</div>
			<?php
		}

		function entry_categories() {
			$cats_enable = Mitech::setting( 'single_case_study_categories_enable' );

			if ( $cats_enable === '1' && $this->has_category() ) : ?>
				<div class="entry-case-study-categories">
					<?php echo get_the_term_list( get_the_ID(), self::$category, '', ', ', '' ); ?>
				</div>
			<?php endif;
		}

		function entry_details() {
			$client = Mitech_Helper::get_post_meta( 'case_study_client', '' );
			$date   = Mitech_Helper::get_post_meta( 'case_study_date', '' );
			$awards = Mitech_Helper::get_post_meta( 'case_study_awards', '' );

			$tags_enable = Mitech::setting( 'single_case_study_tags_enable' );
			?>
			<div class="entry-case-study-details">
				<table>
					<?php if ( $date !== '' ) : ?>
						<tr class="entry-case_study-date">
							<td class="label"><?php esc_html_e( 'Date', 'mitech' ); ?></td>
							<td><?php echo esc_html( $date ); ?></td>
						</tr>
					<?php endif; ?>

					<?php if ( $client !== '' ) : ?>
						<tr class="entry-case-study-client">
							<td class="label"><?php esc_html_e( 'Client', 'mitech' ); ?></td>
							<td><?php echo esc_html( $client ); ?></td>
						</tr>
					<?php endif; ?>

					<?php if ( $awards !== '' ) : ?>
						<tr class="entry-case-study-awards">
							<td class="label"><?php esc_html_e( 'Awards', 'mitech' ); ?></td>

							<?php echo '<td>' . $awards . '</td>'; ?>
						</tr>
					<?php endif; ?>

					<?php if ( $tags_enable === '1' && $this->has_tag() ) : ?>
						<tr class="entry-case-study-tags">
							<td class="label"><?php esc_html_e( 'Tags', 'mitech' ); ?></td>
							<td><?php echo get_the_term_list( get_the_ID(), self::$tag, '', ', ', '' ); ?></td>
						</tr>
					<?php endif; ?>

					<?php $this->entry_sharing(); ?>

				</table>
			</div>
			<?php
		}

		function entry_sharing( $args = array() ) {
			if ( ! class_exists( 'InsightCore' ) ) {
				return;
			}

			$social_sharing = Mitech::setting( 'social_sharing_item_enable' );
			if ( ! empty( $social_sharing ) && Mitech::setting( 'single_case_study_share_enable' ) === '1' ) {
				?>
				<tr class="entry-case-study-share">
					<td class="label"><?php esc_html_e( 'Share', 'mitech' ); ?></td>
					<td class="case-study-sharing-list">
						<div class="inner">
							<?php Mitech_Templates::get_sharing_list( $args ); ?>
						</div>
					</td>
				</tr>
				<?php
			}
		}

		function entry_project_link() {
			$url = Mitech_Helper::get_post_meta( 'case_study_url', '' );

			if ( $url !== '' ) : ?>
				<div class="entry-case-study-link">
					<a class="tm-button-view-project tm-button style-flat"
					   href="<?php echo esc_url( $url ); ?>">
						<span class="btn-text"><?php esc_html_e( 'Visit Site', 'mitech' ); ?></span>
					</a>
				</div>
			<?php endif;
		}
	}

	Mitech_Case_Study::instance()->init();
}
