<?php
$number_post = Mitech::setting( 'single_post_related_number' );
$results     = Mitech_Post::instance()->get_related_posts( array(
	'post_id'      => get_the_ID(),
	'number_posts' => $number_post,
) );

if ( $results !== false && $results->have_posts() ) : ?>
	<div class="related-posts">
		<h3 class="related-title">
			<?php esc_html_e( 'Related Posts', 'mitech' ); ?>
		</h3>
		<div class="mitech-swiper tm-swiper"
		     data-lg-items="2"
		     data-xs-items="1"
		     data-pagination="1"
		     data-auto-height="1"
		     data-slides-per-group="inherit"
		>
			<div class="swiper-inner">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php while ( $results->have_posts() ) : $results->the_post(); ?>
							<div class="swiper-slide">
								<div <?php post_class( 'related-post-item' ); ?>>
									<a href="<?php the_permalink(); ?>" class="link-secret">
										<div class="post-wrapper">

											<div class="post-overlay"
												<?php if ( has_post_thumbnail() ) { ?>
													<?php
													$url = Mitech_Image::get_the_post_thumbnail_url( array(
														'size' => '480x315',
													) );
													?>
													style="background-image: url(<?php echo esc_url( $url ); ?>)"
												<?php } ?>
											>
											</div>

											<div class="post-info">
												<?php get_template_part( 'loop/blog/category', 'no-link' ); ?>

												<h3 class="post-title">
													<?php the_title(); ?>
												</h3>
											</div>

										</div>
									</a>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif;
wp_reset_postdata();
