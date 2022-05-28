<?php
extract( $mitech_shortcode_atts );
$images = explode( ',', $images );

foreach ( $images as $image ) {
	$classes = array( 'gallery-item grid-item' );

	$attachment_full = Mitech_Image::get_attachment_by_id( array(
		'id'      => $image,
		'size'    => 'custom',
		'width'   => 480,
		'height'  => 9999,
		'crop'    => false,
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

			<div class="post-thumbnail">
				<?php echo $attachment_full['template']; ?>
			</div>

			<div class="overlay"></div>
			<div class="overlay-icon"></div>
		</a>
	</div>
	<?php
}
