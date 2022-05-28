<?php
$text = Mitech::setting( 'top_bar_style_01_text' );
?>
<div <?php Mitech::top_bar_class(); ?>>
	<div class="container">
		<div class="row row-eq-height">
			<div class="col-md-12">
				<div class="top-bar-wrap top-bar-center">
					<?php echo '<div class="top-bar-text">' . $text . '</div>' ?>
				</div>
			</div>
		</div>
	</div>
</div>
