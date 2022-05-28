<?php
defined( 'ABSPATH' ) || exit;

$style = $show_user_name = $el_class = $username = $overlay = $link_target = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-instagram-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$css_class = 'tm-grid-wrapper tm-instagram';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";
$classes   = array( 'tm-grid modern-grid' );

$css_class .= Mitech_Helper::get_animation_classes();
if ( $username !== '' ) {
	$media_array = Mitech_Instagram::scrape_instagram( $username, $number_items );
	if ( is_wp_error( $media_array ) ) {
		?>
		<div class="tm-instagram--error">
			<?php echo '<p>' . $media_array->get_error_message() . '</p>'; ?>
		</div>
		<?php
	} else {
		?>
		<div id="<?php echo esc_attr( $css_id ); ?>" class="<?php echo esc_attr( trim( $css_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<?php foreach ( $media_array as $item ) { ?>
					<div class="grid-item">
						<div class="inner">
							<img src="<?php echo esc_url( $item[ $size ] ); ?>" class="item-image"
							     alt="<?php esc_attr_e( 'Instagram Image', 'mitech' ); ?>"/>
							<?php if ( 'video' === $item['type'] ) : ?>
								<span class="play-button"></span>
							<?php endif; ?>
							<div class="overlay">
								<a href="<?php echo esc_url( $item['link'] ); ?>"
									<?php if ( '1' === $link_target ) : ?>
										target="_blank"
									<?php endif; ?>
								>
									<?php if ( '1' === $overlay ) : ?>
										<div class="item-info">
											<span class="likes"><?php echo esc_html( $item['likes'] ); ?></span>
											<span class="comments"><?php echo esc_html( $item['comments'] ); ?></span>
										</div>
									<?php endif; ?>
								</a>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>

			<?php if ( $show_user_name === '1' ) : ?>
				<div class="instagram-user-name">
					<?php echo '@' . esc_html( $username ); ?>
				</div>
			<?php endif; ?>

		</div>
	<?php }
} ?>
