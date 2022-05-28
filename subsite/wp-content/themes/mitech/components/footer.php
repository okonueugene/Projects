<?php
$footer_type = Mitech_Global::instance()->get_footer_type();
if ( $footer_type === 'none' ) {
	return;
}

$_mitech_query = Mitech_Global::instance()->get_footer_post();
?>
<?php if ( $_mitech_query !== '' && $_mitech_query->have_posts() ) { ?>
	<?php while ( $_mitech_query->have_posts() ) : $_mitech_query->the_post(); ?>
		<?php
		$footer_options      = unserialize( get_post_meta( get_the_ID(), 'insight_footer_options', true ) );
		$_effect             = Mitech_Helper::get_the_post_meta( $footer_options, 'effect', '' );
		$footer_wrap_classes = "page-footer-wrapper";

		if ( $_effect !== '' ) {
			$footer_wrap_classes .= " {$_effect}";
		}
		?>
		<div id="page-footer-wrapper" class="<?php echo esc_attr( $footer_wrap_classes ); ?>">
			<div id="page-footer" <?php Mitech::footer_class(); ?>>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="page-footer-inner">
								<?php
								// bbPress plugin remove all filters for the_content. then shortcodes won't rendering properly.
								if ( class_exists( 'bbPress' ) ) :
									echo do_shortcode( get_the_content() );
								else:
									the_content();
								endif;
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	endwhile;
	wp_reset_postdata();
} else {
	?>
	<div class="page-footer simple-footer" id="page-footer">
		<div class="container">
			<div class="row row-xs-center">
				<div class="col-md-12">
					<div class="footer-text">
						<?php $copyright_text = Mitech::setting( 'footer_simple_text' ); ?>
						<?php echo wp_kses( $copyright_text, 'mitech-default' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
