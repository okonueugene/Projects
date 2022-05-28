<?php
defined( 'ABSPATH' ) || exit;

$style      = $el_class = $items = $loop = $equal_height = $auto_play = $v_center = $h_center = $fw_image = $nav = $pagination = '';
$image_size = $image_size_width = $image_size_height = '';
$atts       = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id     = uniqid( 'tm-slider-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$items = (array) vc_param_group_parse_atts( $items );

if ( count( $items ) <= 0 ) {
	return;
}

$css_class = 'tm-slider-parallel-scroll mitech-swiper mitech-swiper-linked-yes';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style";

if ( $text_align !== '' ) {
	$css_class .= " align-$text_align";
}

$css_class .= Mitech_Helper::get_animation_classes();

$main_slider_slides_html   = '';
$thumbs_slider_slides_html = '';
$loop_count                = 0;

foreach ( $items as $item ) {
	$slide_html = '';
	ob_start();
	?>
	<div class="swiper-slide">
		<div class="swiper-slide-inner">
			<?php
			$_flag = false;
			if ( isset( $item['link'] ) ) {
				$link = vc_build_link( $item['link'] );
				if ( $link['url'] !== '' ) {
					$_target = $link['target'] !== '' ? ' target="_blank"' : '';
					$_title  = $link['title'] !== '' ? ' title="' . esc_attr( $link['title'] ) . '"' : '';
					echo '<a href="' . esc_url( $link['url'] ) . '"' . $_target . $_title . ' class="link-secret">';
					$_flag = true;
				}
			}
			?>
			<?php if ( isset( $item['image'] ) ) : ?>
				<div class="image-wrap">
					<div class="image">
						<?php Mitech_Image::the_attachment_by_id( array(
							'id'     => $item['image'],
							'size'   => $image_size,
							'width'  => $image_size_width,
							'height' => $image_size_height,
						) ); ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="slider-content">
				<?php if ( isset( $item['title'] ) ) : ?>
					<h5 class="heading"><?php echo esc_html( $item['title'] ); ?></h5>
				<?php endif; ?>

				<?php if ( isset( $item['text'] ) ) : ?>
					<div class="text"><?php echo esc_html( $item['text'] ); ?></div>
				<?php endif; ?>
			</div>

			<?php
			if ( $_flag === true ) {
				echo '</a>';
			}
			?>
		</div>
	</div>
	<?php
	$slide_html = ob_get_clean();
	if ( $loop_count % 2 === 0 ) { // Main slides.
		$main_slider_slides_html .= $slide_html;
	} else {
		$thumbs_slider_slides_html .= $slide_html;
	}

	$loop_count++;
}
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="mitech-main-swiper tm-swiper equal-height"
	     data-looped-slides="6"
	     data-lg-items="auto"
	     data-loop="1"

		<?php if ( $gutter > 1 ) : ?>
			data-lg-gutter="<?php echo esc_attr( $gutter ); ?>"
		<?php endif; ?>

		<?php if ( $auto_play !== '' ) : ?>
			data-autoplay="<?php echo esc_attr( $auto_play ); ?>"
		<?php endif; ?>
	>
		<div class="swiper-inner">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php echo $main_slider_slides_html; ?>
				</div>
			</div>
		</div>
	</div>

	<div class="mitech-thumbs-swiper tm-swiper equal-height"
	     data-looped-slides="6"
	     data-lg-items="auto"
	     data-loop="1"

		<?php if ( $gutter > 1 ) : ?>
			data-lg-gutter="<?php echo esc_attr( $gutter ); ?>"
		<?php endif; ?>
	>
		<div class="swiper-inner">
			<div class="swiper-container" dir="rtl">
				<div class="swiper-wrapper">
					<?php echo $thumbs_slider_slides_html; ?>
				</div>
			</div>
		</div>
	</div>
</div>
