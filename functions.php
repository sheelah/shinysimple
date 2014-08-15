<?php
/**
 * shinysimple functions and definitions
 *
 * @package shinysimple
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'shinysimple_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function shinysimple_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on shinysimple, use a find and replace
	 * to change 'shinysimple' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'shinysimple', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	 // This theme styles the visual editor to resemble the theme style.
	$font_base_url = '//fonts.googleapis.com/css';
	$font_query = '?family=Lato:300,400,400italic,700,900,900italic'
			. '|PT+Serif:400,700,400italic,700italic';
	$font_url = $font_base_url . $font_query;
	add_editor_style( array( 'inc/editor-style.css', str_replace( ',', '%2C', $font_url ) ) );


	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('large-thumb', 1060, 650, true);
	add_image_size('index-thumb', 780, 250, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'shinysimple' ),
		'social' => __( 'Social Menu', 'shinysimple'),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array( 'aside' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'shinysimple_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // shinysimple_setup
add_action( 'after_setup_theme', 'shinysimple_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function shinysimple_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'shinysimple' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widgets', 'shinysimple' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Footer widgets area appearing in the site footer.', 'shinysimple' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'shinysimple_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function shinysimple_scripts() {
	wp_enqueue_style( 'shinysimple-style', get_stylesheet_uri() );

	if (is_page_template('page-templates/page-nosidebar.php') || !is_active_sidebar('sidebar-1')) {
		wp_enqueue_style('shinysimple-layout-style', get_template_directory_uri() . '/layout/no-sidebar.css');
	} else {
		wp_enqueue_style( 'shinysimple-layout-style' , get_template_directory_uri() . '/layout/content-sidebar.css');
	}

	$font_base_url = '//fonts.googleapis.com/css';
	$font_query = '?family=Lato:100,300,400,700,900,900italic'
			. '|PT+Serif:400,700,400italic,700italic';
	wp_enqueue_style('shinysimple-google-fonts', $font_base_url . $font_query);

	wp_enqueue_style('shinysimple-font-awesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
	wp_enqueue_script( 'shinysimple-enquire', get_template_directory_uri() . '/js/enquire.min.js', false, '20140429', true );

	wp_enqueue_script( 'shinysimple-superfish', get_template_directory_uri() . '/js/superfish.min.js', array('jquery'), '20140328', true );

	wp_enqueue_script( 'shinysimple-superfish-settings', get_template_directory_uri() . '/js/superfish-settings.js', array('jquery'), '20140328', true );

	wp_enqueue_script( 'shinysimple-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'shinysimple-hide-search', get_template_directory_uri() . '/js/hide-search.js', array('jquery'), '20120206', true );

	wp_enqueue_script( 'shinysimple-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'shinysimple-masonry', get_template_directory_uri() . '/js/masonry-settings.js', array('masonry'), '20140401', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'shinysimple_scripts' );

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
