<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Light
 * @since Light 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="section">
			<div class="site-info">
				<?php printf( __( 'Powered by %s', 'light' ), 'WordPress' ); ?>
				<?php if ( function_exists('wpe_echo_powered_by_html') ) { ?>
					<span class="sep"> | </span>
					<?php wpe_echo_powered_by_html(); ?>
				<?php } ?>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>