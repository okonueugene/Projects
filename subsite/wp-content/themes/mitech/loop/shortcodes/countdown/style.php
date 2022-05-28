<?php
extract( $mitech_shortcode_atts );

wp_enqueue_script( 'countdown' );
wp_enqueue_script( 'mitech-countdown' );

$days    = isset( $days ) && $days !== '' ? $days : esc_html__( 'Days', 'mitech' );
$hours   = isset( $hours ) && $hours !== '' ? $hours : esc_html__( 'Hours', 'mitech' );
$minutes = isset( $minutes ) && $minutes !== '' ? $minutes : esc_html__( 'Minutes', 'mitech' );
$seconds = isset( $seconds ) && $seconds !== '' ? $seconds : esc_html__( 'Seconds', 'mitech' );
?>
<div class="countdown"
     data-date="<?php echo esc_attr( $datetime ); ?>"
     data-days-text="<?php echo esc_attr( $days ); ?>"
     data-hours-text="<?php echo esc_attr( $hours ); ?>"
     data-minutes-text="<?php echo esc_attr( $minutes ); ?>"
     data-seconds-text="<?php echo esc_attr( $seconds ); ?>"
></div>
