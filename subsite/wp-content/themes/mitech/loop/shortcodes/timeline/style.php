<?php
$filter_array = array();
foreach ( $items as $key => $row ) {
	$filter_array[] = $row['datetime'];
}

array_multisort( $filter_array, SORT_ASC, $items );
?>
<ul class="tm-timeline-list tm-animation-queue" data-animation-delay="400">
	<div class="line"></div>
	<?php foreach ( $items as $item ) { ?>
		<li class="item">
			<div class="dots">
				<div class="middle-dot"></div>
			</div>

			<div class="row">
				<div class="col-md-6 timeline-col left timeline-feature">
					<div class="inner">
						<?php if ( isset( $item['datetime'] ) ): ?>
							<?php

							$year = date( 'Y', strtotime( $item['datetime'] ) );
							?>
							<div class="date-wrap">
								<h6 class="year">
									<?php echo esc_html( $year ); ?>
								</h6>
							</div>
						<?php endif; ?>

						<?php if ( isset( $item['image'] ) ) : ?>
							<div class="photo">
								<?php
								Mitech_Image::the_attachment_by_id( array(
									'id'   => $item['image'],
									'size' => '500x350',
								) );
								?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-md-6 timeline-col right timeline-info">
					<div class="inner">
						<div class="content-wrap">
							<div class="content-body">
								<?php if ( isset( $item['title'] ) ) : ?>
									<h6 class="heading"><?php echo esc_html( $item['title'] ); ?></h6>
								<?php endif; ?>

								<?php if ( isset( $item['text'] ) ) : ?>
									<div class="text">
										<?php echo wp_kses( $item['text'], 'mitech-default' ); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</li>
	<?php } ?>
</ul>
