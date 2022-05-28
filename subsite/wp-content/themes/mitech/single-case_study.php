<?php
/**
 * The template for displaying all single case study posts.
 *
 * @package Mitech
 * @since   1.0
 */
$style = Mitech_Helper::get_post_meta( 'case_study_layout_style', '' );
if ( $style === '' ) {
	$style = Mitech::setting( 'single_case_study_style' );
}

if ( $style === 'blank' ) {
	get_template_part( 'components/case-study/content-single', 'blank' );
} else {
	get_template_part( 'components/case-study/content-single' );
}


