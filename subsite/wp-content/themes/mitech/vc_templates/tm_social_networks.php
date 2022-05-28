<?php
defined( 'ABSPATH' ) || exit;

$el_class         = $style = $layout = $tooltip_enable = $tooltip_skin = $use_global = $items = $target = $template = '';
$tooltip_position = 'top';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-social-networks-' );
$this->get_inline_css( "#$css_id", $atts );
Mitech_VC::get_shortcode_custom_css( "#$css_id", $atts );
extract( $atts );

$css_class = 'tm-social-networks';

$el_class = $this->getExtraClass( $el_class );
if ( $el_class !== '' ) {
	$css_class .= " $el_class";
}

$css_class .= " style-$style layout-$layout";

$link_class = 'link';

if ( $tooltip_enable === '1' ) {
	$link_class .= " hint--bounce hint--{$tooltip_position}";

	if ( $tooltip_skin !== '' ) {
		$link_class .= " hint--{$tooltip_skin}";
	}
}

$css_class .= Mitech_Helper::get_animation_classes();

if ( $use_global === '1' ) {
	$social_link = Mitech::setting( 'social_link' );

	if ( ! empty( $social_link ) ) {
		$social_link_target = Mitech::setting( 'social_link_target' );

		ob_start();
		foreach ( $social_link as $_link ) {
			$_icon = $link_content = '';

			if ( isset( $_link['icon_class'] ) && $_link['icon_class'] !== '' ) {
				$icon_class = "{$_link['icon_class']} link-icon";
				$_icon      = '<i class="' . $icon_class . '"></i>';
			}

			if ( in_array( $style, array(
				'icons',
				'large-icons',
				'extra-large-icons',
				'icon-title',
				'flat-rounded-icon',
				'solid-rounded-icon',
			) ) ) {
				$link_content .= $_icon;
			}

			if ( in_array( $style, array( 'title', 'icon-title' ) ) ) {
				$link_content .= '<span class="link-text">' . $_link['tooltip'] . '</span>';
			}
			?>
			<li class="item">
				<a href="<?php echo esc_url( $_link['link_url'] ); ?>"
					<?php if ( $social_link_target === '1' ) : ?>
						target="_blank"
					<?php endif; ?>

					<?php if ( isset( $_link['tooltip'] ) ) : ?>
						aria-label="<?php echo esc_attr( $_link['tooltip'] ); ?>"
					<?php endif; ?>

					<?php if ( $link_class !== '' ): ?>
						class="<?php echo esc_attr( $link_class ); ?>"
					<?php endif; ?>
				>
					<?php echo "{$link_content}"; ?>
				</a>
			</li>
			<?php
		}
		$template .= ob_get_clean();
	}
} else {
	$items = (array) vc_param_group_parse_atts( $items );

	if ( count( $items ) > 0 ) {
		ob_start();
		foreach ( $items as $item ) {
			$_icon      = $link_content = '';
			$icon_class = isset( $item['icon_fontawesome5'] ) ? $item['icon_fontawesome5'] : '';

			if ( $icon_class !== '' ) {
				$icon_class .= ' link-icon';
				$_icon      = '<i class="' . $icon_class . '"></i>';
			}

			if ( in_array( $style, array(
				'icons',
				'large-icons',
				'extra-large-icons',
				'icon-title',
				'flat-rounded-icon',
				'solid-rounded-icon',
			) ) ) {
				$link_content .= $_icon;
			}

			if ( in_array( $style, array( 'title', 'icon-title' ) ) ) {
				$link_content .= '<span class="link-text">' . $item['title'] . '</span>';
			}
			?>
			<li class="item">
				<a href="<?php echo esc_url( $item['link'] ); ?>"
					<?php if ( $target === '1' ): ?>
						target="_blank"
					<?php endif; ?>

					<?php if ( isset( $item['title'] ) ): ?>
						aria-label="<?php echo esc_attr( $item['title'] ); ?>"
					<?php endif; ?>

					<?php if ( $link_class !== '' ): ?>
						class="<?php echo esc_attr( $link_class ); ?>"
					<?php endif; ?>
				>
					<?php echo "{$link_content}"; ?>
				</a>
			</li>
			<?php
		}
		$template .= ob_get_clean();
	}
} ?>

<?php if ( $template !== '' ) : ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
		<?php echo '<ul class="list">' . $template . '</ul>'; ?>
	</div>
<?php endif; ?>
