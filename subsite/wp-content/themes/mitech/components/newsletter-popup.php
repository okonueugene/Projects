<?php
$form_id = Mitech_Helper::get_mailchimp_form_id();

if ( $form_id === '' ) {
	return;
}

$heading = Mitech::setting( 'newsletter_popup_heading' );
$desc    = Mitech::setting( 'newsletter_popup_description' );
$image   = Mitech::setting( 'newsletter_popup_image' );
?>
<div id="newsletter-popup" class="newsletter-popup">
	<div class="inner">
		<div id="newsletter-popup-close" class="newsletter-popup-close">
			<span class="fal fa-times"></span>
		</div>

		<div class="popup-content">
			<?php if ( $heading !== '' ): ?>
				<h3 class="popup-heading"><?php echo esc_html( $heading ); ?></h3>
			<?php endif; ?>

			<?php if ( $desc !== '' ): ?>
				<div class="popup-description"><?php echo esc_html( $desc ); ?></div>
			<?php endif; ?>

			<?php if ( $image !== '' ): ?>
				<div class="popup-image">
					<img src="<?php echo esc_url( $image ); ?>"
					     alt="<?php esc_attr_e( 'Newsletter Image', 'mitech' ); ?>">
				</div>
			<?php endif; ?>

			<div class="popup-form">
				<?php mc4wp_show_form( $form_id ); ?>
			</div>
		</div>
	</div>
</div>
