<?php
if ( $metro_layout ) {
	$metro_layout = (array) vc_param_group_parse_atts( $metro_layout );
	$_sizes       = array();
	foreach ( $metro_layout as $key => $value ) {
		$_sizes[] = $value['size'];
	}
	$metro_layout = $_sizes;
} else {
	$metro_layout = array(
		'1:1',
		'2:2',
		'1:2',
		'1:1',
		'1:1',
		'2:1',
		'1:1',
	);
}

if ( count( $metro_layout ) < 1 ) {
	return;
}

$metro_layout_count = count( $metro_layout );
$metro_item_count   = 0;

while ( $mitech_query->have_posts() ) :
	$mitech_query->the_post();

	$classes = array( 'case-study-item grid-item' );

	if ( in_array( $metro_layout[ $metro_item_count ], array(
		'2:1',
		'2:2',
	), true ) ) {
		$classes[] = 'grid-width-2';
	}

	if ( in_array( $metro_layout[ $metro_item_count ], array(
		'1:2',
		'2:2',
	), true ) ) {
		$classes[] = 'grid-height-2';
	}

	$_image_width = $_image_height = 480;
	if ( $metro_layout[ $metro_item_count ] === '2:1' ) {
		$_image_width *= 2;
	} elseif ( $metro_layout[ $metro_item_count ] === '1:2' ) {
		$_image_height *= 2;
	} elseif ( $metro_layout[ $metro_item_count ] === '2:2' ) {
		$_image_width  *= 2;
		$_image_height *= 2;
	}

	$_url = Mitech_Image::get_the_post_thumbnail_url( array(
		'size'   => 'custom',
		'width'  => $_image_width,
		'height' => $_image_height,
	) );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<a href="<?php Mitech_Case_Study::instance()->the_permalink(); ?>" class="post-permalink link-secret">
			<div class="post-wrapper" style="background-image: url( <?php echo esc_url( $_url ); ?> );">
				<?php if ( $overlay_style !== '' ) : ?>
					<?php get_template_part( 'loop/case-study/overlay', $overlay_style ); ?>
				<?php endif; ?>
			</div>
		</a>
	</div>
	<?php
	$metro_item_count++;
	if ( $metro_item_count == $count || $metro_layout_count == $metro_item_count ) {
		$metro_item_count = 0;
	}
	?>
<?php endwhile; ?>
