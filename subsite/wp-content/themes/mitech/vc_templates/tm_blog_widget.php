<?php
defined( 'ABSPATH' ) || exit;

$post_type  = 'post';
$style      = $el_class = '';
$categories = $meta_key = $pagination = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-blog-widget-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$mitech_post_args = array(
	'post_type'      => $post_type,
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
	'paged'          => 1,
	'post_status'    => 'publish',
	'no_found_rows'  => true,
	'post__not_in'   => get_option( 'sticky_posts' ),
);

if ( in_array( $orderby, array( 'meta_value', 'meta_value_num' ) ) ) {
	$mitech_post_args['meta_key'] = $meta_key;
}

$mitech_post_args = Mitech_VC::get_tax_query_of_taxonomies( $mitech_post_args, $taxonomies );
$mitech_query     = new WP_Query( $mitech_post_args );

$css_class = 'tm-blog-widget';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

$css_class .= Mitech_Helper::get_animation_classes();
?>

<?php if ( $mitech_query->have_posts() ) : ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
		<div class="tm-grid">
			<?php
			while ( $mitech_query->have_posts() ) :
				$mitech_query->the_post();
				$classes = array( 'post-item' );
				?>
				<div <?php post_class( implode( ' ', $classes ) ); ?>>
					<div class="post-wrapper">

						<?php if ( $show_thumbnail === '1' ) : ?>
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>">
									<?php if ( has_post_thumbnail() ) { ?>
										<?php Mitech_Image::the_post_thumbnail( array( 'size' => '80x80' ) ); ?>
										<?php
									} else {
										Mitech_Templates::image_placeholder( 80, 80 );
									}
									?>

									<div class="post-overlay">
										<span class="post-icon fa fa-search"></span>
									</div>
								</a>
							</div>
						<?php endif; ?>

						<div class="post-info">

							<?php if ( $show_category === '1' ) : ?>
								<div class="post-categories">
									<?php the_category( ', ' ); ?>
								</div>
							<?php endif; ?>

							<h5 class="post-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h5>

							<?php if ( $show_date === '1' ) : ?>
								<span class="post-date"><?php echo get_the_date( 'F d, Y' ); ?></span>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endwhile; ?>

		</div>
	</div>
<?php endif; ?>
<?php wp_reset_postdata();
