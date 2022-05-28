<?php
$sub_title = Mitech_Helper::get_post_meta( 'page_title_bar_custom_sub_title', '' );
?>

<div id="page-title-bar" <?php Mitech::title_bar_class(); ?>>
	<div class="page-title-bar-overlay"></div>

	<div class="page-title-bar-inner">
		<div class="container">
			<div class="row row-xs-center">
				<div class="col-md-12">
					<?php Mitech_Templates::get_title_bar_title(); ?>

					<?php if ( $sub_title !== '' ) { ?>
						<div class="sub-title"><?php echo esc_html( $sub_title ); ?></div>
					<?php } ?>

					<?php get_template_part( 'components/breadcrumb' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>
