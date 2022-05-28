<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mitech
 * @since   1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h2 class="screen-reader-text"><?php echo esc_html( get_the_title() ); ?></h2>
	<?php
	the_content();

	Mitech_Templates::page_links();
	?>
</article>
