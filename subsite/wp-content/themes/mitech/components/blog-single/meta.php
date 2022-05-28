<div class="entry-post-meta">
	<?php if ( Mitech::setting( 'single_post_author_enable' ) === '1' ) : ?>
		<div class="entry-author-meta">
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
				<?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
				<?php the_author(); ?>

			</a>
		</div>
	<?php endif; ?>

	<?php if ( Mitech::setting( 'single_post_date_enable' ) === '1' ) : ?>
		<div class="post-date">
			<span class="far fa-calendar meta-icon"></span>
			<?php echo get_the_date(); ?></div>
	<?php endif; ?>

	<?php Mitech_Post::instance()->view_count(); ?>

	<?php if ( Mitech::setting( 'single_post_comment_count_enable' ) === '1' ) : ?>
		<div class="post-comments-number">
			<span class="far fa-comment-alt meta-icon"></span>
			<?php
			$comment_count = get_comments_number();
			$comment_count .= $comment_count > 1 ? esc_html__( ' Comments', 'mitech' ) : esc_html__( ' Comment', 'mitech' );
			?>
			<a href="#comments" class="smooth-scroll-link"><?php echo esc_html( $comment_count ); ?></a>
		</div>
	<?php endif; ?>
</div>
