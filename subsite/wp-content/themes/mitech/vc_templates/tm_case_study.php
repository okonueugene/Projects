<?php
defined( 'ABSPATH' ) || exit;

$post_type          = 'case_study';
$style              = $el_class = $order = $overlay_style = $caption_style = $animation = '';
$filter_by          = $filter_wrap = $filter_enable = $filter_align = $filter_counter = $filter_type = '';
$pagination_align   = $pagination_button_text = '';
$justify_row_height = $justify_max_row_height = $justify_last_row_alignment = '';
$gutter             = 0;
$enable_popup_video = '';
$main_query         = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_id  = Mitech_VC::get_shortcode_el_id( $atts, 'tm-case-study-' );
$css_id = "#{$el_id}";

$this->get_inline_css( $css_id, $atts );

$css_class = 'tm-case-study';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";
$css_class .= Mitech_Helper::get_grid_filter_classes( $atts );

if ( in_array( $style, array( 'grid', 'masonry' ), true ) && $caption_style !== '' ) {
	$css_class .= " has-caption caption-style-$caption_style";
}

if ( ! in_array( $style, array( 'list' ), true ) && $overlay_style !== '' ) {
	$css_class .= " has-overlay case-study-overlay-$overlay_style";
}

$css_class .= Mitech_Helper::get_animation_classes();

if ( $number === '' ) {
	$number = get_option( 'posts_per_page' );
}

if ( $image_size === '' ) {
	if ( in_array( $style, array( 'list' ), true ) ) {
		$image_size = '570x400';
	} elseif ( in_array( $style, array( 'carousel' ), true ) ) {
		$image_size = '480x298';
	} else {
		$image_size = '480x298';
	}
}

$mitech_post_args = array(
	'post_type'      => $post_type,
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
	'paged'          => 1,
	'post_status'    => 'publish',
);

if ( in_array( $orderby, array( 'meta_value', 'meta_value_num' ), true ) ) {
	$mitech_post_args['meta_key'] = $meta_key;
}

if ( get_query_var( 'paged' ) ) {
	$mitech_post_args['paged'] = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$mitech_post_args['paged'] = get_query_var( 'page' );
}

$mitech_post_args = Mitech_VC::get_tax_query_of_taxonomies( $mitech_post_args, $taxonomies );

if ( $main_query === '1' ) {
	global $wp_query;
	$mitech_query = $wp_query;
} else {
	$mitech_query = new WP_Query( $mitech_post_args );
}

$is_swiper = false;
if ( in_array( $style, array(
	'carousel',
), true ) ) {
	$is_swiper = true;
}

$grid_classes = 'tm-grid';

if ( $is_swiper ) {
	$grid_classes   .= ' swiper-wrapper';
	$slider_classes = 'mitech-swiper tm-swiper equal-height';

	if ( $carousel_nav !== '' ) {
		$slider_classes .= " nav-style-$carousel_nav";
	}
	if ( $carousel_pagination !== '' ) {
		$slider_classes .= " pagination-style-$carousel_pagination";
	}
} else {
	$grid_classes .= Mitech_Helper::get_grid_animation_classes( $animation );
}

if ( $style === 'justified' ) {
	wp_enqueue_style( 'justifiedGallery' );
	wp_enqueue_script( 'justifiedGallery' );
} elseif ( in_array( $style, array( 'masonry' ), true ) ) {
	wp_enqueue_script( 'isotope-packery' );
} elseif ( in_array( $style, array(
	'grid',
	'metro',
	'metro-02',
), true ) ) {
	$grid_classes .= ' modern-grid';
}

