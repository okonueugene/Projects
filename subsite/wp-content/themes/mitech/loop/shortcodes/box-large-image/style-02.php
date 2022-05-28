<?php
$image_size = $image_size_width = $image_size_height = '';
extract( $mitech_shortcode_atts );

$box_link = vc_build_link( $box_link );
if ( $image_size === '' ) {
	$image_size = '370x370';
}
?>

<div class="content">
	<?php if ( $image ) : ?>
		<?php
		$_url = Mitech_Image::get_attachment_url_by_id( array(
			'id'     => $image,
			'size'   => $image_size,
			'width'  => $image_size_width,
			'height' => $image_size_height,
		) );
		?>

		<div class="image" style="<?php echo esc_attr( 'background-image: url(' . $_url . ');' ); ?>">

		</div>
	<?php endif; ?>

	<div class="box-info">
		<?php if ( $heading ) : ?>
			<h4 class="heading">
				<?php echo esc_html( $heading ); ?>
			</h4>
		<?php endif; ?>

		<div class="box-more-info">
			<?php if ( $text ) : ?>
				<?php echo '<div class="text">' . $text . '</div>'; ?>
			<?php endif; ?>

			<?php
			if ( $button && $button !== '' ) {

			$button         = vc_build_link( $button );
			$button_classes = 'btn';
			?>
			<?php if ( $button['title'] !== '' ) { ?>
			<?php if ( $box_link['url'] === '' && $button['url'] !== '' ) { ?>
			<a class="<?php echo esc_attr( $button_classes ); ?>"
			   href="<?php echo esc_url( $button['url'] ) ?>"
				<?php if ( $button['target'] !== '' ) { ?>
					target="<?php echo esc_attr( $button['target'] ); ?>"
				<?php } ?>
			>
				<?php } else { ?>
					<?php echo '<div class="' . esc_attr( $button_classes ) . '">'; ?>
				<?php } ?>

				<span class="button-text"><?php echo esc_html( $button['title'] ); ?></span>
				<span class="button-icon far fa-long-arrow-right"></span>

				<?php if ( $box_link['url'] === '' && $button['url'] !== '' ) { ?>
					<?php echo '</a>'; ?>
				<?php } else { ?>
					<?php echo '</div>'; ?>
				<?php } ?>
				<?php } ?>
				<?php } ?>
		</div>
	</div>
</div>
