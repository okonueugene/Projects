<?php
defined( 'ABSPATH' ) || exit;

$style = $el_class = $bar_color = $custom_bar_color = $track_color = $custom_track_color = $line_width = $line_cap = $unit = $inner_content = $inner_content_text = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-circle-progress-chart-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$css_class = 'tm-circle-progress-chart';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

$_bar_color      = $_track_color = '';
$primary_color   = Mitech::setting( 'primary_color' );
$secondary_color = Mitech::setting( 'secondary_color' );

switch ( $bar_color ) {
	case 'primary':
		$_bar_color = '{ "color": "' . $primary_color . '" }';
		break;
	case 'secondary':
		$_bar_color = '{ "color": "' . $secondary_color . '" }';
		break;
	case 'custom':
		$_bar_color = '{ "color": "' . $custom_bar_color . '" }';
		break;
	case 'gradient':
		$_bar_color = '{"gradient": ["' . $bar_gradient_color_1 . '", "' . $bar_gradient_color_2 . '"]}';
		break;
	default:
		$_bar_color = '{ "color": "' . $primary_color . '" }';
		break;
}

if ( $track_color === 'primary' ) {
	$_track_color = $primary_color;
} elseif ( $track_color === 'secondary' ) {
	$_track_color = $secondary_color;
} elseif ( $track_color === '' ) {
	$_track_color = '#ededed';
} else {
	if ( $custom_track_color ) {
		$_track_color = $custom_track_color;
	} else {
		$_track_color = 'transparent';
	}
}

$icon_class = '';
if ( isset( $icon_type ) && isset( ${"icon_{$icon_type}"} ) && ${"icon_{$icon_type}"} !== '' ) {
	$icon_class .= esc_attr( ${"icon_{$icon_type}"} );

	vc_icon_element_fonts_enqueue( $icon_type );
}

wp_enqueue_script( 'circle-progress-chart' );

$value = $number / 100;
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
	<?php if ( $inner_content === '' ): ?>
		data-use-number="1"
	<?php endif; ?>
>
	<div class="outer">
		<div class="inner">
			<div class="chart-wrap"
				<?php
				printf( 'style="width: %spx; height: %spx;"', $size + 35, $size );
				?>
			>
				<div class="chart"
				     data-fill="<?php echo esc_attr( $_bar_color ); ?>"
				     data-empty-fill="<?php echo esc_attr( $_track_color ); ?>"
				     data-thickness="<?php echo esc_attr( $line_width ); ?>"
				     data-size="<?php echo esc_attr( $size ); ?>"
				     data-value="<?php echo esc_attr( $value ); ?>"
				     data-line-cap="<?php echo esc_attr( $line_cap ); ?>"

					<?php if ( $reverse === '1' ): ?>
						data-reverse="1"
					<?php endif; ?>

					<?php
					printf( 'style="width: %spx; height: %spx;"', $size, $size );
					?>
				>
					<div class="circle-content">

						<div class="inner-circle">
							<div class="inner-content">

								<?php if ( $inner_content === 'custom_text' ) : ?>
									<h6 class="chart-number"><?php echo esc_html( $inner_content_text ); ?></h6>
								<?php elseif ( $inner_content === 'icon' && isset( ${"icon_$icon_type"} ) && ${"icon_$icon_type"} !== '' ) : ?>
									<div class="chart-icon">
										<?php
										$_args = array(
											'type'         => $icon_type,
											'icon'         => ${"icon_$icon_type"},
											'parent_hover' => ".tm-circle-progress-chart",
										);

										Mitech_Helper::get_vc_icon_template( $_args );
										?>
									</div>
								<?php else: ?>
									<h6 class="chart-number"
									    data-max="<?php echo esc_attr( $number ); ?>"
									    data-units="<?php echo esc_attr( $unit ); ?>">0</h6>
								<?php endif; ?>
							</div>
						</div>

					</div>
				</div>
				<div class="circle-design one"></div>
				<div class="circle-design two"></div>
			</div>

			<?php if ( $title !== '' || $content !== '' ): ?>
				<div class="chart-info">
					<?php if ( isset( $title ) ) : ?>
						<div class="title-wrap"><h6 class="title"><?php echo esc_html( $title ); ?></h6></div>
					<?php endif; ?>

					<?php $content = wpb_js_remove_wpautop( $content ); ?>

					<div class="chart-content">
						<?php echo wp_kses( $content, 'mitech-default' ); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
