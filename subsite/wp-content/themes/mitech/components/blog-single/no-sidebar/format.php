<?php if ( has_post_thumbnail() ) { ?>
	<div class="entry-post-feature post-thumbnail">
		<?php
		Mitech_Image::the_post_thumbnail( array( 'size' => '1170x570' ) );
		?>
	</div>
<?php } ?>

