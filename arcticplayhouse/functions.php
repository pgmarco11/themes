<?php
// ** Actions ** //
// Add theme support for menus
add_action( 'after_setup_theme', 'theme_setup' );
function theme_setup() {
	add_theme_support( 'custom-header' );	
    add_theme_support( 'menus' );
	    // Register menu locations
		register_nav_menus( array(
			'main' => 'Main Menu', 
			'footer' => 'Footer Menu',
			'shows' => 'Shows Menu'
		) );
}
// ** Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'load_styles_scripts' );
function load_styles_scripts() {
  // Register Fonts
  wp_enqueue_style('google-fonts-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:400,300,600,600italic,700,400italic,300italic,800', array(), null);
  
  $theme_version = wp_get_theme()->get('Version');

  // Enqueue the minified style if it exists
  if (file_exists(get_template_directory() . '/style.min.css')) {
	  wp_enqueue_style('min-style', get_template_directory_uri() . '/style.min.css', array(), $theme_version);
  } else {
	  // Fallback to the regular style.css if the minified one doesn't exist
	  wp_enqueue_style('style', get_stylesheet_uri(), array(), $theme_version);
  }

  // Enqueue Bootstrap from CDN
  wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', array(), '4.5.2', 'all');
  // Enqueue Theme Style
  wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), $theme_version, 'all');
  // Enqueue scripts
  wp_enqueue_script('jquery');
  wp_enqueue_script('popper-js', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js', array('jquery'), '2.5.4', true);
  wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'), '4.5.2', 'all');
}
// ** Creates custom permalinks for shows post type, includes year and post name in the URL
add_action('init', 'playhouse_rewrite');
function playhouse_rewrite() {
    global $wp_rewrite;
    $wp_rewrite->add_permastruct('shows', 'shows/%year%/%postname%/', true, 1);
    add_rewrite_rule('shows/([0-9]{4})/(.+)/?$', 'index.php?post_type=shows&name=$matches[2]&year=$matches[1]', 'top');
    $wp_rewrite->flush_rules();
}
// ** Ensures admin script is only loaded when editing post type shows
add_action( 'admin_enqueue_scripts', 'load_admin_scripts' );
function load_admin_scripts( $hook ) {
	$post = get_post_type();
    if ( $post != 'shows' ) { 
    	return;
	} else {
	// Load the scripts & styles below only if we're creating/updating the post
		if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
				wp_enqueue_script( 'admin_scripts', get_template_directory_uri() . 'includes/js/req_admin.js', array( 'jquery' ) );
		}
	}
}
// ** Includes ** //
// ** custom post type shows
require_once('includes/show-manager.php');

// ** custom filters
require_once('includes/custom-filters.php');

// ** Functions ** //
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'page-featured-image-wide' , 970, 362, array('center', 'top'));
	add_image_size( 'page-featured-image' , 480, 362, true);
	add_image_size( 'home-slider-image' , 325, 325, false);
	add_image_size( 'home-events-image' , 220, 220, false);
	add_image_size( 'shows-image' , 320, 320, false);
	add_image_size( 'post-thumb' , 260, 175, false);
}
// ** Register Sidebars
if ( function_exists( 'register_sidebar' ) ) 
	{ 
			register_sidebar( array (
				'name' => 'All Pages',
				'id' => 'all-pages-widgets',
				'description' => 'Widgets place here will go on all sidebar pages',
				'before_widget' => '<div id="two-col" class="d-flex justify-content-end w-100 sidebar">',
				'after_widget' => '</div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			) );
			register_sidebar( array (
				'name' => 'Contact Page',
				'id' => 'contact-widgets',
				'description' => 'Widgets place here will go on the Contact page',
				'before_widget' => '<div id="two-col" class="d-flex justify-content-end w-100 sidebar">',
				'after_widget' => '</div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			) );	
			register_sidebar( array (
				'name' => 'Homepage Widget',
				'id' => 'homepage-widgets',
				'description' => 'Widgets placed here will go on the homepage above the footer',
				'before_widget' => '<aside id="col%1$s" class="d-flex justify-content-start front-widgets">',
				'after_widget' => '</aside>',
				'before_title' => '<h2>',
				'after_title' => '</h2>'
			) );
			register_sidebar( array (
				'name' => 'Supporters',
				'id' => 'supporters-widget',
				'description' => 'Widgets place here will go on the home page under supporters',
				'before_widget' => '<li>',
				'after_widget' => '</li>',
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			) );
			register_sidebar( array (
				'name' => 'Blog Pages',
				'id' => 'blog-pages-widgets',
				'description' => 'Widgets place here will go on all blog pages',
				'before_widget' => '<div id="two-col%1$s" class="d-flex justify-content-end w-100 sidebar">',
				'after_widget' => '</div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			) );
			register_sidebar( array (
				'name' => 'Footer Nav',
				'id' => 'footer-nav-widgets',
				'description' => 'Widgets place here will go in the navigation menu in footer above the footer widgets',
				'before_widget' => '<div class="widget widget_footer"><div class="card-body">',
				'after_widget' => '</div></div>',
				'before_title' => '<h3 class="card-title text-white">',
				'after_title' => '</h3>'
			) );
			register_sidebar( array (
				'name' => 'Footer',
				'id' => 'footer-widgets',
				'description' => 'Widgets place here will go in footer to the left contact us',
				'before_widget' => '<div class="widget widget_footer"><div class="card-body">',
				'after_widget' => '</div></div>',
				'before_title' => '<h3 class="card-title text-white">',
				'after_title' => '</h3>'
			) );
			register_sidebar( array (
				'name' => 'Contact Us',
				'id' => 'contactus-widget',
				'description' => 'Widgets place here will go in the footer for the contact information',
				'before_widget' => '<div class="widget widget_contact d-flex justify-content-end"><div class="card-body">',
				'after_widget' => '</div></div>',
				'before_title' => '<h3 class="card-title text-white">',
				'after_title' => '</h3>'
			) );
}