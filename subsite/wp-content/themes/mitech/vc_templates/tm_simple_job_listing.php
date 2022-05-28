<?php
defined( 'ABSPATH' ) || exit;

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );
$jobs = (array) vc_param_group_parse_atts( $jobs );
if ( count( $jobs ) < 1 ) {
	return;
}

$css_id = uniqid( 'tm-simple-job-listing-' );
$this->get_inline_css( '#' . $css_id, $atts );

$css_class = 'tm-simple-job-listing';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= Mitech_Helper::get_animation_classes( $animation );
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div clas="list">
		<?php
		foreach ( $jobs as $job ) {
			$button = vc_build_link( $job['button'] );
			?>
			<div class="item">
				<div class="row">
					<div class="col-md-3">
						<div class="job-info">
							<h4 class="job-name"><?php echo esc_html( $job['name'] ); ?></h4>
							<span class="job-time"><?php echo esc_html( $job['time'] ); ?></span>
						</div>
					</div>

					<div class="col-md-6">
						<div class="job-description"><?php echo esc_html( $job['description'] ); ?></div>
					</div>

					<div class="col-md-3">
						<div class="job-button"><?php if ( $button['url'] !== '' && $button['title'] !== '' ): ?>
								<a class="tm-button style-solid tm-button-nm" href="<?php echo esc_url( $button['url'] ); ?>"
									<?php if ( $button['target'] !== '' ) {
										echo 'target="' . $button['target'] . '"';
									} ?>
								>
				<span class="button-text" data-text="<?php echo esc_attr( $button['title'] ); ?>">
					<?php echo esc_html( $button['title'] ); ?>
				</span>
								</a>
							<?php endif; ?></div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
