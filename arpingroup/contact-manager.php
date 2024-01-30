<?php

function division_contacts() {

		$labels = array(
			'label' 			=> __('Division Contacts'),
			'singular_label' 	=> __('Division Contacts'),
			'public' 			=> false,
			'show_ui' 			=> true,
			'capability_type' 	=> 'post',
			'hierarchical' 		=> true,
			'has_archive' 		=> false,
			'supports' 			=> array('title'),
			'rewrite' 			=> array('slug' => 'contacts', 'with_front' => false),
		);
		register_post_type('contacts', $labels);

		$args = array(
			'hierarchical'			=> true,
			'labels'				=> 'Division Types',
			'singular_label' 		=> 'Division Type',
			'query_var'				=> true,
			'rewrite'				=> true,
			'slug'	 				=> 'division-type',
			'register_meta_box_cb'	=> 'contact_manager_add_meta'
		);
		register_taxonomy('division-type', 'contacts', $args );

}

add_action('init', 'division_contacts');

add_action('admin_init', 'contact_manager_add_meta');

function contact_manager_add_meta(){

	add_meta_box('contact-meta', 'Contact Info', 'contact_manager_meta_info', 'contacts', 'advanced', 'high');

}

function contact_manager_meta_info(){

	global $post;

	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

	$input = get_post_meta($post->ID);

	if(isset($input["division"])){
		$division = $input["division"][0];
	}
	if(isset($input["phone"])){
		$phone = $input["phone"][0];
	}
	if(isset($input["address"])){
		$address = $input["address"][0];
	}
	if(isset($input["email"])){
		$email = $input["email"][0];
	}

?>

<style type="text/css">
	<?php include('contact-manager.css'); ?>
</style>

<div class="contact_manager_extras">
<div><label>Phone:</label><textarea name="phone" rows="4" cols="25" /><?php echo isset($phone) ? $phone : ''; ?></textarea></div>
<div><label>Address:</label><textarea name="address" rows="5" cols="50"><?php echo isset($address) ? $address : ''; ?></textarea></div>
<div><label>Email:</label><input type="text" name="email" value="<?php echo isset($email) ? $email : ''; ?>" /></div>
</div>

<?php

}

add_action('save_post', 'contact_save_manager_extras');

function contact_save_manager_extras($post_id){

	global $post;

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	} else {
		if( isset($_POST['phone']) ){
			update_post_meta($post_id, "phone", $_POST["phone"]);
		}
		if( isset($_POST['address']) ){
			update_post_meta($post_id, "address", $_POST["address"]);
		}
		if( isset($_POST['email']) ){
			update_post_meta($post_id, "email", $_POST["email"]);
		}

	}

}

add_filter('manage_edit-contacts_columns', "contact_manager_edit_columns");

function contact_manager_edit_columns($columns){
	$columns = array(
		"cb" 			=> "<input type=\"checkbox\" />",
		"title"			=> "Division",
		"created"		=> 'Created Date',
		"phone"			=> "Phone",
		"address"		=> "Address",
		"email"			=> "Email",
		"cat"			=> "Type",
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
		case "phone":
			$phone = nl2br($output["phone"][0]);
			echo $phone;
			break;
		case "address":
			$address = nl2br($output["address"][0]);
			echo $address;
			break;
		case "email":
			$email = $output["email"][0];
			echo $email;
			break;
		case "cat":
			$type = get_the_term_list($post->ID, 'division-type');
			echo $type;
			break;
	}
}

add_filter('manage_edit-contacts_sortable_columns', 'contact_sortable_columns');

function contact_sortable_columns( $columns ){

	$columns['created'] = 'created';
	$columns['cat'] = 'cat';
	return $columns;
}	

add_action('pre_get_posts', 'contact_orderby');

function contact_orderby($query){

	if(! is_admin())
		return;

		$orderbyCreated = $query->get('created');
		$orderbyCat = $query->get('cat');

		if( 'slice' == $orderbyCreated ){
			$query->set('meta_key', 'created');
			$query->set('orderby', 'meta_value_num');
		}

		if( 'slice' == $orderbyCat ){
			$query->set('meta_key', 'cat');
			$query->set('orderby', 'meta_value_num');
		}

}
?>