<?php
extract( $mitech_shortcode_atts );
$items = (array) vc_param_group_parse_atts( $items );
?>
<div class="tm-grid-wrapper">
	<div class="tm-grid modern-grid has-animation move-up">
		<?php foreach ( $items as $item ) { ?>
			<div class="grid-item">
				<div class="grid-item-inner">
					<?php
					$inner_classes = 'inner';
					if ( isset( $item['image_hover'] ) ) {
						$inner_classes .= ' has-image-hover';
					}
					?>

					<div class="<?php echo esc_attr( $inner_classes ); ?>">
						<?php
						$_flag = false;
						if ( isset( $item['link'] ) ) {
							$link = vc_build_link( $item['link'] );
							if ( $link['url'] !== '' ) {
								$_target = $link['target'] !== '' ? ' target="_blank"' : '';
								$_title  = $link['title'] !== '' ? ' title="' . esc_attr( $link['title'] ) . '"' : '';
								echo '<a href="' . esc_url( $link['url'] ) . '"' . $_target . $_title . '>';
								$_flag = true;
							}
						}
						?>
						<?php if ( isset( $item['image'] ) ) : ?>
							<div class="image">
								<?php Mitech_Image::the_attachment_by_id( array( 'id' => $item['image'] ) ); ?>
							</div>
						<?php endif; ?>
						<?php if ( isset( $item['image_hover'] ) ) : ?>
							<div class="image-hover">
								<?php Mitech_Image::the_attachment_by_id( array( 'id' => $item['image_hover'] ) ); ?>
							</div>
						<?php endif; ?>
						<?php
						if ( $_flag === true ) {
							echo '</a>';
						}
						?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
