<?php

class WPBakeryShortCode_TM_Mailchimp_Form_Popup extends WPBakeryShortCode {

	function __construct( $settings ) {
		parent::__construct( $settings );

		global $post;
		if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'tm_mailchimp_form_popup' ) ) {
			add_action( 'wp_footer', array( $this, 'mailchimp_form_popup_template' ) );
		}
	}

	function mailchimp_form_popup_template() {
		$form_id = Mitech_Helper::get_mailchimp_form_id();

		if ( $form_id === '' ) {
			return;
		}
		?>
		<div class="mailchimp-form-popup">
			<div class="inner">
				<div id="mailchimp-form-popup-close" class="mailchimp-form-popup-close">
					<span class="fal fa-times"></span>
				</div>
				<div class="form-subscribe">
					<?php mc4wp_show_form( $form_id ); ?>
				</div>
			</div>
		</div>
		<?php
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Mailchimp Form Popup', 'mitech' ),
	'base'                      => 'tm_mailchimp_form_popup',
	'category'                  => MITECH_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-mailchimp-form',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'heading'     => esc_html__( 'Style', 'mitech' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'mitech' ) => '01',
			),
			'std'         => '01',
		),
		array(
			'heading'    => esc_html__( 'Heading', 'mitech' ),
			'type'       => 'textfield',
			'param_name' => 'heading',
			'std'        => esc_html__( 'Subscribe', 'mitech' ),
		),
		array(
			'heading'     => esc_html__( 'Form Id', 'mitech' ),
			'description' => esc_html__( 'Input the id of form. Leave blank to show default form.', 'mitech' ),
			'type'        => 'textfield',
			'param_name'  => 'form_id',
		),
		Mitech_VC::extra_class_field(),
	),
) );
