<?php
defined( 'ABSPATH' ) || exit;

$list_style = $_global_icon = $_global_icon_class = $marker_color = $custom_marker_color = $title_color = $custom_title_color = $desc_color = $custom_desc_color = $animation = '';
$atts       = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );
$css_id = uniqid( 'tm-list-' );
$this->get_inline_css( '#' . $css_id, $atts );
Mitech_VC::get_shortcode_custom_css( "#$css_id", $atts );
$items = (array) vc_param_group_parse_atts( $items );

if ( count( $items ) < 1 ) {
	return;
}

$css_class = 'tm-list';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-{$list_style}";
$css_class .= " list-{$direction}";
$css_class .= " align-{$align}";

// Global icon class.
if ( isset( $icon_type ) && isset( ${"icon_" . $icon_type} ) ) {
	$_global_icon_class .= esc_attr( ${"icon_" . $icon_type} );
}

$css_class .= Mitech_Helper::get_animation_classes( $animation );
?>

<?php if ( $widget_title !== '' ) : ?>
<div class="widget">
	<h2 class="widget-title"><?php echo esc_html( $widget_title ); ?></h2>
	<?php endif; ?>

	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
		<?php
		$auto_number = 0;
		foreach ( $items as $item ) {
			$output = '';

			$_icon      = '';
			$icon_class = '';

			if ( isset( $item['icon'] ) && $item['icon'] !== '' ) {
				$icon_class .= $item['icon'];
			}

			$link = '';
			if ( isset( $item['link'] ) && $item['link'] !== '' ) {
				$link = vc_build_link( $item['link'] );
			}
			?>
			<div class="list-item">

				<?php if ( isset( $link['url'] ) && $link['url'] !== '' ) { ?>
				<a class="link" href="<?php echo esc_url( $link['url'] ) ?>"
					<?php if ( $link['target'] !== '' ) { ?>
						target="<?php echo esc_attr( $link['target'] ); ?>"
					<?php } ?>
				>
					<?php } ?>

					<div class="list-header">
						<div class="marker">

							<?php
							if ( in_array( $list_style, array(
								'icon',
							) ) ) {
								$list_icon_class = 'tm-list__icon';
								if ( $icon_class && $icon_class !== '' ) {
									$list_icon_class .= " $icon_class";
								} else {
									$list_icon_class .= " $_global_icon_class";
								}
								?>
								<i class="<?php echo esc_attr( $list_icon_class ); ?>"></i>
							<?php } elseif ( $list_style === 'auto-numbered-01' ) {
								$auto_number++;
								$_number = str_pad( $auto_number, 2, '0', STR_PAD_LEFT );
								echo esc_html( "{$_number}." );
							} elseif ( $list_style === 'auto-numbered-02' ) {
								$auto_number++;
								$_number = str_pad( $auto_number, 2, '0', STR_PAD_LEFT );
								echo esc_html( $_number );
							} elseif ( $list_style === 'manual-numbered-01' && isset( $item['item_number'] ) ) { // Manual Number.
								echo esc_html( "{$item['item_number']}." );
							}
							?>

						</div>

						<div class="title-wrap">
							<?php if ( isset( $item['item_title'] ) ) { ?>
								<h6 class="title">
									<?php echo esc_html( $item['item_title'] ); ?>
								</h6>
							<?php } ?>

							<?php
							if ( ! in_array( $list_style, array(
								'auto-numbered',
								'manual-numbered',
							) ) ) { ?>
								<?php if ( isset( $item['item_desc'] ) ) { ?>
									<div class="desc">
										<?php echo esc_html( $item['item_desc'] ); ?>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>

					<?php
					if ( in_array( $list_style, array(
						'auto-numbered',
						'manual-numbered',
					) ) ) { ?>
						<?php if ( isset( $item['item_desc'] ) ) { ?>
							<div class="desc">
								<?php echo esc_html( $item['item_desc'] ); ?>
							</div>
						<?php } ?>
					<?php } ?>

					<?php if ( isset( $link['url'] ) && $link['url'] !== '' ) { ?>
				</a>
			<?php } ?>

			</div>
		<?php } ?>
	</div>

	<?php if ( $widget_title !== '' ) : ?>
</div>
<?php endif; ?>