if ( $overlay_style === 'parallax' ) {
	wp_enqueue_script( 'tilt' );
}
?>
<?php if ( $mitech_query->have_posts() ) : ?>
	<div class="tm-grid-wrapper <?php echo esc_attr( trim( $css_class ) ); ?>"
	     id="<?php echo esc_attr( $el_id ); ?>"

		<?php if ( $pagination !== '' && $mitech_query->found_posts > $number ) : ?>
			data-pagination="<?php echo esc_attr( $pagination ); ?>"
		<?php endif; ?>

		<?php if ( $pagination_custom_button_id !== '' ): ?>
			data-pagination-custom-button-id="<?php echo esc_attr( $pagination_custom_button_id ); ?>"
		<?php endif; ?>

		 data-filter-type="<?php echo esc_attr( $filter_type ); ?>"

		<?php if ( in_array( $style, array( 'masonry' ), true ) ) { ?>
			data-type="masonry"
		<?php } elseif ( $is_swiper ) { ?>
			data-type="swiper"
		<?php } elseif ( $style === 'justified' ) { ?>
			data-type="justified"

			<?php if ( $justify_row_height !== '' && $justify_row_height > 0 ) { ?>
				data-justified-height="<?php echo esc_attr( $justify_row_height ); ?>"
			<?php } ?>

			<?php if ( $justify_max_row_height !== '' && $justify_max_row_height > 0 ) { ?>
				data-justified-max-height="<?php echo esc_attr( $justify_max_row_height ); ?>"
			<?php } ?>

			<?php if ( $justify_last_row_alignment !== '' ) { ?>
				data-justified-last-row="<?php echo esc_attr( $justify_last_row_alignment ); ?>"
			<?php } ?>
		<?php } ?>

		<?php if ( $style === 'metro' ) : ?>
			data-grid-ratio="1:1"
		<?php endif; ?>

		<?php if ( in_array( $style, array( 'masonry' ), true ) ) { ?>
			<?php if ( $columns !== '' ): ?>
				<?php
				$arr = explode( ';', $columns );
				foreach ( $arr as $value ) {
					$tmp = explode( ':', $value );
					echo ' data-' . $tmp[0] . '-columns="' . esc_attr( $tmp[1] ) . '"';
				}
				?>
			<?php endif; ?>
		<?php } ?>

		<?php if ( $gutter !== '' && $gutter !== 0 ) : ?>
			data-gutter="<?php echo esc_attr( $gutter ); ?>"
		<?php endif; ?>

		<?php if ( $overlay_style === 'parallax' ): ?>
			data-hover="tilt"
		<?php endif; ?>
	>
		<?php
		$count = $mitech_query->post_count;

		$tm_grid_query                       = $mitech_post_args;
		$tm_grid_query['action']             = "{$post_type}_infinite_load";
		$tm_grid_query['max_num_pages']      = $mitech_query->max_num_pages;
		$tm_grid_query['found_posts']        = $mitech_query->found_posts;
		$tm_grid_query['taxonomies']         = $taxonomies;
		$tm_grid_query['style']              = $style;
		$tm_grid_query['image_size']         = $image_size;
		$tm_grid_query['overlay_style']      = $overlay_style;
		$tm_grid_query['caption_style']      = $caption_style;
		$tm_grid_query['enable_popup_video'] = $enable_popup_video;
		$tm_grid_query['metro_layout']       = $metro_layout;
		$tm_grid_query['pagination']         = $pagination;
		$tm_grid_query['count']              = $count;
		$tm_grid_query                       = htmlspecialchars( wp_json_encode( $tm_grid_query ) );
		?>

		<?php Mitech_Templates::grid_filters( $post_type, $filter_enable, $filter_align, $filter_counter, $filter_wrap, $mitech_query->found_posts, $filter_by ); ?>

		<input type="hidden" class="tm-grid-query" <?php echo 'value="' . $tm_grid_query . '"'; ?>/>

		<?php if ( $is_swiper ) { ?>
		<div class="<?php echo esc_attr( $slider_classes ); ?>"
			<?php
			if ( $carousel_items_display !== '' ) {
				$arr = explode( ';', $carousel_items_display );
				foreach ( $arr as $value ) {
					$tmp = explode( ':', $value );
					echo ' data-' . $tmp[0] . '-items="' . $tmp[1] . '"';
				}
			}
			?>

			 data-slides-per-group="inherit"

			<?php
			/*if ( $carousel_gutter !== '' ) {
				$arr = explode( ';', $carousel_gutter );
				foreach ( $arr as $value ) {
					$tmp = explode( ':', $value );
					echo ' data-' . $tmp[0] . '-gutter="' . $tmp[1] . '"';
				}
			}*/
			?>

			<?php if ( $carousel_nav !== '' ) : ?>
				data-nav="1"
			<?php endif; ?>

			<?php if ( $carousel_nav === 'custom' ) : ?>
				data-custom-nav="<?php echo esc_attr( $slider_button_id ); ?>"
			<?php endif; ?>

			<?php if ( $carousel_loop === '1' ) : ?>
				data-loop="1"
			<?php endif; ?>

			<?php if ( $carousel_pagination !== '' ) : ?>
				data-pagination="1"
			<?php endif; ?>

			<?php if ( $carousel_auto_play !== '' ) : ?>
				data-autoplay="<?php echo esc_attr( $carousel_auto_play ); ?>"
			<?php endif; ?>
		>
			<div class="swiper-inner">
				<div class="swiper-container">
					<?php } ?>

					<div class="<?php echo esc_attr( $grid_classes ); ?>"
					     data-overlay-animation="<?php echo esc_attr( $overlay_style ); ?>"

						<?php if ( $enable_popup_video === '1' ): ?>
							data-grid-has-popup-video="1"
						<?php endif; ?>
					>

						<?php
						set_query_var( 'mitech_query', $mitech_query );
						set_query_var( 'count', $count );
						set_query_var( 'image_size', $image_size );
						set_query_var( 'overlay_style', $overlay_style );
						set_query_var( 'caption_style', $caption_style );
						set_query_var( 'enable_popup_video', $enable_popup_video );
						set_query_var( 'metro_layout', $metro_layout );

						get_template_part( 'loop/shortcodes/case-study/style', $style );
						?>

					</div>

					<?php if ( $is_swiper ) { ?>
				</div>
			</div>
		</div>
	<?php } ?>

		<?php Mitech_Templates::grid_pagination( $mitech_query, $number, $pagination, $pagination_align, $pagination_button_text ); ?>

	</div>
<?php endif; ?>
<?php wp_reset_postdata();
