<?php
$post_options = unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
if ( $post_options !== false && isset( $post_options['post_link'] ) ) {
	$link = $post_options['post_link'];
	?>
	<div class="post-feature post-link">
		<h3 class="link-text"><a href="<?php echo esc_url( $link ); ?>" target="_blank"><?php echo esc_html( $link ); ?></a></h3>
	</div>
<?php } ?>
