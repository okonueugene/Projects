<?php
$features = $price = $currency = $period = $title = $desc = $icon_type = $icon_classes = '';
extract( $mitech_shortcode_atts );

if ( isset( ${"icon_" . $icon_type} ) ) {
	$icon_classes = esc_attr( ${"icon_" . $icon_type} );

	vc_icon_element_fonts_enqueue( $icon_type );
}

$_button_classes = 'tm-button style-flat tm-button-sm tm-pricing-button';

$features = (array) vc_param_group_parse_atts( $features );
$button   = vc_build_link( $button );
?>

<?php if ( $highlight === '1' ) : ?>
	<div class="tm-pricing-feature-mark">
		<span><?php esc_html_e( 'Popular Choice', 'mitech' ); ?></span>
	</div>
<?php endif; ?>

<div class="tm-pricing-header">
	<?php if ( $image !== '' ) {
		?>
		<div class="image">
			<?php Mitech_Image::the_attachment_by_id( array(
				'id'   => $image,
				'size' => '370x9999',
				'crop' => false,
			) ); ?>
		</div>
		<?php
	}
	?>

	<?php if ( $icon_classes !== '' ) : ?>
		<div class="icon">
			<span class="<?php echo esc_attr( $icon_classes ); ?>"></span>
		</div>
	<?php endif; ?>

	<h5 class="title"><?php echo esc_html( $title ); ?></h5>

	<?php if ( $desc !== '' ) : ?>
		<div class="description"><?php echo esc_html( $desc ); ?></div>
	<?php endif; ?>

	<?php if ( $currency && $price !== '' ) : ?>

		<div class="price-wrap">
			<div class="price-wrap-inner">
				<h6 class="currency"><?php echo esc_html( $currency ); ?></h6>
				<h6 class="price"><?php echo esc_html( $price ); ?></h6>

				<?php if ( $period !== '' ) : ?>
					<h6 class="period"><?php echo esc_html( $period ); ?></h6>
				<?php endif; ?>
			</div>
		</div>

	<?php endif; ?>
</div>
<div class="tm-pricing-content">
	<?php if ( count( $features ) > 0 ) { ?>
		<ul class="tm-pricing-list">
			<?php
			foreach ( $features as $data ) { ?>
				<?php
				$item_class = 'pricing-item';
				?>

				<li class="<?php echo esc_attr( $item_class ); ?>">
					<?php if ( isset( $data['icon'] ) ) : ?>
						<i class="feature-icon <?php echo esc_attr( $data['icon'] ); ?>"></i>
					<?php endif; ?>
					<?php if ( isset( $data['text'] ) ) : ?>
						<div class="feature-text">
							<?php echo wp_kses( $data['text'], 'mitech-default' ); ?>
						</div>
					<?php endif; ?>
				</li>
				<?php
			}
			?>
		</ul>
	<?php } ?>
</div>
<?php if ( $button['url'] !== '' ) { ?>
	<div class="tm-pricing-footer">
		<?php
		$_button_title = $button['title'] != '' ? $button['title'] : esc_html__( 'Sign Up', 'mitech' );
		printf( '<a href="%s" %s %s class="%s">%s</a>', $button['url'], $button['target'] != '' ? 'target="' . esc_attr( $button['target'] ) . '"' : '', $button['rel'] != '' ? 'rel="' . esc_attr( $button['rel'] ) . '"' : '', $_button_classes, $_button_title );
		?>
	</div>
<?php } ?>
