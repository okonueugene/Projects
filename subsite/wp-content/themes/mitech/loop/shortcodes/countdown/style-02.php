<?php
extract( $mitech_shortcode_atts );

wp_enqueue_script( 'time-circle' );
wp_enqueue_script( 'mitech-countdown' );

$primary_color = Mitech::setting( 'primary_color' );
if ( $skin === 'light' ) {
	$circle_bg = 'rgba(255, 255, 255, 0.3)';
} else {
	$circle_bg = '#eeeeee';
}

$days    = isset( $days ) && $days !== '' ? $days : esc_html__( 'Days', 'mitech' );
$hours   = isset( $hours ) && $hours !== '' ? $hours : esc_html__( 'Hours', 'mitech' );
$minutes = isset( $minutes ) && $minutes !== '' ? $minutes : esc_html__( 'Minutes', 'mitech' );
$seconds = isset( $seconds ) && $seconds !== '' ? $seconds : esc_html__( 'Seconds', 'mitech' );
?>

<div class="countdown"
	<?php ?>
	 data-animation="time-circle"
	 data-date="<?php echo esc_attr( $datetime ); ?>"
	 data-circle-background="<?php echo esc_attr( $circle_bg ); ?>"
	 data-time-color="<?php echo esc_attr( $primary_color ); ?>"
	 data-days-text="<?php echo esc_attr( $days ); ?>"
	 data-hours-text="<?php echo esc_attr( $hours ); ?>"
	 data-minites-text="<?php echo esc_attr( $minutes ); ?>"
	 data-seconds-text="<?php echo esc_attr( $seconds ); ?>"
>
</div>
