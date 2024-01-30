<?php
require_once(get_template_directory() . '/assets/class-wp-bootstrap-navwalker.php');
require_once(get_template_directory()  . '/staff-manager.php');

/**
Remove wordpress emoticons
*/
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

function wp_enqueue(){
	
	wp_register_style( 'bootstrap.min', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css');
	wp_enqueue_style( 'bootstrap.min' );

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_register_script('bootstrap.js', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.bundle.min.js', true);
	wp_enqueue_script( 'bootstrap.js' );

	wp_register_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap');
	wp_enqueue_style( 'google-fonts' );

	wp_register_style( 'font-awesome', get_template_directory_uri() . '/assets/fontawesome/fontawesome.min.css');
	wp_enqueue_style( 'font-awesome' );

}

add_action('wp_enqueue_scripts', 'wp_enqueue');

function gsa_theme_setup(){

	add_theme_support('custom_header');

	add_theme_support('custom-logo', 
		array(
			'height' 		=> 138,
			'width' 		=> 137,
			'flex-height' 	=> true,
			'flex-width' 	=> true,
			'header-text' 	=> array('site-title', 'site-description')
		));

	add_theme_support('post-thumbnails');
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action('after_setup_theme', 'gsa_theme_setup');

register_nav_menus(
    array(
    'primary-menu' => __( 'Primary Menu' ),
    'secondary-menu' => __( 'Secondary Menu' ),
    'footer-menu' => __( 'Footer Menu' )
    )
);

if(function_exists('add_image_size')){
	add_image_size('logo-small', 101, 100, false);
	add_image_size('logo-medium', 165, 164, false);
	add_image_size('widget-image', 350, 240, true);
}

add_filter('image_size_names_choose', 'custom_sizes');

function custom_sizes($sizes){

	return array_merge($sizes, array(
		'logo-medium' => __('Medium Company Logo (165x164)'),
		'logo-small' => __('Medium Company Logo (101x100)'),
		'widget-small' => __('Widget Small Image (101x100)')
		));
}

function wpcodex_add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'wpcodex_add_excerpt_support_for_pages' );

function gsa_widgets_init(){
	register_sidebar(
		 array(
			'name' 			=> __( 'Footer - Sidebar', 'gsa' ),
			'id' 			=> 'footer',
			'description' 	=> __('Widgets in this area will be shown in the footer.', 'gsa'),
			'before_widget' => '<div id="%1$s" class="col-md-4 widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h5>',
			'after_title' 	=> '</h5>',
		)
	);
	register_sidebar(
		 array(
			'name' 			=> __( 'Default', 'gsa' ),
			'id' 			=> 'default',
			'description' 	=> __('Widgets in this area will be shown on all pages/posts when others are empty', 'gsa'),
			'before_widget' => '',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3><aside id="default" class="widget">',
		)
	);
	register_sidebar(
		 array(
			'name' 			=> __( 'Contact', 'gsa' ),
			'id' 			=> 'contact',
			'description' 	=> __('Widgets in this area will be shown on the contact page', 'gsa'),
			'before_widget' => '',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3><aside id="default" class="widget">',
		)
	);
	register_sidebar(
		 array(
			'name' 			=> __( 'Claim', 'gsa' ),
			'id' 			=> 'claim',
			'description' 	=> __('Widgets in this area will be shown on the Claims page', 'gsa'),
			'before_widget' => '',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3><aside id="default" class="widget">',
		)
	);

}
add_action( 'widgets_init', 'gsa_widgets_init');

function gsa_metaboxes(){

	global $post;
	$meta = get_the_ID();
	$slug = basename(get_permalink($meta));

	if( !empty($post) ){

		if($meta == '26' || $slug == 'home'){
			add_meta_box('more_info_link', 'More Info Link', 'more_info_link', 'page', 'advanced', 'high');
			add_meta_box('home_sidebar_title', 'Title for Sidebar', 'home_sidebar_title', 'page', 'advanced', 'high');
			add_meta_box('home_sidebar', 'Home Boxes', 'home_sidebar', 'page', 'advanced', 'high');
		}
	}

}
add_action( 'add_meta_boxes', 'gsa_metaboxes');


function more_info_link($post){

	$button_text = get_post_meta($post->ID, 'buttonText', true);
	$pages = get_post_meta( $post->ID, 'link_button', true );

	?>
	<p>Button Text: <input type="text" name="buttonText" value="<?php echo $button_text ?>" style="width:100%" /></p>
	<?php

	$args = array(
			'id' => 'link_button',
			'name' => 'link_button',
			'selected' => $pages,
			'show_option_none' => 'Please select a page'
	);

	wp_dropdown_pages($args);


}
function home_sidebar_title($post){

	$sidebar_title = get_post_meta($post->ID, 'sidebarTitle', true);

	?>
	<p>Sidebar Title: <input type="text" name="sidebarTitle" value="<?php echo $sidebar_title ?>" style="width:100%" /></p>
	<?php

}
function home_sidebar($post){

	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('mfc-media-upload', get_template_directory_uri() . '/assets/js/mfc-media-upload.js', array( 'jquery' ), true);
	wp_enqueue_style('thickbox');
	wp_enqueue_style('home-boxes', get_template_directory_uri(). '/assets/css/home.css', array(), false);

	?>

	<div id="home-boxes">
	<?php 
	for($boxes=1;$boxes<4;$boxes++){ 

		$title = "title_" . $boxes;
		$image = "image_" . $boxes;
		$link_text = "link_text_" . $boxes;
		$page_id = "page_id_" . $boxes;
		$description = "description_" . $boxes;
		$image_id = "image_id_" . $boxes;
		$file = "file_" . $boxes;
		$file_id = "file_id_" . $boxes;

		$title_[$boxes] = get_post_meta($post->ID, $title, true);
		$image_[$boxes] = get_post_meta($post->ID, $image, true);
		$link_text_[$boxes] = get_post_meta($post->ID, $link_text, true);
		
		$description_[$boxes] = get_post_meta($post->ID, $description, true);
		if( !empty($image_[$boxes]) ):
			$image_id_[$boxes] = get_post_meta($post->ID, $image_id, true);
		else:
			$image_id_[$boxes] = "";
		endif;
		$file_[$boxes] = get_post_meta($post->ID, $file, true);
		$page_id_[$boxes] = get_post_meta($post->ID, $page_id, true);
		if( !empty($file_[$boxes]) ):
			$file_id_[$boxes] = get_post_meta($post->ID, $file_id, true);
		elseif( !empty($page_id_[$boxes]) ):
			$file_id_[$boxes] = "";
		endif;
	
	?>
		<label for="title">
				<strong><?php _e('Box ' . $boxes . ':'); ?></strong>
		</label>
		<br>	
		<label for="title">
				<?php _e('Title:'); ?>
		</label>
		<input class="widefat" id="title_<?php echo $boxes ?>" name="title_<?php echo $boxes ?>" type="text" value="<?php echo esc_attr_e( $title_[$boxes] ); ?>"/>
			
		<label for="Link">
				<?php _e('Linked Page:'); ?>
		</label>
		<br>
		<?php 

			$args = array(
				'id' => $page_id,
				'name' => $page_id,
				'selected' => $page_id_[$boxes],
				'show_option_none' => 'Please select a page'
				);

			wp_dropdown_pages($args);

		?>
		<br>
		<label for="file">
				<?php _e('Linked File:'); ?>
		</label>
		<input class="file_<?php echo $boxes ?> widefat" id="file_<?php echo $boxes ?>" name="file_<?php echo $boxes ?>" type="text" value="<?php echo esc_attr_e( $file_[$boxes] ); ?>"/>
		<input class="file_id_<?php echo $boxes ?> widefat" id="file_id_<?php echo $boxes ?>" name="file_id_<?php echo $boxes ?>" type="hidden" value="<?php echo esc_attr_e( $file_id_[$boxes] ); ?>"/>
		<input type="button" class="select_file_<?php echo $boxes ?>" id="select_file_<?php echo $boxes ?>" value="Select File" />
		<br>
				<?php _e('Background Image:'); ?>
		</label>
		<input class="image_<?php echo $boxes ?> image-page-input widefat" id="image_<?php echo $boxes ?>" name="image_<?php echo $boxes ?>" type="text" value="<?php echo esc_attr_e( $image_[$boxes] ); ?>"/>
		<input class="image_id_<?php echo $boxes ?> widefat" id="image_id_<?php echo $boxes ?>" name="image_id_<?php echo $boxes ?>" type="hidden" value="<?php echo esc_attr_e( $image_id_[$boxes] ); ?>"/>
		<input type="button" class="select_img_<?php echo $boxes ?>" id="select_img_<?php echo $boxes ?>" value="Select Image" />
		<br>

		<?php if ( !empty($image_[$boxes]) ): ?>
			<div id="upload_img_preview_<?php echo $boxes ?>" style="min-height: 100px; height: auto;">
				<img style="max-width: 150px;" src="<?php echo esc_url( $image_[$boxes] ); ?>" />
			</div>
		<?php endif; ?>

		<label for="description">
				<?php _e('Page Description:'); ?>
		</label>
		<textarea class="widefat" id="description_<?php echo $boxes ?>" name="description_<?php echo $boxes ?>"><?php echo esc_attr_e( $description_[$boxes] ); ?></textarea>
		<br>
		<label for="link_text">
				<?php _e('Page Link text:'); ?>
		</label>
		<input id="link_text_<?php echo $boxes ?>" name="link_text_<?php echo $boxes ?>" type="text" value="<?php echo esc_attr_e( $link_text_[$boxes] ); ?>"/>
		<br>
	<?php } ?>

	</div>

	<?php

}

function save_meta_box($post_id){

	global $post;

		$meta = get_the_ID();
		$slug = basename(get_permalink($meta));
		

		if($meta == '26' || $slug = 'home'){

			if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
				return;
			} else {

				if ( isset($_POST['buttonText']) ) {
					update_post_meta($post_id, "buttonText", esc_attr($_POST["buttonText"]));
				}
				if ( isset($_POST['link_button']) ) {
					update_post_meta($post_id, "link_button", esc_attr($_POST["link_button"]));
				}
				if ( isset($_POST['sidebarTitle']) ) {
					update_post_meta($post_id, "sidebarTitle", esc_attr($_POST["sidebarTitle"]));
				}

				for($boxes=1;$boxes<4;$boxes++){

					$title = "title_" . $boxes;
					$image = "image_" . $boxes;
					$link_text = "link_text_" . $boxes;
					$page_id = "page_id_" . $boxes;
					$description = "description_" . $boxes;
					$image_id = "image_id_" . $boxes;
					$file = "file_" . $boxes;
					$file_id = "file_id_" . $boxes; 

					if ( isset($_POST[$title]) ) {
						update_post_meta($post_id, $title, esc_attr( $_POST[$title]) );
					}
					if ( isset($_POST[$page_id]) ) {
						update_post_meta($post_id, $page_id, esc_attr( $_POST[$page_id]) );
					}
					if ( isset($_POST[$image]) ) {
						update_post_meta($post_id, $image, esc_attr( $_POST[$image]) );
					}
					if ( isset($_POST[$image_id]) ) {
						update_post_meta($post_id, $image_id, esc_attr( $_POST[$image_id]) );
					}
					if ( isset($_POST[$file]) ) {
						update_post_meta($post_id, $file, esc_attr( $_POST[$file]) );
					}
					if ( isset($_POST[$file_id]) ) {
						update_post_meta($post_id, $file_id, esc_attr( $_POST[$file_id]) );
					}
					if ( isset($_POST[$description]) ) {
						update_post_meta($post_id, $description, esc_attr( $_POST[$description]) );
					}
					if ( isset($_POST[$link_text]) ) {
						update_post_meta($post_id, $link_text, esc_attr( $_POST[$link_text]) );
					}

				} 

			}
		}		

}
add_action('save_post','save_meta_box');

function gsa_theme_options(){
	add_theme_page("Theme Options", "Theme Options", "manage_options", "theme-options", "theme_option_page" );
}
add_action('admin_menu', 'gsa_theme_options');

function theme_settings(){
	
	add_settings_section('footer_section','Footer Options','footer_section_description','theme-options');

	add_settings_section('header_section','Page Options','page_header_section_description','theme-options');

	add_settings_field('footer_copyright_option', 'Copyright', 'footer_copyright_callback', 'theme-options', 'footer_section');

	add_settings_field('image_url_header_option', 'Default Image', 'image_header_callback', 'theme-options', 'header_section');

	register_setting('theme-options-grp','footer_copyright_option');

	register_setting('theme-options-grp','image_url_header_option');

	register_setting('theme-options-grp','image_id_header_option');
	
}
add_action('admin_init', 'theme_settings');

function theme_option_page(){

?>
<div class="wrap">
<h1>Theme Options Page</h1>
<form method="post" action="options.php">
<?php
settings_fields("theme-options-grp");
do_settings_sections("theme-options");
submit_button();
?>
</form>
</div>
<?php

}
function footer_section_description(){
	echo '<p>Options for footer area</p>';
}
function page_header_section_description(){
	echo '<p>Options for pages</p>';
}
function footer_copyright_callback(){
	?><input type="text" name="footer_copyright_option" id ="footer_copyright" value="<?php echo get_option('footer_copyright_option'); ?>"/>
	<?php
}
function image_header_callback(){
	
	wp_enqueue_media();

	wp_register_script('theme_options.js', get_template_directory_uri() . '/assets/js/theme_options.js', true);
	wp_enqueue_script( 'theme_options.js' );

	$image_header_url = get_option('image_url_header_option');

	?>

	<input type="text" name="image_url_header_option" id ="image_url_header_option" value="<?php echo get_option('image_url_header_option'); ?>"/>
	<input type="hidden" name="image_id_header_option" id ="image_id_header_option" value="<?php echo get_option('image_id_header_option'); ?>"/>
	<input id="my_upl_button" type="button" value="Upload File" />
    <input id="my_clear_button" type="button" value="Clear" />
    <div id="upload_img_preview" style="min-height: 100px; margin-top: 20px;">
    	<img src="<?php echo esc_url($image_header_url); ?>" alt="Image Preview" />
    </div>
	<?php
}

//404 wp_title() change
function theme_slug_filter_wp_title( $title ) {
    if ( is_404() ) {
        $title = 'Page not found - GSA University';
    }
    // You can do other filtering here, or
    // just return $title
    return $title;
}
// Hook into wp_title filter hook
add_filter( 'wp_title', 'theme_slug_filter_wp_title' );

?>