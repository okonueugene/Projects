<header id="page-header" <?php Mitech::header_class(); ?>>
	<div class="page-header-place-holder"></div>
	<div id="page-header-inner" class="page-header-inner" data-sticky="1">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="header-wrap">
							<?php Mitech_THA::instance()->header_wrap_top(); ?>

							<?php get_template_part( 'components/branding' ); ?>

							<div class="header-right">

								<div id="header-right-inner" class="header-right-inner">
									<?php Mitech_THA::instance()->header_right_top(); ?>

									<div class="header-right-clone">
										<?php Mitech_Templates::header_search_form(); ?>
									</div>

									<?php Mitech_Templates::header_info_slider(); ?>

									<?php Mitech_Templates::header_language_switcher(); ?>

									<?php Mitech_Templates::header_social_networks( array( 'style' => 'icons' ) ); ?>

									<?php Mitech_Templates::header_wishlist_button(); ?>

									<?php Mitech_Woo::instance()->render_mini_cart(); ?>

									<?php Mitech_Templates::header_button(); ?>

									<?php Mitech_THA::instance()->header_right_bottom(); ?>
								</div>

								<?php Mitech_Templates::header_open_mobile_menu_button(); ?>

								<?php Mitech_Templates::header_more_tools_button(); ?>
							</div>

							<?php Mitech_THA::instance()->header_wrap_bottom(); ?>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="header-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="header-bottom-inner">
							<div class="header-bottom-left">
								<?php get_template_part( 'components/navigation' ); ?>
							</div>
							<div class="header-bottom-right">
								<?php Mitech_Templates::header_search_form(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</header>
