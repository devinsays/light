<?php
/**
 * The template for displaying search forms in light
 *
 * @package Light
 * @since Light 1.0
 */
?>
	<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'light' ); ?></label>
		<input type="text" class="search-input" name="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'light' ); ?>" />
		<input type="submit" class="search-submit" name="submit" value="<?php esc_attr_e( '&#59392;', 'light' ); ?>" />
	</form>
