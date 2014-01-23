<?php
/**
 * Light functions and definitions
 *
 * @package Light
 * @since Light 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Light 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 605; /* pixels */

if ( ! function_exists( 'light_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Light 1.0
 */
function light_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom meta boxes for single posts
	 */
	require( get_template_directory() . '/inc/post-meta.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on light, use a find and replace
	 * to change 'light' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'light', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'light' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
}
endif;
add_action( 'after_setup_theme', 'light_setup' );

if ( ! function_exists( 'light_thumbnails' ) ):
/**
 * Enable support for Post Thumbnails
 *
 * To override these thumbnail settings, just duplicate
 * this function in your child theme
 *
 * @since Light 1.0
 */
function light_thumbnails() {
	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
	add_image_size( 'header-thumbnail', 700, 190, true );
	add_image_size( 'sidecar-thumbnail', 70, 70, true );
}
endif;
add_action( 'after_setup_theme', 'light_thumbnails' );


if ( !function_exists( 'light_widgets_init' ) ) :
/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Light 1.0
 */
function light_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'light' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
endif;
add_action( 'widgets_init', 'light_widgets_init' );

if ( !function_exists( 'light_scripts' ) ) :
/**
 * Enqueue scripts and styles
 *
 * @since Light 1.0
 */
function light_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thlight_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'light_scripts' );


if ( !function_exists( 'light_google_fonts' ) ) :
/**
 * Load webfonts from Google
 *
 * @since Light 1.0
 */

function light_google_fonts() {
	if ( !is_admin() ) {
		wp_register_style( 'light_source_sans', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600', '', null, 'screen' );
		wp_enqueue_style( 'light_source_sans' );
	}
}
endif;

add_action( 'init', 'light_google_fonts' );

if ( ! function_exists( 'light_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own light_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Light 1.0
 */
function light_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'light' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'light' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-author vcard">
				<?php $avatar_size = 55; ?>
				<?php echo get_avatar( $comment, $avatar_size ); ?>
					<?php printf( __( '%s <span class="wrote">wrote:</span>', 'light' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div><!-- .comment-author .vcard -->
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'light' ); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-meta">
				<time pubdate datetime="<?php comment_time( 'c' ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s at %2$s', 'light' ), get_comment_date(), get_comment_time() ); ?>
				</time>
				<?php edit_comment_link( __( '[Edit]', 'light' ), ' ' ); ?>
			</div><!-- .comment-meta .commentmetadata -->

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for light_comment()

/**
 * Title Filter
 *
 * @since Light 1.0
 */
function light_wp_title( $title, $separator ) { // Taken from TwentyTen 1.0
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( 'Search results for %s', '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( 'Page %s', $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( 'Page %s', max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'light_wp_title', 10, 2 );

if ( ! function_exists( 'of_get_option' ) ) :
/**
 * To access theme options, the "Options Framework" plugin must be installed
 * If it's not installed, default settings will be used.
 */
	function of_get_option($name, $default = false) {

	$optionsframework_settings = get_option('optionsframework');

	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];

	if ( get_option($option_name) ) {
		$options = get_option($option_name);
	}

	if ( isset($options[$name]) ) {
		return $options[$name];
	} else {
		return $default;
	}
}
endif;

/**
 * Options file is located in inc/options.php
 *
 * @since Light 1.0
 */
function light_options_framework_location_override() {
    return array('/inc/options.php');
}
add_filter('options_framework_location','light_options_framework_location_override');
