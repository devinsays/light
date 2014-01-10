<?php
/**
 * @package Light
 * @since Light 1.0
 */
?>

<?php
	$custom_post_class = null;
	$thumbnail_class = false;
	$light_featured_meta = esc_attr( get_post_meta( $post->ID, 'light_featured_meta', true ) );
	if ( has_post_thumbnail() ) {
		if ( $light_featured_meta ) {
			$thumbnail_class = "header-thumbnail";
		} else {
			$thumbnail_class = "sidecar-thumbnail";
		}
		$custom_post_class = "thumbnail " . $thumbnail_class;
	}	
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($custom_post_class); ?>>
	
	<header class="entry-header clearfix">
		<?php if ( !$light_featured_meta ) { ?>
			<div class="header-padding">
		<?php } ?>
		<?php if ( $thumbnail_class ) { ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( $thumbnail_class ); ?>
			</div>
		<?php } ?>
		<?php if ( $light_featured_meta ) { ?>
			<div class="header-padding">
		<?php } ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<span><?php light_posted_on(); ?></span>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'light' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	
	<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries ?>
		<div id="author-meta" class="clearfix">
			<div id="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'light_author_bio_avatar_size', 68 ) ); ?>
			</div><!-- #author-avatar -->
			<div id="author-description">
				<h3><?php printf( esc_attr__( 'About %s', 'light' ), get_the_author() ); ?></h3>
				<?php the_author_meta( 'description' ); ?>
			</div><!-- #author-description -->
		</div><!-- #author-meta-->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="icon comments-link"><?php comments_popup_link( __( '<span>Comment</span>', 'light' ), __( '1 <span>Comment</span>', 'light' ), __( ' % <span>Comments</span>', 'light' ) ); ?></span>
		<?php endif; ?>
		<?php if ( 'post' == get_post_type() ) :?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'light' ) );
				if ( $categories_list && light_categorized_blog() ) :
			?>
			<span class="sep"> | </span>
			<span class="icon cat-links">
				<?php printf( __( '<span>Posted in</span> %1$s', 'light' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'light' ) );
				if ( $tags_list ) :
			?>
			<span class="sep"> | </span>
			<span class="icon tag-links">
				<?php printf( __( '<span>Tagged</span> %1$s', 'light' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php edit_post_link( __( 'Edit', 'light' ), '<span class="sep"> | </span><span class="icon edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->

</article><!-- #post-<?php the_ID(); ?> -->
