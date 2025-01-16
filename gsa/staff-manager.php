<?php

function staff_contacts() {

		$labels = array(
			'label' 			=> __('Staff Contacts'),
			'singular_label' 	=> __('Staff Contacts'),
			'public' 			=> false,
			'show_ui' 			=> true,
			'capability_type' 	=> 'post',
			'hierarchical' 		=> true,
			'has_archive' 		=> false,
			'supports' 			=> array('title', 'page-attributes'),
			'rewrite' 			=> array('slug' => 'contacts', 'with_front' => false),
		);
		register_post_type('contacts', $labels);

}

add_action('init', 'staff_contacts');

add_action('admin_init', 'contact_manager_add_meta');

function contact_manager_add_meta(){

	add_meta_box('contact-meta', 'Contact Info', 'contact_manager_meta_info', 'contacts', 'advanced', 'high');

}

function contact_manager_meta_info(){

	global $post;
	wp_enqueue_media();
	wp_register_script('photo_upload.js', get_template_directory_uri() . '/assets/js/photo_upload.js', true);
	wp_enqueue_script( 'photo_upload.js' );

	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

	$input = get_post_meta($post->ID);

	if(isset($input["work-title"])){
		$work_title = $input["work-title"][0];
	}
	if(isset($input["work-phone"])){
		$phone = $input["work-phone"][0];
	}
	if(isset($input["mobile-phone"])){
		$mobile = $input["mobile-phone"][0];
	}
	if(isset($input["email"])){
		$email = $input["email"][0];
	}
	if(isset($input["image_url"])){
		$image_url = $input["image_url"][0];
	}
	if(isset($input["image_id"])){
		$image_id = $input["image_id"][0];
	}

	if(isset($input["description"])){
		$description = $input["description"][0];
	}

?>

<style type="text/css">
	<?php include('staff-manager.css'); ?>
</style>

<div class="contact_manager_extras">
<div><label>Work Title:</label><input type="text" name="work-title"  value="<?php echo isset($work_title) ? $work_title : ''; ?>" /></div>
<div><label>Work Phone:</label><input type="text" name="work-phone"  value="<?php echo isset($phone) ? $phone : ''; ?>" /></div>
<div><label>Mobile Phone:</label><input type="text" name="mobile-phone" value="<?php echo isset($mobile) ? $mobile : ''; ?>" /></div>
<div><label>Email:</label><input type="text" name="email" value="<?php echo isset($email) ? $email : ''; ?>" /></div>
<div><label>Description:</label><textarea name="description" /><?php echo isset($description) ? $description : ''; ?></textarea></div>
<div><label>Photo:</label>
	<input type="text" name="image_url" id ="image_url" value="<?php echo isset($image_url) ? $image_url : ''; ?>" />
	<input type="hidden" name="image_id" id ="image_id" value="<?php echo isset($image_id) ? $image_id: ''; ?>" />
	<input id="my_upl_button" type="button" value="Upload File" />
	<input id="my_clear_button" type="button" value="Clear" />
	<div id="upload_img_preview" style="min-height: 100px; margin-top: 20px;">
	    <img style="max-width: 300px; width: 100%;" src="<?php echo esc_url($image_url); ?>" alt="Image Preview" />
	</div>
</div>
</div>

<?php

}

add_action('save_post', 'contact_save_manager_extras');

function contact_save_manager_extras($post_id){

	global $post;

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	} else {
		if( isset($_POST['work-title']) ){
			update_post_meta($post_id, "work-title", $_POST["work-title"]);
		}
		if( isset($_POST['work-phone']) ){
			update_post_meta($post_id, "work-phone", $_POST["work-phone"]);
		}
		if( isset($_POST['mobile-phone']) ){
			update_post_meta($post_id, "mobile-phone", $_POST["mobile-phone"]);
		}
		if( isset($_POST['email']) ){
			update_post_meta($post_id, "email", $_POST["email"]);
		}
		if( isset($_POST['description']) ){
			update_post_meta($post_id, "description", $_POST["description"]);
		}
		if( isset($_POST['image_url']) ){
			update_post_meta($post_id, "image_url", $_POST["image_url"]);
		}
		if( isset($_POST['image_id']) ){
			update_post_meta($post_id, "image_id", $_POST["image_id"]);
		}

	}

}

add_filter('manage_edit-contacts_columns', "contact_manager_edit_columns");

function contact_manager_edit_columns($columns){
	$columns = array(
		"cb" 			=> "<input type=\"checkbox\" />",
		"title"			=> "Name",
		"work-title"	=> "Work Title",
		"work-phone"	=> "Work Phone",
		"mobile-phone"	=> "Mobile Phone",
		"email"			=> "Email",
		"created"		=> 'Created Date',
		);
	return $columns;
}

add_action("manage_contacts_posts_custom_column", "contact_manager_custom_columns");

function contact_manager_custom_columns($column){
	global $post;
	$output = get_post_custom();

	switch($column)
	{
		case "created":
			$created = get_the_date();
			echo $created;
			break;
		case "work-title":
			$work_title = nl2br($output["work-title"][0]);
			echo $work_title;
			break;
		case "work-phone":
			$phone = nl2br($output["work-phone"][0]);
			echo $phone;
			break;
		case "mobile-phone":
			$mobile = nl2br($output["mobile-phone"][0]);
			echo $mobile;
			break;
		case "email":
			$email = $output["email"][0];
			echo $email;
			break;
	}
}

add_filter('manage_edit-contacts_sortable_columns', 'contact_sortable_columns');

function contact_sortable_columns( $columns ){

	$columns['created'] = 'created';
	return $columns;
}	

add_action('pre_get_posts', 'contact_orderby');

function contact_orderby($query){

	if(! is_admin())
		return;

		$orderbyCreated = $query->get('created');

		if( 'slice' == $orderbyCreated ){
			$query->set('meta_key', 'created');
			$query->set('orderby', 'meta_value_num');
		}

}
?>