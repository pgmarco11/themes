<?php

require_once(get_stylesheet_directory() . '/contact-manager.php');


function wp_enqueue(){
	
	wp_enqueue_style('wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900|Montserrat:300,400,500,600,700,800', false);

	wp_register_style( 'bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style( 'bootstrap.min' );

	if(is_singular( 'tribe_events' )){

		wp_register_script( 'event_video.js', get_template_directory_uri() . '/js/event_video.js');
		wp_enqueue_script( 'event_video.js' );

	}

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_register_style( 'orange', get_template_directory_uri() . '/css/orange.css');
	wp_enqueue_style( 'orange' );

}

add_action('wp_enqueue_scripts', 'wp_enqueue');


add_action( 'wp_default_scripts', 'move_jquery_into_footer' );

function move_jquery_into_footer( $wp_scripts ) {
    if( is_admin() ) {
        return;
    }
    $wp_scripts->add_data( 'jquery', 'group', 1 );
    $wp_scripts->add_data( 'jquery-core', 'group', 1 );
    $wp_scripts->add_data( 'jquery-migrate', 'group', 1 );
}

/**
 * Removes the preconnect to fonts.gstatic.com
 */
add_filter('autoptimize_html_after_minify', function($content) {

    $content = str_replace("<link href='https://fonts.gstatic.com' crossorigin='anonymous' rel='preconnect' />", ' ', $content);

    return $content;
}, 10, 1);

/**
 * Adds DNS Prefetch to header
 */
function dns_prefetch() {
 echo '<meta http-equiv="x-dns-prefetch-control" content="on">
<link rel="preconnect" href="https://syndication.twitter.com"  crossorigin="anonymous" />
<link rel="preconnect" href="https://www.google.com" crossorigin="anonymous" />
<link rel="preconnect" href="https://www.youtube.com" crossorigin="anonymous" />
<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin="anonymous" />
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin="anonymous" />
<link rel="preconnect" href="https://platform.twitter.com" crossorigin="anonymous" />
<link rel="preconnect" href="https://yt3.ggpht.com" crossorigin="anonymous" />
<link rel="preconnect" href="https://i.ytimg.com" crossorigin="anonymous" />
<link rel="dns-prefetch" href="https://fonts.gstatic.com" />';
}
add_action('wp_head', 'dns_prefetch', 0);

/**
Remove wordpress emoticons
*/
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

function arpin_theme_setup(){

	add_theme_support('custom_header');

	add_theme_support('custom-logo', 
		array(
			'height' 		=> 74,
			'width' 		=> 165,
			'flex-height' 	=> true,
			'flex-width' 	=> true,
			'header-text' 	=> array('site-title', 'site-description')
		));

	add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'arpin_theme_setup');

function wpcodex_add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'wpcodex_add_excerpt_support_for_pages' );

if(function_exists('add_image_size')){
	add_image_size('organization-logo-small', 190, 80, false);
	add_image_size('company-logo-medium', 165, 124, false);
	add_image_size('organization-logo-large', 533, 400, false);
	add_image_size('profile-image', 240, 295, array( 'center', 'top' ));
	add_image_size('featured-event-image', 1170, 550, array( 'center', 'top' ));
	add_image_size('single-event-image', 1200, 350, true);
	add_image_size('thumbnail-event-featured', 590, 250, true);
	add_image_size('thumbnail-event', 345, 250, true);
}

add_filter('image_size_names_choose', 'custom_sizes');

function custom_sizes($sizes){

	return array_merge($sizes, array(
		'organization-logo-large' => __('Large Logo (533x400)'),
		'organization-logo-small' => __('Small Logo (190x80)'),
		'company-logo-medium' => __('Medium Company Logo (165x124)'),
		));
}


add_theme_support('nav-menus');

if ( function_exists( 'register_nav_menus') ){

	register_nav_menus(
		array(
		'main' 				=> 'Main Navigation',
		'footer' 			=> 'Footer Navigation',
		'about' 			=> 'About Us',
		'services' 			=> 'Services',
		'top_left_header' 	=> 'Left Header',
		'events'			=> 'Events'
		)
	);
}

add_filter( 'get_custom_logo', 'change_logo_class');

function change_logo_class( $html ){

	$html = str_replace( 'custom-logo-link', 'logo', $html);
	return $html;

}

