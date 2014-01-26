<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Light
 * @since Light 1.0
 */
?>

<article id="post-0" class="post hentry no-results not-found">
	<header class="entry-header clearfix">
		<div class="header-padding">
			<h1 class="entry-title"><?php _e( 'Nothing Found', 'light' ); ?></h1>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( is_home() ) { ?>

			<p><?php printf( __( 'Like to publish your first post? <a href="%1$s">Get started here</a>.', 'light' ), admin_url( 'post-new.php' ) ); ?></p>

		<?php } else {
			if ( is_search() ) { ?>

				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'light' ); ?></p>

			<?php } else { ?>

				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'light' ); ?></p>

			<?php } ?>

			<?php get_search_form(); ?>

			<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

			<div class="widget">
				<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'light' ); ?></h2>
				<ul>
				<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
				</ul>
			</div><!-- .widget -->

			<?php
			/* translators: %1$s: smilie */
			$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'light' ), convert_smilies( ':)' ) ) . '</p>';
			the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
			?>

			<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

		<?php } ?>
	</div><!-- .entry-content -->
</article><!-- #post-0 .post .no-results .not-found -->
