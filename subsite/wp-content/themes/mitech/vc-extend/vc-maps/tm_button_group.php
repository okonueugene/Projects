<?php

class WPBakeryShortCode_TM_Button_Group extends WPBakeryShortCodesContainer {

	public function get_inline_css( $selector = '', $atts ) {
		global $mitech_shortcode_lg_css;
		global $mitech_shortcode_md_css;
		global $mitech_shortcode_sm_css;
		global $mitech_shortcode_xs_css;
		$tmp = '';

		if ( $atts['gutter'] !== '' ) {
			$_gutter                 = $atts['gutter'] / 2;
			$tmp                     .= "margin: -{$_gutter}px;";
			$mitech_shortcode_lg_css .= "$selector > div { padding: {$_gutter}px; }";
		}

		if ( $atts['v_align'] === 'top' ) {
			$tmp .= 'align-items: flex-start;';
		} elseif ( $atts['v_align'] === 'center' ) {
			$tmp .= 'align-items: center;';
		} elseif ( $atts['v_align'] === 'bottom' ) {
			$tmp .= 'align-items: flex-end;';
		}

		if ( $atts['align'] === 'left' ) {
			$tmp .= 'justify-content: flex-start;';
		} elseif ( $atts['align'] === 'center' ) {
			$tmp .= 'justify-content: center;';
		} elseif ( $atts['align'] === 'right' ) {
			$tmp .= 'justify-content: flex-end;';
		}

		if ( $tmp !== '' ) {
			$mitech_shortcode_lg_css .= "$selector { $tmp }";
		}

		$tmp = '';
		if ( $atts['md_align'] !== '' ) {
			if ( $atts['md_align'] === 'left' ) {
				$tmp .= 'justify-content: flex-start;';
			} elseif ( $atts['md_align'] === 'center' ) {
				$tmp .= 'justify-content: center;';
			} elseif ( $atts['md_align'] === 'right' ) {
				$tmp .= 'justify-content: flex-end;';
			}

			$mitech_shortcode_md_css .= "$selector { $tmp }";
		}

		$tmp = '';
		if ( $atts['sm_align'] !== '' ) {
			if ( $atts['sm_align'] === 'left' ) {
				$tmp .= 'justify-content: flex-start;';
			} elseif ( $atts['sm_align'] === 'center' ) {
				$tmp .= 'justify-content: center;';
			} elseif ( $atts['sm_align'] === 'right' ) {
				$tmp .= 'justify-content: flex-end;';
			}

			$mitech_shortcode_sm_css .= "$selector { $tmp }";
		}

		$tmp = '';
		if ( $atts['xs_align'] !== '' ) {
			if ( $atts['xs_align'] === 'left' ) {
				$tmp .= 'justify-content: flex-start;';
			} elseif ( $atts['xs_align'] === 'center' ) {
				$tmp .= 'justify-content: center;';
			} elseif ( $atts['xs_align'] === 'right' ) {
				$tmp .= 'justify-content: flex-end;';
			}

			$mitech_shortcode_xs_css .= "$selector { $tmp }";
		}

		Mitech_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                    => esc_html__( 'Button Group', 'mitech' ),
	'base'                    => 'tm_button_group',
	'as_parent'               => array( 'only' => 'tm_button,tm_heading' ),
	'content_element'         => true,
	'show_settings_on_create' => false,
	'is_container'            => true,
	'category'                => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                    => 'insight-i insight-i-divider',
	'js_view'                 => 'VcColumnView',
	'params'                  => array_merge( Mitech_VC::get_alignment_fields( array( 'first_element' => true ) ), array(
		array(
			'heading'    => esc_html__( 'Content position', 'mitech' ),
			'type'       => 'dropdown',
			'param_name' => 'v_align',
			'value'      => array(
				esc_html__( 'Default', 'mitech' ) => '',
				esc_html__( 'Top', 'mitech' )     => 'top',
				esc_html__( 'Center', 'mitech' )  => 'center',
				esc_html__( 'Bottom', 'mitech' )  => 'bottom',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Gutter', 'mitech' ),
			'type'       => 'number',
			'param_name' => 'gutter',
			'step'       => 1,
			'suffix'     => 'px',
		),
		Mitech_VC::extra_class_field(),
	), Mitech_VC::get_vc_spacing_tab(), Mitech_VC::get_custom_style_tab() ),
) );

