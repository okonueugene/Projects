<?php
extract( $mitech_shortcode_atts );

$items = (array) vc_param_group_parse_atts( $items );
$count = 0;

foreach ( $items as $item ) {
	$count++;

	$_item_classes = 'item';
	$_item_classes .= " item-$count";

	?>
	<div class="<?php echo esc_attr( $_item_classes ); ?>">
		<div class="line">
			<div class="dot dot-1"></div>
			<div class="dot dot-2"></div>
			<div class="dot dot-3"></div>
			<div class="dot dot-4"></div>
			<div class="dot dot-5"></div>
			<div class="dot dot-4"></div>
			<div class="dot dot-3"></div>
			<div class="dot dot-2"></div>
			<div class="dot dot-1"></div>
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
		</div>
	</div>
<?php } ?>
