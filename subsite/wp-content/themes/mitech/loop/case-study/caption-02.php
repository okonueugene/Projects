<div class="post-info">
	<h3 class="post-title">
		<a href="<?php Mitech_Case_Study::instance()->the_permalink() ?>"><?php the_title(); ?></a>
	</h3>

	<?php Mitech_Case_Study::instance()->the_categories(); ?>

	<div class="post-excerpt">
		<?php Mitech_Templates::excerpt( array(
			'limit' => 28,
			'type'  => 'word',
		) ); ?>
	</div>

	<a href="<?php Mitech_Case_Study::instance()->the_permalink() ?>" class="btn">
					<span class="btn-text">
							<?php esc_html_e( 'View case study', 'mitech' ); ?>
						</span>
		<span class="btn-icon fa fa-long-arrow-right"></span>
	</a>
</div>
