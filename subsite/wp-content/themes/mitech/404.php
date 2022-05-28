<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link    https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Mitech
 * @since   1.0
 */

get_header( 'blank' );

$image = Mitech::setting( 'error404_page_image' );
$title = Mitech::setting( 'error404_page_title' );
?>
	<div class="page-404-content">
		<div class="container">
			<div class="row row-xs-center full-height">
				<div class="col-md-12">

					<?php if ( $image !== '' ): ?>
						<div class="error-image">
							<img src="<?php echo esc_url( $image ); ?>"
							     alt="<?php esc_attr_e( 'Not Found Image', 'mitech' ); ?>"/>
						</div>
					<?php endif; ?>

					<?php if ( $title !== '' ): ?>
						<h3 class="error-404-title">
							<?php echo wp_kses( $title, 'mitech-default' ); ?>
						</h3>
					<?php endif; ?>

					<div class="error-buttons">
						<div class="tm-button-wrapper">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
							   class="tm-button style-flat has-icon icon-left">
								<span class="button-icon">
									<i class="fa fa-home"></i>
								</span>
								<span class="button-text"><?php esc_html_e( 'Go back to homepage', 'mitech' ); ?></span>
							</a>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
<?php get_footer( 'blank' );
