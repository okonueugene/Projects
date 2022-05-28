<?php
$number_post = Mitech::setting( 'case_study_related_number' );
$results     = Mitech_Case_Study::instance()->get_related_items( array(
	'post_id'      => get_the_ID(),
	'number_posts' => $number_post,
) );
?>
<?php if ( $results !== false && $results->have_posts() ) : ?>
	<div class="related-case-study case-study-overlay-faded">
		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<h3 class="related-case-study-title">
						<?php echo Mitech::setting( 'case_study_related_title' ); ?>
					</h3>

					<div class="mitech-swiper tm-swiper nav-style-02"
					     data-lg-items="3"
					     data-md-items="2"
					     data-xs-items="1"
					     data-lg-gutter="30"
					     data-nav="1"
					     data-loop="1"
					>
						<div class="swiper-inner">
							<div class="swiper-container">
								<div class="swiper-wrapper">
									<?php while ( $results->have_posts() ) : $results->the_post(); ?>
										<div class="swiper-slide">
											<div class="post-wrapper">
												<a href="<?php the_permalink(); ?>" class="post-permalink">
													<div class="post-thumbnail">
														<?php
														if ( has_post_thumbnail() ) { ?>
															<?php
															Mitech_Image::the_post_thumbnail( array(
																'size'   => 'custom',
																'width'  => 480,
																'height' => 480,
															) );
															?>
															<?php
														} else {
															Mitech_Templates::image_placeholder( 480, 480 );
														}
														?>
														<?php get_template_part( 'loop/case-study/overlay', 'faded' ); ?>
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
			</div>
		</div>
	</div>
<?php endif;
wp_reset_postdata();
