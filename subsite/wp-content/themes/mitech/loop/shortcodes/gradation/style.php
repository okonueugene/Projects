<?php
extract( $mitech_shortcode_atts );

$items = (array) vc_param_group_parse_atts( $items );
$count = 0;

foreach ( $items as $item ) {
	$count++;

	$_item_classes = 'item';
	$_item_classes .= " item-$count";

	$button = vc_build_link( $item['button'] );
	?>
	<div class="<?php echo esc_attr( $_item_classes ); ?>">
		<div class="line"></div>
		<div class="circle-wrap">
			<div class="mask">
				<div class="wave-pulse wave-pulse-1"></div>
				<div class="wave-pulse wave-pulse-2"></div>
				<div class="wave-pulse wave-pulse-3"></div>
			</div>

			<h6 class="circle"><?php echo esc_html( $count ); ?></h6>
		</div>

		<div class="content-wrap">
			<?php
			$icon_class = '';

			if ( isset( $item['icon'] ) && $item['icon'] !== '' ) {
				?>
				<div class="icon">
					<span class="<?php echo esc_attr( $item['icon'] ); ?>"></span>
				</div>
				<?php
			}
			?>

			<?php if ( isset( $item['title'] ) ) : ?>
				<h5 class="heading"><?php echo esc_html( $item['title'] ); ?></h5>
			<?php endif; ?>

			<?php if ( isset( $item['text'] ) ) : ?>
				<div class="text"><?php echo esc_html( $item['text'] ); ?></div>
			<?php endif; ?>

			<?php if ( $button['url'] !== '' && $button['title'] !== '' ): ?>
				<a class="gradation-btn" href="<?php echo esc_url( $button['url'] ); ?>"
					<?php if ( $button['target'] !== '' ) {
						echo 'target="' . $button['target'] . '"';
					} ?>
				>
						<span class="button-text" data-text="<?php echo esc_attr( $button['title'] ); ?>">
							<?php echo esc_html( $button['title'] ); ?>
						</span>
					<span class="button-icon far fa-long-arrow-right"></span>
				</a>
			<?php endif; ?>
		</div>
	</div>
<?php } ?>
