<?php
$image = Mitech::setting( 'pre_loader_image' );
?>
<div>
	<?php if ( $image !== '' ): ?>
		<img src="<?php echo esc_url( $image ); ?>"
		     alt="<?php esc_attr_e( 'Mitech Preloader', 'mitech' ); ?>">
	<?php endif; ?>
</div>
