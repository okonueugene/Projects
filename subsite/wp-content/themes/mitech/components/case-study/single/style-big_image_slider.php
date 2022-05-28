<?php
$gallery = Mitech_Helper::get_post_meta( 'case_study_gallery', '' );

$class = 'entry-case-study-content-wrap col-md-12';
?>

<div class="row">
	<?php if ( $gallery !== '' || has_post_thumbnail() ) : ?>
		<div class="col-md-12">
			<div class="entry-case-study-feature-wrap">

				<?php Mitech_Case_Study::instance()->entry_video( array( 'position' => 'above' ) ); ?>

				<div class="entry-case-study-feature">

					<?php
					$caption_enable = Mitech::setting( 'single_case_study_feature_caption' );
					$caption_enable = $caption_enable === '1' ? true : false;
					?>

					<div class="mitech-swiper tm-swiper nav-style-02"
					     data-lg-items="1"
					     data-lg-gutter="30"
					     data-auto-height="1"
					     data-nav="1"
					     data-pagination="1"
					     data-loop="1"
					>
						<div class="swiper-inner">
							<div class="swiper-container">
								<div class="swiper-wrapper">

									<?php if ( has_post_thumbnail() ) : ?>
										<div class="swiper-slide">
											<div class="entry-case-study-image">
												<?php
												Mitech_Image::the_post_thumbnail( array(
													'size'           => 'custom',
													'width'          => 1170,
													'height'         => 540,
													'crop'           => true,
													'caption_enable' => $caption_enable,
												) );
												?>
											</div>
										</div>
									<?php endif; ?>

									<?php if ( $gallery !== '' ) : ?>
										<?php foreach ( $gallery as $key => $value ) { ?>
											<div class="swiper-slide">
												<div class="entry-case-study-image">
													<?php Mitech_Image::the_attachment_by_id( array(
														'id'             => $value['id'],
														'size'           => 'custom',
														'width'          => 1170,
														'height'         => 540,
														'crop'           => true,
														'caption_enable' => $caption_enable,
													) );
													?>
												</div>
											</div>
										<?php } ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<?php Mitech_Case_Study::instance()->entry_video( array( 'position' => 'below' ) ); ?>

			</div>
		</div>
	<?php endif; ?>

	<div class="<?php echo esc_attr( $class ); ?>">
		<div class="entry-case-study-content">
			<div class="row">
				<div class="col-md-12">
					<?php Mitech_Case_Study::instance()->entry_categories(); ?>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="entry-case-study-main-info">

						<h3 class="entry-case-study-title"><?php the_title(); ?></h3>

						<div class="entry-case-study-description">
							<?php the_content(); ?>
						</div>

						<?php Mitech_Case_Study::instance()->entry_project_link(); ?>
					</div>
				</div>

				<div class="col-md-6">
					<?php Mitech_Case_Study::instance()->entry_details(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
