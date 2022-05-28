<?php
/**
 * Quickview popup template.
 *
 * @package Mitech
 * @since   1.0
 */

global $post, $product;

add_filter( 'woocommerce_single_product_open_gallery', '__return_false' );
?>
	<div class="woo-quick-view-popup">
		<div class="woocommerce container single-product woo-quick-view-popup-content">
			<div class="product product-container">
				<div class="woo-single-images">
					<?php
					/**
					 * woocommerce_before_single_product_summary hook.
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					do_action( 'woocommerce_before_single_product_summary' );
					?>
				</div>
				<div class="summary entry-summary">
					<div class="inner-content">
						<div class="inner">
							<h2 class="product_title entry-title title-with-link">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<?php
							/**
							 * Hook: woocommerce_single_product_summary.
							 *
							 * @hooked woocommerce_template_single_title - 5
							 * @hooked woocommerce_template_single_rating - 10
							 * @hooked woocommerce_template_single_price - 10
							 * @hooked woocommerce_template_single_excerpt - 20
							 * @hooked woocommerce_template_single_add_to_cart - 30
							 * @hooked woocommerce_template_single_meta - 40
							 * @hooked woocommerce_template_single_sharing - 50
							 * @hooked WC_Structured_Data::generate_product_data() - 60
							 */
							do_action( 'woocommerce_single_product_summary' );
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
//wp_die();
