<?php
$post_options = unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
if ( $post_options !== false && isset( $post_options['post_gallery'] ) ) {
	$gallery = $post_options['post_gallery'];
	?>
	<div class="entry-post-feature post-gallery mitech-swiper tm-swiper nav-style-02" data-nav="1" data-loop="1">
		<div class="swiper-inner">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php foreach ( $gallery as $image ) { ?>
						<div class="swiper-slide">
							<?php Mitech_Image::the_attachment_by_id( array(
								'id'   => $image['id'],
								'size' => '1170x570',
							) ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
