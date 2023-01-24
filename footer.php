<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CT_Custom
 */
	if ( ! is_active_sidebar( 'footer-1' ) ) {
	return;
}
	if ( ! is_active_sidebar( 'reachus-1' ) ) {
	return;
}

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-footer-left">
			<h1>Contact us</h1>
			<?php dynamic_sidebar( 'footer-1' ); ?>
		</div>

		<div class="site-footer-right">
			<h1>Reach us</h1>
			<?php dynamic_sidebar( 'reachus-1' ); ?>
		</div>
		
		
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
