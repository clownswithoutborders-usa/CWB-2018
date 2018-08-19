<?php
/**
 * Clowns Without Borders USA functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CWB-USA
 */

if ( ! function_exists( 'cwb_usa_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cwb_usa_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Clowns Without Borders USA, use a find and replace
	 * to change 'cwb-usa' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'cwb-usa', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'hero', 1600, 750, true );
	add_image_size( 'projectfeature', 600, 400, true );
	//add_image_size( 'masonrythumb', 273, 3000 );
	add_image_size( 'masonrythumbbig', 370, 3000 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'cwb-usa' ),
		'projects' => esc_html__( 'Our Work Section Menu', 'cwb-usa' ),
		'about' => esc_html__( 'About Us Section Menu', 'cwb-usa' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'cwb_usa_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'cwb_usa_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cwb_usa_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cwb_usa_content_width', 960 );
}
add_action( 'after_setup_theme', 'cwb_usa_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cwb_usa_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'cwb-usa' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'cwb-usa' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Pages Sidebar', 'cwb-usa' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'cwb-usa' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'cwb_usa_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cwb_usa_scripts() {
	wp_enqueue_style( 'cwb-usa-style', get_stylesheet_uri() );

	wp_enqueue_style( 'foundation-style', get_stylesheet_directory_uri() . '/css/foundation.min.css' );

	wp_enqueue_style( 'css-style', get_stylesheet_directory_uri() . '/css/style.css' );

	wp_enqueue_script( 'cwb-usa-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'cwb-usa-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	//wp_enqueue_script( 'isotope' , get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), '20150415', true );

	//wp_enqueue_script( 'imagesLoaded', get_stylesheet_directory_uri() . '/js/imagesloaded.pkgd.min.js');

	wp_enqueue_script( 'cwb-usa-app-js', get_stylesheet_directory_uri() . '/js/app.js', array( 'jquery' ), '20161019', false );
	wp_enqueue_script( 'cwb-usa-foundation-js', get_stylesheet_directory_uri() . '/js/vendor/foundation.min.js', array(), '20161019', false );
	wp_enqueue_script( 'cwb-usa-what-input-js', get_stylesheet_directory_uri() . '/js/vendor/what-input.js', array(), '20161019', false );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cwb_usa_scripts' );

function photoswipe_scripts() {
	wp_enqueue_script(
		'photoswipe-ui',
		get_template_directory_uri() . '/js/photoswipe-ui-default.min.js',
		array( 'jquery' ),
		'1.0.0',
		true
	);
	wp_enqueue_script(
		'photoswipe',
		get_template_directory_uri() . '/js/photoswipe.js',
		array( 'jquery' ),
		'1.0.0',
		true
	);
	wp_enqueue_style( 'photoswipe-style', get_template_directory_uri() . '/css/photoswipe.css' );
	wp_enqueue_style( 'photoswipe-skin', get_template_directory_uri() . '/css/default-skin.css' );
}
add_action( 'wp_enqueue_scripts', 'photoswipe_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}


/**
 * Extend WordPress search to include custom fields
 *
 * http://adambalee.com
 */

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {    
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
    
    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $wpdb;
   
    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

function add_post_types_to_loop_and_feed($query) {
    if ( is_home() && $query->is_main_query() ) 
        $query->set('post_type', array('post', 'update'));
    return $query;
}
 
add_action('pre_get_posts', 'add_post_types_to_loop_and_feed');

function cwb_members_showall($query) {
	if ( is_admin() ) {
		return;
	}
	if ( $query->is_post_type_archive( 'member' ) && $query->is_main_query() ) {
		$query->set( 'posts_per_page', -1 );
	}
}
add_action( 'pre_get_posts', 'cwb_members_showall' );

// so we can put a loop of 1 recent project anywhere
function recent_project_shortcode( $attr ) {
	ob_start();
	get_template_part('template-parts/shortcode-recent-project');
	return ob_get_clean();
	}
add_shortcode( 'recent-project', 'recent_project_shortcode' );

// so we can put a loop of 1 recent blog post anywhere
function recent_blog_shortcode( $attr ) {
	ob_start();
	get_template_part('template-parts/shortcode-recent-post');
	return ob_get_clean();
	}
add_shortcode( 'recent-blog', 'recent_blog_shortcode' );

// so we can put a loop of 1 featured project anywhere
function featured_project_shortcode( $attr ) {
	ob_start();
	get_template_part('template-parts/shortcode-featured-project');
	return ob_get_clean();
	}
add_shortcode( 'featured-project', 'featured_project_shortcode' );

//dashboard documentation about shortcodes
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

	function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_help_widget', 'Heading of Custom Dashboard Widget', 'custom_dashboard_help');
	}

	function custom_dashboard_help() {
	echo '<p>Recent and featured posts or projects shortcodes.</p>
	<p>For the single most recent project, enter shortcode [recent-project]</p>
	<p>For the single most recent blog post (includes project blog posts), enter shortcode [recent-blog]</p>
	<p>For the single currently featured project, enter shortcode [featured-project]</p>
	<p>To set the featured project, see Options.</p>';
}