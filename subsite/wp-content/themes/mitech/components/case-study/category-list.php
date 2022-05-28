<div class="archive-case-study-category-list">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="cat-list">
					<?php
					$current_cat = '';
					if ( Mitech_Case_Study::instance()->is_taxonomy() ) {
						$current_cat = get_queried_object()->term_id;
					}

					?>

					<h6 class="cat-item <?php if ( $current_cat === '' ) {
						echo 'current';
					} ?>">
						<a href="<?php echo esc_url( get_post_type_archive_link( 'case_study' ) ); ?>" class="cat-link">
							<?php esc_html_e( 'All', 'mitech' ); ?>
						</a>
					</h6>

					<?php
					$_categories = get_terms( array(
						'taxonomy'   => 'case_study_category',
						'hide_empty' => true,
					) );

					foreach ( $_categories as $term ) {
						$term_link   = get_term_link( $term );
						$cat_classes = 'cat-item';

						if ( $term->term_id === $current_cat ) {
							$cat_classes .= ' current';
						}
						?>
						<h6 class="<?php echo esc_attr( $cat_classes ); ?>">
							<a href="<?php echo esc_url( $term_link ); ?>" class="cat-link">
								<?php echo esc_html( $term->name ); ?>
							</a>
						</h6>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
