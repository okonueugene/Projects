<?php
$text = $description = $icon_class = $number = $number_prefix = $number_suffix = "";
extract( $mitech_shortcode_atts );

if ( isset( ${"icon_{$icon_type}"} ) && ${"icon_{$icon_type}"} !== '' ) {
	$icon_class = esc_attr( ${"icon_{$icon_type}"} );

	vc_icon_element_fonts_enqueue( $icon_type );
}
?>
<?php if ( $icon_class !== '' ) : ?>
	<div class="icon">
		<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
	</div>
<?php endif; ?>

<div class="content-wrap">
	<?php if ( $sub_heading !== '' ): ?>
		<h6 class="sub-heading">
			<?php echo wp_kses( $sub_heading, 'mitech-default' ); ?>
		</h6>
	<?php endif; ?>

	<?php if ( $number !== '' ) : ?>
		<div class="number-wrap">
			<?php if ( $number_prefix !== '' ) : ?>
				<span class="number-prefix"><?php echo esc_html( $number_prefix ); ?></span>
			<?php endif; ?>
			<span class="number"><?php echo esc_html( $number ); ?></span>
			<?php if ( $number_suffix !== '' ) : ?>
				<?php echo '<span class="number-suffix">' . $number_suffix . '</span>'; ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ( $text !== '' ) : ?>
		<?php printf( '<h5 class="heading">%s</h5>', esc_html( $text ) ); ?>
	<?php endif; ?>

	<?php if ( $description !== '' ) : ?>
		<div class="description">
			<?php echo wp_kses( $description, 'mitech-default' ); ?>
		</div>
	<?php endif; ?>
</div>
