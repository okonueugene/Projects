<?php
$video = $video_text = '';
extract( $mitech_shortcode_atts );
?>

<a href="<?php echo esc_url( $video ); ?>" class="video-link">
	<div class="video-content">

		<div class="video-play-wrap">
			<div class="video-mark">
				<div class="wave-pulse wave-pulse-1"></div>
				<div class="wave-pulse wave-pulse-2"></div>
			</div>

			<div class="video-play">
				<span class="video-play-icon"></span>
			</div>
		</div>

		<?php if ( $video_text !== '' ) : ?>
			<div class="video-text">
				<?php echo wp_kses( $video_text, 'mitech-default' ); ?>
			</div>
		<?php endif; ?>
	</div>
</a>
