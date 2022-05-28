<?php
$video = $video_text = '';
extract( $mitech_shortcode_atts );
?>

<a href="<?php echo esc_url( $video ); ?>" class="video-link">
	<div class="video-content">

		<div class="video-play">
			<span class="video-play-icon">
				<i class="fa fa-play"></i>
			</span>
		</div>

		<?php if ( $video_text !== '' ) : ?>
			<div class="video-text">
				<?php echo wp_kses( $video_text, 'mitech-default' ); ?>
			</div>
		<?php endif; ?>
	</div>
</a>
