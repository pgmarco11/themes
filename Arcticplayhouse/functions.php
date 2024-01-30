<?php
define( 'TEMPPATH', get_bloginfo('stylesheet_directory'));
define( 'IMAGES', TEMPPATH . "/images");

function my_login_url() { 
	return esc_url( home_url() );
}
add_filter('login_headerurl', 'my_login_url' );

function my_login_logo_url_title()  {
return 'Arctic Playhouse Theatre';
}
add_filter ('login_headertitle', 'my_login_logo_url_title');

$role = get_role('editor'); 
$role->add_cap('edit_theme_options');

function custom_admin_menu() {

    $user = new WP_User(get_current_user_id());     
    if (!empty( $user->roles) && is_array($user->roles)) {
        foreach ($user->roles as $role)
            $role = $role;
    }

    if($role == "editor") { 
       remove_submenu_page( 'themes.php', 'themes.php' );
       remove_submenu_page( 'themes.php', 'nav-menus.php' ); 
    }       
}

add_action('admin_menu', 'custom_admin_menu');

add_action('admin_head', 'my_column_width');

function my_column_width() {
    echo '<style type="text/css">';
    echo '.type-shows .column-cat a { display: block !important; }';
    echo '</style>';
}

/*editor access to mailchimp*/
add_filter( 'mc4wp_settings_cap', 'myprefix_mc4wp_settings_cap' );

function myprefix_mc4wp_settings_cap( $capability ) {
	return 'edit_pages';
}

if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );

$defaults = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 350,
	'height'                 => 180,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => true,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );

}

/* change threecol */
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'page-featured-image' , 480, 362, true);
	add_image_size( 'smallpage-featured-image' , 447, 361, true);
	add_image_size( 'featured-shows' , 580, 310, false);
	add_image_size( 'featured-event' , 430, 310, false);
	add_image_size( 'home-slider-image' , 600, 385, true);
	add_image_size( 'home-events-image' , 220, 175, false);
	add_image_size( 'home-shows-image' , 743, 480, true);
	add_image_size( 'post-thumb' , 260, 175, false );
	add_image_size( 'sm-post-thumb' , 65, 50, false);
}

add_theme_support('nav-menus');

if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'main' => 'Main Nav',
		  'footer' => 'Footer Nav',
		  'shows' => 'Shows Nav'
		)
	);
}

function excerpt_read_more_link($output) {
global $post;
return substr($output,0,-5).'<br/><br/><a href="'. get_permalink($post->ID) . '" class="more"> MORE INFO</a></p>';
}
add_filter('the_excerpt', 'excerpt_read_more_link');

require_once('show-manager.php');

add_action('init', 'playhouse_rewrite');

function playhouse_rewrite() {
	global $wp_rewrite;
	$wp_rewrite->add_permastruct('typename', 'typename/%year%/%postname%/', true, 1);

	add_rewrite_rule('typename/([0-9]{4})/(.+)/?$', 'index.php?typename=$matches[2]', 'top');

	$wp_rewrite->flush_rules();
}


function menu_fix_on_search_page( $query ) {
    if(is_search()){
        $query->set( 'post_type', array( 'page','nav_menu_item', 'shows', 'post'
            ));
          return $query;
    }
}
add_filter( 'pre_get_posts', 'menu_fix_on_search_page' );


// Load admin scripts & styles
function load_admin_scripts( $hook ) {
	$post = get_post_type();
    if ( $post != 'shows' ) { 
    	return;
	} else {
	// Load the scripts & styles below only if we're creating/updating the post
		if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
				wp_enqueue_script( 'admin_scripts', get_template_directory_uri() . '/js/req_admin.js', array( 'jquery' ) );
		}
	}
}
add_action( 'admin_enqueue_scripts', 'load_admin_scripts' );

function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
} 
add_action('loop_start', 'jptweak_remove_share' );

