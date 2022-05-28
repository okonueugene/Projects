<?php
defined( 'ABSPATH' ) || exit;

$el_class = $style = $items = $multi_open = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-accordion-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$items = (array) vc_param_group_parse_atts( $items );

if ( count( $items ) <= 0 ) {
	return;
}

$css_class = 'tm-accordion';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

$css_class .= Mitech_Helper::get_animation_classes();

wp_enqueue_script( 'mitech-accordion' );

if ( is_numeric( $open_index ) ) {
	$open_index = intval( $open_index );
} else {
	$open_index = 0;
}

?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
	<?php
	if ( $multi_open === '1' ) {
		echo 'data-multi-open="1"';
	}
	?>
>
	<?php
	$i = 1;
	foreach ( $items as $item ) {
		$item_class = 'accordion-section';
		if ( $open_index === $i ) {
			$item_class .= ' active';
		}
		?>

		<div class="<?php echo esc_attr( $item_class ); ?>">
			<?php if ( isset( $item['title'] ) ) { ?>
				<div class="accordion-title-wrapper">
					<h6 class="accordion-title"><?php echo esc_html( $item['title'] ); ?><span
							class="accordion-icon"></span></h6>
				</div>
			<?php } ?>
			<div class="accordion-content"
				<?php if ( $open_index === $i ) {
					echo 'style="display: block;"';
				} ?>
			>
				<?php if ( isset( $item['content'] ) ) : ?>
					<?php echo wp_kses( $item['content'], 'mitech-default' ); ?>
				<?php endif; ?>
			</div>
		</div>
		<?php
		$i++;
	}
	?>
</div>
