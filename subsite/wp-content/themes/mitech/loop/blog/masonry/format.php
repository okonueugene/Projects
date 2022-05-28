<?php if ( has_post_thumbnail() ) { ?>
	<div class="post-feature post-thumbnail">
		<a href="<?php the_permalink(); ?>">
			<?php
			Mitech_Image::the_post_thumbnail( array(
				'size'   => 'custom',
				'width'  => 370,
				'height' => 9999,
				'crop'   => false,
			) );
			?>
		</a>
	</div>
<?php } ?>
