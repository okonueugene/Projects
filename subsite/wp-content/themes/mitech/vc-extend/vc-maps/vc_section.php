<?php
vc_remove_param( 'vc_section', 'css' );

vc_add_params( 'vc_section', array_merge(
	Mitech_VC::get_vc_spacing_tab(),
	Mitech_VC::instance()->get_vc_container_styling_tab(),
	Mitech_VC::instance()->get_vc_container_effect_tab(),
	Mitech_VC::instance()->get_vc_container_separator_tab(),
	Mitech_VC::instance()->get_vc_container_scrolling_effect_tab(),
	Mitech_VC::get_custom_style_tab()
) );
