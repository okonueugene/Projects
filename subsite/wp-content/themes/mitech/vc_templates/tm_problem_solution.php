<?php
defined( 'ABSPATH' ) || exit;

$style = '';
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

$items = (array) vc_param_group_parse_atts( $items );

if ( count( $items ) < 1 ) {
	return;
}

$css_id = uniqid( 'tm-problem-solution-' );
$this->get_inline_css( '#' . $css_id, $atts );

$css_class = 'tm-problem-solution';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-{$style}";

$css_class .= Mitech_Helper::get_animation_classes();
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">

	<div class="row">
		<div class="col-md-4">
			<h4 class="label problem-label"><?php echo wp_kses( $problem_label, 'mitech-default' ); ?></h4>
		</div>
		<div class="col-md-push-1 col-md-7">
			<h4 class="label solution-label"><?php echo wp_kses( $solution_label, 'mitech-default' ); ?></h4>
		</div>
	</div>

	<?php foreach ( $items as $item ) { ?>
		<div class="item">
			<div class="row">
				<div class="col-md-4">
					<h6 class="problem"><?php echo wp_kses( $item['problem'], 'mitech-default' ); ?></h6>
				</div>
				<div class="col-md-push-1 col-md-7">
					<div class="solution">
						<?php echo wp_kses( $item['solution'], 'mitech-default' ); ?>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
