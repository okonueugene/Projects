<div class="post-author">
	<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
		<?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
		<?php the_author(); ?>

	</a>
</div>
