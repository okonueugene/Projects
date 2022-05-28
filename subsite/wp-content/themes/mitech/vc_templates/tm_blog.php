<?php
defined( 'ABSPATH' ) || exit;

$post_type  = 'post';
$style      = $el_class = '';
$categories = $meta_key = $main_query = $pagination = $animation = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-blog-' );
$this->get_inline_css( "#$css_id", $atts );
Mitech_VC::get_shortcode_custom_css( "#$css_id", $atts );
extract( $atts );

if ( $number === '' ) {
	$number = get_option( 'posts_per_page' );
}

$mitech_post_args = array(
	'post_type'      => $post_type,
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
	'paged'          => 1,
	'post_status'    => 'publish',
	'post__not_in'   => get_option( 'sticky_posts' ),
);

if ( in_array( $orderby, array( 'meta_value', 'meta_value_num' ) ) ) {
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

$css_class = 'tm-blog';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";
$css_class .= Mitech_Helper::get_grid_filter_classes( $atts );

$grid_classes = 'tm-grid';

if ( in_array( $style, array(
	'grid-classic',
	'grid-metro',
) ) ) {
	$grid_classes .= ' modern-grid';
} elseif ( $style === 'grid-masonry' ) {
	wp_enqueue_script( 'isotope-packery' );
}

$grid_classes .= Mitech_Helper::get_grid_animation_classes( $animation );
?>

<?php if ( $mitech_query->have_posts() ) : ?>
	<div class="tm-grid-wrapper <?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
		<?php if ( $pagination !== '' && $mitech_query->found_posts > $number ) : ?>
			data-pagination="<?php echo esc_attr( $pagination ); ?>"
		<?php endif; ?>

		<?php if ( $pagination_custom_button_id !== '' ): ?>
			data-pagination-custom-button-id="<?php echo esc_attr( $pagination_custom_button_id ); ?>"
		<?php endif; ?>

		 data-filter-type="<?php echo esc_attr( $filter_type ); ?>"

		<?php if ( in_array( $style, array( 'grid-masonry' ), true ) ) { ?>
			data-type="masonry"
		<?php } ?>

		<?php if ( in_array( $style, array( 'grid-masonry' ), true ) && $columns !== '' ): ?>
			<?php
			$arr = explode( ';', $columns );
			foreach ( $arr as $value ) {
				$tmp = explode( ':', $value );
				echo ' data-' . $tmp[0] . '-columns="' . esc_attr( $tmp[1] ) . '"';
			}
			?>

			<?php if ( $gutter !== '' && $gutter !== 0 ) : ?>
				data-gutter="<?php echo esc_attr( $gutter ); ?>"
			<?php endif; ?>
		<?php endif; ?>
	>
		<?php
		$count = $mitech_query->post_count;

		$tm_grid_query                  = $mitech_post_args;
		$tm_grid_query['action']        = "{$post_type}_infinite_load";
		$tm_grid_query['max_num_pages'] = $mitech_query->max_num_pages;
		$tm_grid_query['found_posts']   = $mitech_query->found_posts;
		$tm_grid_query['taxonomies']    = $taxonomies;
		$tm_grid_query['style']         = $style;
		$tm_grid_query['pagination']    = $pagination;
		$tm_grid_query['count']         = $count;
		$tm_grid_query['metro_layout']  = $metro_layout;
		$tm_grid_query                  = htmlspecialchars( wp_json_encode( $tm_grid_query ) );
		?>

		<?php Mitech_Templates::grid_filters( $post_type, $filter_enable, $filter_align, $filter_counter, $filter_wrap, $mitech_query->found_posts, $filter_by ); ?>

		<input type="hidden" class="tm-grid-query" value="<?php echo '' . $tm_grid_query; ?>"/>

		<div class="<?php echo esc_attr( $grid_classes ); ?>"
			<?php if ( in_array( $style, array( 'list' ), true ) ) : ?>
				data-grid-has-gallery="true"
			<?php endif; ?>
		>
			<?php
			set_query_var( 'mitech_query', $mitech_query );
			set_query_var( 'count', $count );
			set_query_var( 'metro_layout', $metro_layout );

			get_template_part( 'loop/shortcodes/blog/style', $style );
			?>
		</div>

		<?php Mitech_Templates::grid_pagination( $mitech_query, $number, $pagination, $pagination_align, $pagination_button_text ); ?>

	</div>
<?php endif; ?>
<?php wp_reset_postdata();
