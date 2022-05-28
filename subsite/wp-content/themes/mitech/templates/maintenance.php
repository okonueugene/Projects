<?php
/**
 * Template Name: Maintenance
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mitech
 * @since   1.0
 */

get_header( 'blank' );

$logo             = Mitech::setting( 'maintenance_logo' );
$title            = Mitech::setting( 'maintenance_title' );
$text             = Mitech::setting( 'maintenance_text' );
$countdown        = Mitech::setting( 'maintenance_countdown' );
$mailchimp_enable = Mitech::setting( 'maintenance_mailchimp_enable' );
$social_enable    = Mitech::setting( 'maintenance_social_networks_enable' );
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6 left-bg"></div>
		<div class="col-lg-6 right-bg">

			<div class="maintenance-page" id="maintenance-wrap">
				<div class="cs-content-wrapper">

					<?php if ( $logo ) : ?>
						<img src="<?php echo esc_attr( $logo ); ?>"
						     alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="cs-logo"/>
					<?php endif; ?>

					<?php if ( $title !== '' ) : ?>
						<?php echo '<h2 class="cs-title">' . $title . '</h2>'; ?>
					<?php endif; ?>

					<?php if ( $countdown !== '' ) : ?>
						<?php echo do_shortcode( '[tm_countdown datetime="' . $countdown . '" align="center"]' ) ?>
					<?php endif; ?>

					<?php if ( $mailchimp_enable === '1' && function_exists( 'mc4wp_show_form' ) ) : ?>
						<div class="cs-form">
							<?php echo do_shortcode( '[tm_mailchimp_form style="01"]' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $social_enable === '1' ) : ?>
						<div class="maintenance-social-networks">
							<?php echo do_shortcode( '[tm_social_networks style="solid-rounded-icon" align="center"]' ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>

		</div>
	</div>
</div>
<?php get_footer( 'blank' ); ?>