// Genericons stylesheet (Jetpack sharing icons not working)
wp_enqueue_style( 'fonts-genericons', get_template_directory_uri() . '/../../plugins/jetpack/_inc/genericons/genericons/genericons.css', array(), '', 'all' );
wp_enqueue_style( 'social-logos', get_template_directory_uri() . '/../../plugins/jetpack/_inc/social-logos/social-logos.css', array(), '', 'all' );
wp_enqueue_script( 'sharing-js', get_template_directory_uri() . '/../../plugins/jetpack/modules/sharedaddy/sharing.js', array( 'jquery' ) );

if ( function_exists( 'register_sidebar' ) ) 
	{ 
		register_sidebar( array (
			'name' => 'All Pages',
			'id' => 'page-widgets',
			'description' => 'Widgets place here will go all new pages',
			'before_widget' => '<div id="two-col" class="alignright width100 sidebar">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
			) );

		register_sidebar( array (
			'name' => 'Front Widget',
			'id' => 'front-widgets',
			'description' => 'Widgets placed here will go on the homepage above the footer',
			'before_widget' => '<aside id="col%1$s" class="alignleft front-widgets">',
			'after_widget' => '</aside>',
			'before_title' => '<h2>',
			'after_title' => '</h2>'
			) );

			register_sidebar( array (
			'name' => 'Contact Us',
			'id' => 'contactus-widget',
			'description' => 'Widgets place here will go in the footer for the contact information',
			'before_widget' => '<div class="widget widget_contact alignright m5_5right">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
			) );

			register_sidebar( array (
			'name' => 'Supporters',
			'id' => 'support-widget',
			'description' => 'Widgets place here will go on the home page under supporters',
			'before_widget' => '<li>',
			'after_widget' => '</li>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
			) );

			register_sidebar( array (
			'name' => 'Support Us',
			'id' => 'supportus-widget',
			'description' => 'Widgets place here will go on the supporters page',
			'before_widget' => '<aside id="support-nav">',
			'after_widget' => '</aside>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
			) );


			register_sidebar( array (
			'name' => 'Blog Pages',
			'id' => 'blog-widgets',
			'description' => 'Widgets place here will go on all blog pages',
			'before_widget' => '<div id="two-col%1$s" class="alignright width100 sidebar">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
			) );


			register_sidebar( array (
			'name' => 'Footer',
			'id' => 'footer-widget',
			'description' => 'Widgets place here will go in footer to the left of the social icons',
			'before_widget' => '<div class="widget widget_footer">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
			) );
	}


add_action( 'add_meta_boxes', 'mailing_list_signup' );


function mailing_list_signup() {

	    	global $post;

    		$meta = $post->ID;
    		$slug = $post->post_name;

    		if($meta == 720 || $slug == 'home'){
    			add_meta_box( 'description_mail', 'Mailing List description', 'mailing_callback', 'page', 'advanced', 'high' );
			}
}

function mailing_callback( $post ) {
    $desc = nl2br(get_post_meta( $post->ID, 'desc', true ));
    $signup = get_post_meta( $post->ID, 'signup', true );

 ?>
    <p>Mailing List Description: <textarea name="desc" rows="4" cols="50" style="width:100%;" ><?php echo $desc; ?></textarea></p>
    <p>Button Text: <input type="text" name="signup" value="<?php echo $signup; ?>" style="width:100%;" /></p>


  <?php

  }


function wpdocs_save_meta_box( $post_id, $post, $update ) {
    			global $post;

    			$meta = $post->ID;
    			$slug = $post->post_name;

    		if($meta == 720 || $slug == 'home'){
				if ( isset($_POST['desc']) ) {
					update_post_meta($post_id, "desc", esc_attr($_POST["desc"]));
				}
				if ( isset($_POST['signup']) ) {
					update_post_meta($post_id, "signup", esc_attr($_POST["signup"]));
				}

			}

 }
add_action( 'save_post', 'wpdocs_save_meta_box', 10, 3 );



?>