function mobile_logo_customize($wp_customize){

	$wp_customize->add_setting('mobile_logo');

	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'mobile_logo',
		array(
			'label' 	=> __('Mobile Logo', 'arpingroup'),
			'description' => __('This logo will be shown on devices with widths less than 785px'),
			'section'	=> 'title_tagline',
			'settings'	=> 'mobile_logo',
		)));

}
add_action('customize_register', 'mobile_logo_customize');


add_filter('sp_template_image-widget_widget.php', 'custom_companies_filter');
function custom_companies_filter($template) {

	return get_template_directory() . '/custom-templates/image-widget.php';
}

function arpin_widgets_init(){
	register_sidebar(
		 array(
			'name'			=> __( 'Top Header - Right ', 'arpingroup' ),
			'id' 			=> 'top-right-header',
			'description' 	=> __('Widgets in this area will be shown in the header on the right side', 'arpingroup'),
			'before_widget' => '<div id="%1$s" class="pull-right hidden-xs widget">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '',
			'after_title' 	=> '',
		)
	);
	register_sidebar(
		 array(
			'name' 			=> __( 'Home - Main Sidebar', 'arpingroup' ),
			'id' 			=> 'home-main',
			'description' 	=> __('Widgets in this area will be shown on home page underneath the featured image.', 'arpingroup'),
			'before_widget' => '<div id="%1$s" class="col-sm-4 xs-box3 widget"><div class="box-services-c">',
			'after_widget' 	=> '</div></div>',
			'before_title' 	=> '<h3 class="title-small br-bottom-center color-on-dark widgettitle">',
			'after_title' 	=> '</h3>',
		)
	);
	register_sidebar(
		 array(
			'name' 			=> __( 'Home - Services Sidebar', 'arpingroup' ),
			'id' 			=> 'home-services',
			'description' 	=> __('Widgets in this area will be shown on the home page above the companies.', 'arpingroup'),
			'before_widget' => '<div id="%1$s" class="col-sm-12 col-md-4 widget">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h3 class="title-medium title-shadow-a mb10">',
			'after_title' 	=> '</h3><div class="br-bottom mb20"></div>',
		)
	);
	register_sidebar(
		 array(
			'name' 			=> __( 'Home - Organizations Sidebar', 'arpingroup' ),
			'id' 			=> 'home-organizations',
			'description' 	=> __('Widgets in this area will be shown on the home page underneath Organizations.', 'arpingroup'),
			'before_widget' => '<div id="%1$s" class="col-xs-4 col-sm-2 xs-box widget">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '',
			'after_title' 	=> '',
		)
	);
	register_sidebar(
		 array(
			'name' 			=> __( 'Companies', 'arpingroup' ),
			'id' 			=> 'companies',
			'description' 	=> __('Widgets in this area will be shown on the companies page.', 'arpingroup'),
			'before_widget' => '<div id="%1$s" class="row mb20 widget companies">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h3 class="title-small">',
			'after_title' 	=> '</h3>',
		)
	);
	register_sidebar(
		 array(
			'name' 			=> __( 'Careers', 'arpingroup' ),
			'id' 			=> 'careers',
			'description' 	=> __('Widgets in this area will be shown on the careers page.', 'arpingroup'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget widget">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h3 class="sidebar-title br-bottom">',
			'after_title' 	=> '</h3>',
		)
	);	
	register_sidebar(
		 array(
			'name' 			=> __( 'Contact', 'arpingroup' ),
			'id' 			=> 'contact',
			'description' 	=> __('Widgets in this area will be shown on the contact page.', 'arpingroup'),
			'before_widget' => '<div id="%1$s" class="col-sm-12 col-md-5 widget">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h3 class="title-small br-bottom">',
			'after_title' 	=> '</h3><p class="mb40"></p>',
		)
	);
	register_sidebar(
		 array(
			'name' 			=> __( 'Blog Posts', 'arpingroup' ),
			'id' 			=> 'blog-posts',
			'description' 	=> __('Widgets in this area will be shown on all blog posts.', 'arpingroup'),
			'before_widget' => '<div id="%1$s" class="col-sm-4 col-md-3 widget">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h3 class="title-small br-bottom">',
			'after_title' 	=> '</h3>',
		)
	);
	register_sidebar(
		 array(
			'name' 			=> __( 'Default', 'arpingroup' ),
			'id' 			=> 'default',
			'description' 	=> __('Widgets in this area will be shown on any new pages created.', 'arpingroup'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget widget">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h3 class="sidebar-title br-bottom">',
			'after_title' 	=> '</h3>',
		)
	);
	register_sidebar(
		 array(
			'name' 			=> __( 'Footer - Main Sidebar', 'arpingroup' ),
			'id' 			=> 'footer-main',
			'description' 	=> __('Widgets in this area will be shown in the footer.', 'arpingroup'),
			'before_widget' => '<div id="%1$s" class="col-sm-12 col-md-4"><div class="footer-widget">',
			'after_widget' 	=> '</div></div>',
			'before_title' 	=> '<h3 class="footer-title widgettitle">',
			'after_title' 	=> '</h3>',
		)
	);


}
add_action( 'widgets_init', 'arpin_widgets_init');

add_action( 'add_meta_boxes', 'arpin_meta_boxes');

function arpin_meta_boxes(){
		global $post;

		if(!empty($post)){

			$meta = get_the_ID();

			$slug = basename(get_permalink($meta));

			if($meta == '258' || $slug == 'home'){
				add_meta_box('video_link', 'YouTube Embed Video', 'youtube_home_video', 'page', 'advanced', 'high');
				add_meta_box('organizations', 'Affiliated Organizations', 'organizations_meta', 'page', 'advanced', 'high');
			}
			if($meta == '284' || $slug == 'contact'){
				add_meta_box('contact_info', 'Contact Information', 'business_contact', 'page', 'advanced', 'high');
			}
			
			if (function_exists('tribe_is_event')){
				if( tribe_is_event()){
					add_meta_box('more_info', 'Event Information', 'event_info', 'tribe_events', 'advanced', 'high');
					add_meta_box('event_image', 'Events Page Featured Photo', 'event_photo', 'tribe_events', 'advanced', 'high');
				}
			}

		}

}


function event_info($post){
	$text = get_post_meta($post->ID, 'event_info', true);
	wp_editor( htmlspecialchars_decode($text), 'metabox_ID', $settings=array('textarea_name'=>'event_info'));
}

function event_photo($post){

	global $post;
	wp_enqueue_media();
	wp_register_script('photo_upload.js', get_template_directory_uri() . '/js/photo_upload.js', true);
	wp_enqueue_script( 'photo_upload.js' );

	$event_image_url = get_post_meta($post->ID, 'image_url', true);
	$event_image_id = get_post_meta($post->ID, 'image_id', true);

?>

<div>
	<label>Photo:</label>
	<input type="text" name="image_url" class="image_url" value="<?php echo isset($event_image_url) ? $event_image_url : ''; ?>" />
	<input type="hidden" name="image_id" class="image_id" value="<?php echo isset($event_image_id) ? $event_image_id : ''; ?>" />
	<input class="my_upl_button" type="button" value="Upload File" />
	<input class="my_clear_button" type="button" value="Clear" />
	<div id="upload_img_preview" style="min-height: 100px; margin-top: 20px;">
	    <img style="max-width: 300px; width: 100%;" src="<?php echo esc_url($event_image_url); ?>" alt="Image Preview" />
	</div>
</div>

<?php


}

function youtube_home_video($post){

		$youtube_url = get_post_meta($post->ID, 'youtube', true);
		?>	
		<p>YouTube URL: <input type="text" placeholder="Paste in the YouTube Embed URL here" name="youtube" value="<?php echo $youtube_url ?>" style="width:100%" /></p>
		<?php

}

function business_contact($post){

		$address = get_post_meta($post->ID, 'address', true);
		$emailAddress = get_post_meta($post->ID, 'emailAddress', true);
		$phoneNumber = get_post_meta($post->ID, 'phoneNumber', true);
		?>
		<p>Business Address: <textarea name="address" rows="4" cols="25" style="width:100%" ><?php echo $address ?></textarea></p>
		<p>Contact Email: <input type="text" name="emailAddress" value="<?php echo $emailAddress ?>" style="width:100%" /></p>
		<p>Phone Number: <textarea rows="4" cols="25" name="phoneNumber" style="width:100%" /><?php echo $phoneNumber ?></textarea></p>
		<?php
}

function organizations_meta($post){

	$org_title = get_post_meta($post->ID, 'orgTitle', true);
	?>
	<p>Organizations Title: <input type="text" name="orgTitle" value="<?php echo $org_title ?>" style="width:100%" /></p>
	<?php

}

function save_meta_box($post_id){

	global $post;

		$meta = get_the_ID();

		$slug = basename(get_permalink($meta));

		if($meta == '258' || $slug = 'home'){

			if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
				return;
			} else {
				if ( isset($_POST['youtube']) ) {
					update_post_meta($post_id, "youtube", esc_attr($_POST["youtube"]));
				}
				if ( isset($_POST['orgTitle']) ) {
					update_post_meta($post_id, "orgTitle", esc_attr($_POST["orgTitle"]));
				}
			}
		}

		if($meta == '284' || $slug == 'contact'){

			if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
				return;
			} else {
				if ( isset($_POST['address']) ) {
					update_post_meta($post_id, "address", esc_attr($_POST["address"]));
				}
				if (isset($_POST['emailAddress'])){
					update_post_meta($post_id, "emailAddress", esc_attr($_POST['emailAddress']));
				}
				if ( isset($_POST['phoneNumber']) ) {
					update_post_meta($post_id, "phoneNumber", esc_attr($_POST["phoneNumber"]));
				}
			}

		}
		if( tribe_is_event() ){

			if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
				return;
			} else {

				if( isset($_POST['event_info']) ){
					$data=htmlspecialchars($_POST['event_info']);
					update_post_meta($post_id, 'event_info', $data);
				}
				if ( isset($_POST['image_url']) ) {
					update_post_meta($post_id, "image_url", esc_attr($_POST["image_url"]));
				}
				if ( isset($_POST['image_id']) ) {
					update_post_meta($post_id, "image_id", esc_attr($_POST["image_id"]));
				}

			}
		}

}
add_action('save_post','save_meta_box');

