<?php
extract( $mitech_shortcode_atts );

$box_link = vc_build_link( $box_link );
?>

<?php if ( $image ) : ?>
	<div class="image">
		<?php
		Mitech_Image::the_attachment_by_id( array(
			'id'   => $image,
			'size' => '500x286',
		) );
		?>
	</div>
<?php endif; ?>

<div class="content">
	<?php if ( isset( ${"icon_$icon_type"} ) && ${"icon_$icon_type"} !== '' ) { ?>
		<?php
		$_args = array(
			'type'         => $icon_type,
			'icon'         => ${"icon_$icon_type"},
			'parent_hover' => ".tm-box-icon",
		);

		Mitech_Helper::get_vc_icon_template( $_args );
		?>
	<?php } ?>
	<div class="main-content">
		<?php if ( $heading ) : ?>
			<h4 class="heading">
				<?php echo esc_html( $heading ); ?>
			</h4>
		<?php endif; ?>

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
			<span class="button-icon"></span>

			<?php if ( $box_link['url'] === '' && $button['url'] !== '' ) { ?>
				<?php echo '</a>'; ?>
			<?php } else { ?>
				<?php echo '</div>'; ?>
			<?php } ?>
			<?php } ?>
			<?php } ?>
	</div>
</div>
