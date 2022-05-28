<?php
$text = Mitech::setting( 'top_bar_style_03_text' );
?>
<div <?php Mitech::top_bar_class(); ?>>
	<div class="container">
		<div class="row row-eq-height">
			<div class="col-md-12">
				<div class="top-bar-wrap">
					<div class="top-bar-left">
						<?php echo '<div class="top-bar-text">' . $text . '</div>' ?>
					</div>

					<div class="top-bar-right">
						<?php Mitech_Templates::top_bar_info(); ?>
						<?php Mitech_Templates::top_bar_social_networks(); ?>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