if ( function_exists('bcn_display') ) {
    function wpst_override_breadcrumb_trail($trail) {
        if ( is_404() ) {
            unset($trail->trail[1]);
            array_keys($trail->trail);
        }
    }

    add_action('bcn_after_fill', 'wpst_override_breadcrumb_trail');
}

// trim excerpt whitespace for after import/exports
if ( !function_exists( 'mp_trim_excerpt_whitespace' ) ) {
  function mp_trim_excerpt_whitespace( $excerpt ) {
    return trim( $excerpt );
  }
  add_filter( 'get_the_excerpt', 'mp_trim_excerpt_whitespace', 1 );
}

add_filter( 'social_rocket_archives_url_use_first_page', '__return_false' );

if(function_exists('tribe') ){
//change text and html for google calendar and ical button on event pages
remove_action( 'tribe_events_single_event_after_the_content', array( tribe( 'tec.iCal' ), 'single_event_links' ) );

add_action( 'tribe_events_single_event_after_the_content', 'customized_tribe_single_event_links' );

}

function customized_tribe_single_event_links()	{

	if ( is_single() && post_password_required() ) {
		return;
	}

	echo '<div class="tribe-events-cal-links">';
	echo '<a class="tribe-events-gcal tribe-events-button pull-left clear" href="' . tribe_get_gcal_link() . '" title="' . __( 'Add to Google Calendar', 'tribe-events-calendar-pro' ) . '"> + Google Calendar </a>';
	echo '<a class="tribe-events-ical tribe-events-button pull-left clear" href="' . tribe_get_single_ical_link() . '"> + iCal Export </a>';
	echo '</div>';
}

/**
 * Redirect event category requests to list view.
 *
 * @param $query
 */
function use_list_view_for_categories( $query ) {
	// Disregard anything except a main archive query
	if ( is_admin() || ! $query->is_main_query() || ! is_archive() ) return;

	// We only want to catch *event* category requests being issued
	// against something other than list view
	if ( ! $query->get( 'tribe_events_cat' ) ) return;
	if ( tribe_is_list_view() ) return;

	// Get the term object
	$term = get_term_by( 'slug', $query->get( 'tribe_events_cat' ), Tribe__Events__Main::TAXONOMY );

	// If it's invalid don't go any further
	if ( ! $term ) return;

	// Get the list-view taxonomy link and redirect to it
	header( 'Location: ' . tribe_get_listview_link( $term->term_id ) );
	exit();
}

// Use list view for category requests by hooking into pre_get_posts for event queries
add_action( 'tribe_events_pre_get_posts', 'use_list_view_for_categories' );

?>