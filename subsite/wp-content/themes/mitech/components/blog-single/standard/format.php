<?php if ( has_post_thumbnail() ) { ?>
	<div class="entry-post-feature post-thumbnail">
		<?php
		Mitech_Image::the_post_thumbnail( array(
			'size' => '770x400',
		) );
		?>
	</div>
<?php } ?>

