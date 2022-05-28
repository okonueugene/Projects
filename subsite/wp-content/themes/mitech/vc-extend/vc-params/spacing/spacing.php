<?php
/*
 * Example
    array(
        'type'       => 'spacing',
        'heading'    => esc_html__( 'Mobile Margin', 'mitech' ),
        'param_name' => 'mobile_margin',
        'step'        => 1,
		'suffix'      => 'px',
		'media_query' => array(
			'top'    => '',
			'bottom' => '',
			'left'   => '',
			'right'  => '',
		),
    ),
*/
if ( ! class_exists( 'Mitech_VC_Spacing' ) ) {
	class Mitech_VC_Spacing {

		private $settings = array();

		private $value = '';

		private $icons = array(
			'top'    => 'fa-arrow-up',
			'bottom' => 'fa-arrow-down',
			'left'   => 'fa-arrow-left',
			'right'  => 'fa-arrow-right',
		);

		/**
		 *
		 * @param array  $settings
		 * @param string $value
		 */
		public function __construct( array $settings, $value ) {
			$this->settings = $settings;
			$this->value    = $value;
		}

		/**
		 * @return array
		 */
		private function get_data() {
			if ( empty( $this->value ) && isset( $this->settings['std'] ) && is_array( $this->settings['std'] ) ) {
				$this->value = $this->parse_default_value( $this->settings['std'] );
			}

			if ( empty( $this->value ) && isset( $this->settings['media_query'] ) && is_array( $this->settings['media_query'] ) ) {
				$this->value = $this->parse_default_value( $this->settings['media_query'] );
			}

			$data     = preg_split( '/;/', $this->value );
			$data_arr = array();

			foreach ( $data as $d ) {
				$pieces = explode( ':', $d );
				if ( count( $pieces ) == 2 ) {
					$key              = $pieces[0];
					$number           = $pieces[1];
					$data_arr[ $key ] = $number;
				}
			}

			return $data_arr;
		}

		private function get_number( $key ) {
			$data_arr = $this->get_data();

			foreach ( $data_arr as $key1 => $number ) {
				if ( $key == $key1 ) {
					return $number;
				}
			}

			return '';
		}

		private function parse_default_value( $media_queries = array() ) {

			$str = '';

			if ( ! empty( $media_queries ) ) {
				foreach ( $media_queries as $key => $value ) {
					$str .= $key . ':' . $value . ';';
				}
			}

			return $str;
		}

		public function render() {
			$param_name   = isset( $this->settings['param_name'] ) ? $this->settings['param_name'] : '';
			$spacing_icon = isset( $this->settings['spacing_icon'] ) ? $this->settings['spacing_icon'] : 'fa-mobile';
			$arr          = array(
				'top',
				'right',
				'bottom',
				'left',
			);
			ob_start();
			?>
			<div class="tm_spacing vc_row vc_ui-flex-row">
				<div class="tm_spacing-layout vc_col-xs-12">
					<input name="<?php echo esc_attr( $param_name ); ?>" class="wpb_vc_param_value" type="hidden"
					       value="<?php echo esc_attr( $this->value ) ?>"/>

					<div class="tm_spacing-field-wrap tm-margin">
						<label><?php esc_html_e( 'Margin', 'mitech' ); ?></label>
						<?php foreach ( $arr as $value ) : ?>
							<input type="number"
							       class="tm_spacing-item <?php echo esc_attr( 'tm_spacing-' . $value ); ?>"
							       value="<?php echo esc_attr( $this->get_number( 'margin_' . $value ) ); ?>"
							       data-key="<?php echo 'margin_' . $value; ?>"
							       placeholder="-"/>
						<?php endforeach; ?>
						<div class="tm_spacing-field-wrap tm-border">
							<label><?php esc_html_e( 'Border', 'mitech' ); ?></label>
							<?php foreach ( $arr as $value ) : ?>
								<input type="number"
								       class="tm_spacing-item <?php echo esc_attr( 'tm_spacing-' . $value ); ?>"
								       value="<?php echo esc_attr( $this->get_number( 'border_' . $value ) ); ?>"
								       data-key="<?php echo 'border_' . $value; ?>"
								       placeholder="-"/>
							<?php endforeach; ?>
							<div class="tm_spacing-field-wrap tm-padding">
								<label><?php esc_html_e( 'Padding', 'mitech' ); ?></label>
								<?php foreach ( $arr as $value ) : ?>
									<input type="number"
									       class="tm_spacing-item <?php echo esc_attr( 'tm_spacing-' . $value ); ?>"
									       value="<?php echo esc_attr( $this->get_number( 'padding_' . $value ) ); ?>"
									       data-key="<?php echo 'padding_' . $value; ?>"
									       placeholder="-"/>
								<?php endforeach; ?>
								<div class="tm_spacing-icon"><i class="fal <?php echo esc_attr( $spacing_icon ) ?>"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			$output = ob_get_contents();
			ob_clean();

			return $output;
		}
	}
}

if ( class_exists( 'Mitech_VC_Spacing' ) ) {

	function mitech_vc_spacing_settings_field( $settings, $value ) {

		$field = new Mitech_VC_Spacing( $settings, $value );

		return $field->render();
	}

	WpbakeryShortcodeParams::addField( 'spacing', 'mitech_vc_spacing_settings_field', MITECH_THEME_URI . '/vc-extend/vc-params/spacing/scripts.js' );
}
