<?php
defined( 'ABSPATH' ) || exit;

$el_class = $items = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-view-demo-' );
$this->get_inline_css( '#' . $css_id, $atts );
extract( $atts );

$items = (array) vc_param_group_parse_atts( $items );
if ( count( $items ) < 1 ) {
	return;
}

$css_class = 'tm-view-demo';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class    .= ' tm-grid-wrapper filter-style-01';
$grid_classes = 'tm-grid modern-grid';
$grid_classes .= Mitech_Helper::get_grid_animation_classes();

$filters = array();
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php
	ob_start();
	?>

	<div class="<?php echo esc_attr( $grid_classes ); ?>">
		<?php
		foreach ( $items as $item ) {
			if ( ! isset( $item['image'] ) ) {
				continue;
			}

			$classes = 'grid-item';
			if ( isset( $item['category'] ) && $item['category'] !== '' ) {
				$categories = explode( ',', $item['category'] );
				foreach ( $categories as $cat ) {
					$cat       = trim( $cat );
					$classes   .= " $cat";
					$filters[] = $cat;
				}
			}

			$query = '';

			if ( isset( $item['page'] ) ) {
				$args = array(
					'post_type'   => 'page',
					'post_status' => 'publish',
					'name'        => $item['page'],
				);

				$query = new WP_Query( $args );
			}

			$link_before = '';
			$link_after  = '';
			$link        = '';
			$has_link    = false;
			$title       = '';

			if ( $query !== '' ) {


				if ( $query->have_posts() ) :
					while ( $query->have_posts() ) :
						$query->the_post();

						$has_link = true;
						$link     = get_the_permalink();

						$title = get_the_title();

					endwhile;
				endif;
			}

			if ( isset( $item['badge'] ) ) {
				if ( $item['badge'] === 'coming' ) {
					$classes .= ' coming-item';
				}
			}

			$alt = $title !== '' ? $title : esc_html__( 'Demo Image', 'mitech' );

			if ( $title === '' && ( isset( $item['title'] ) && $item['title'] !== '' ) ) {
				$title = $item['title'];
			}

			if ( isset( $item['link'] ) && $item['link'] !== '' ) {
				$link = $item['link'];
			}

			if ( $link !== '' ) {
				$link_before .= '<a href="' . esc_url( $link ) . '">';
				$link_after  .= '</a>';
			}
			?>
			<div class="<?php echo esc_attr( $classes ); ?>">
				<div class="item-wrap">
					<?php echo "{$link_before}"; ?>

					<div class="frame-screen">
						<div class="dots">
							<div class="dot"></div>
							<div class="dot"></div>
							<div class="dot"></div>
						</div>
						<div class="thumbnail">
							<?php if ( isset( $item['image'] ) ) : ?>
								<?php
								Mitech_Image::the_attachment_by_id( array(
									'id'   => $item['image'],
									'size' => '480x9999',
									'crop' => false,
								) );
								?>
							<?php endif ?>

							<div class="overlay">
								<div class="btn-view-demo tm-button style-flat tm-button-nm primary-color-important">
									<?php esc_html_e( 'View Demo', 'mitech' ); ?>
								</div>
							</div>

							<?php if ( isset( $item['badge'] ) ) : ?>
								<?php if ( $item['badge'] === 'coming' ) { ?>
									<div class="badge coming">
										<img
											src="<?php echo esc_url( MITECH_THEME_IMAGE_URI . '/soon-badge.png' ); ?>"
											alt="<?php esc_attr_e( 'Coming Soon', 'mitech' ); ?>"/>
									</div>
								<?php } elseif ( $item['badge'] === 'new' ) { ?>
									<div class="badge new">
										<img
											src="<?php echo esc_url( MITECH_THEME_IMAGE_URI . '/new-badge.png' ); ?>"
											alt="<?php esc_attr_e( 'New', 'mitech' ); ?>"/>
									</div>
								<?php } ?>
							<?php endif; ?>
						</div>

						<?php if ( $title !== '' ): ?>
							<div class="info">
								<h3 class="heading">
									<?php echo esc_html( $title ); ?>
								</h3>
							</div>
						<?php endif; ?>
					</div>

					<?php echo "{$link_after}"; ?>
				</div>
			</div>
		<?php } ?>
	</div>

	<?php
	$grid_output = ob_get_contents();
	ob_end_clean();
	?>

	<?php if ( $filter_enable === '1' && ! empty( $filters ) ) { ?>
		<?php
		$filters        = array_unique( $filters );
		$filter_align   = 'center';
		$filter_counter = 0;
		$filter_wrap    = '1';

		$filter_classes = array( 'tm-filter-button-group', $filter_align );
		if ( $filter_counter == 1 ) {
			$filter_classes[] = 'show-filter-counter';
		}
		?>

		<div class="<?php echo implode( ' ', $filter_classes ); ?>"
			<?php if ( $filter_counter == 1 ) : ?>
				data-filter-counter="true"
			<?php endif; ?>
		>
			<?php if ( $filter_wrap == '1' ) { ?>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php } ?>
						<a href="javascript:void(0);" class="btn-filter current"
						   data-filter="*">
							<span class="filter-text"><?php esc_html_e( 'All', 'mitech' ); ?></span>
						</a>
						<?php
						foreach ( $filters as $filter_item ) {
							printf( '<a href="javascript:void(0);" class="btn-filter" data-filter=".%s"><span class="filter-text">%s</span></a>', esc_attr( $filter_item ), $filter_item );
						}
						?>
						<?php if ( $filter_wrap == '1' ) { ?>
					</div>
				</div>
			</div>
		<?php } ?>
		</div>
	<?php } ?>

	<?php echo '' . $grid_output; ?>
</div>
