<?php
extract( $mitech_shortcode_atts );
$images = explode( ',', $images );
$count  = count( $images );

$metro_layout = array(
	'2:1',
	'1:1',
	'1:1',
	'1:1',
);

if ( count( $metro_layout ) < 1 ) {
	return;
}

$metro_layout_count = count( $metro_layout );
$metro_item_count   = 0;

foreach ( $images as $image ) {
	$classes = array( 'gallery-item grid-item' );

	$_image_width  = 960;
	$_image_height = 960;

	$attachment_full = Mitech_Image::get_attachment_url_by_id( array(
		'id'      => $image,
		'size'    => 'custom',
		'width'   => $_image_width,
		'height'  => $_image_height,
		'details' => true,
	) );

	$_sub_html = '';
	if ( $attachment_full['title'] !== '' ) {
		$_sub_html .= "<h4>{$attachment_full['title']}</h4>";
	}

	if ( $attachment_full['caption'] !== '' ) {
		$_sub_html .= "<p>{$attachment_full['caption']}</p>";
	}
	?>
	<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<a href="<?php echo esc_url( $attachment_full['src'] ); ?>" class="zoom"
		   data-sub-html="<?php echo esc_attr( $_sub_html ); ?>">

			<div class="item-wrapper"
			     style="background-image: url( <?php echo esc_url( $attachment_full['cropped_image'] ); ?> );"></div>

			<div class="overlay"></div>
			<div class="overlay-icon"></div>

		</a>
	</div>
	<?php
	$metro_item_count++;
	if ( $metro_item_count == $count || $metro_layout_count == $metro_item_count ) {
		$metro_item_count = 0;
	}
	?>
<?php }
