<?php

/**
 * Event Meta Box Options
 * @var array Options for Themify Custom Panel
 * @since 1.0.0
 */
if (!function_exists('themify_theme_event_meta_box')) {

    function themify_theme_event_meta_box() {
	return array(
	    // Layout
	    array(
		'name' => 'layout',
		'title' => __('Sidebar Option', 'themify'),
		'description' => '',
		'type' => 'layout',
		'show_title' => true,
		'meta' => array(
		    array('value' => 'default', 'img' => 'themify/img/default.svg', 'title' => __('Default', 'themify')),
		    array('value' => 'sidebar1', 'img' => 'images/layout-icons/sidebar1.png', 'title' => __('Sidebar Right', 'themify')),
		    array('value' => 'sidebar1 sidebar-left', 'img' => 'images/layout-icons/sidebar1-left.png', 'title' => __('Sidebar Left', 'themify')),
		    array('value' => 'sidebar-none', 'img' => 'images/layout-icons/sidebar-none.png', 'title' => __('No Sidebar ', 'themify'), 'selected' => true,)
		),
		'default' => 'default'
	    ),
	    // Featured Image Size
	    array(
		'name' => 'feature_size',
		'title' => __('Image Size', 'themify'),
		'description' => sprintf(__('Image sizes can be set at <a href="%s">Media Settings</a> and <a href="%s" target="_blank">Regenerated</a>.', 'themify'), 'options-media.php', 'https://wordpress.org/plugins/regenerate-thumbnails/'),
		'type' => 'featimgdropdown',
		'meta' => array(),
		'display_callback' => 'themify_is_image_script_disabled'
	    ),
	    // Multi field: Image Dimension
	    themify_image_dimensions_field(),
	    // Start Date
	    array(
		'name' => 'start_date',
		'title' => __('Event Starts On', 'themify'),
		'description' => __('Enter event start date and time.', 'themify'),
		'type' => 'date',
		'meta' => array(
		    'default' => '',
		    'pick' => __('Pick Date', 'themify'),
		    'close' => __('Done', 'themify'),
		    'clear' => __('Clear Date', 'themify'),
		    'date_format' => '',
		    'time_format' => 'HH:mm',
		    'timeseparator' => ' '
		),
		'force_save' => true,
	    ),
	    array(
		'name' => 'end_date',
		'title' => __('Event Ends On', 'themify'),
		'description' => __('Enter event end date and time.', 'themify'),
		'type' => 'date',
		'meta' => array(
		    'default' => '',
		    'pick' => __('Pick Date', 'themify'),
		    'close' => __('Done', 'themify'),
		    'clear' => __('Clear Date', 'themify'),
		    'date_format' => '',
		    'time_format' => 'HH:mm',
		    'timeseparator' => ' '
		),
		'force_save' => true,
	    ),
	    // Repeat date
	    array(
		'title' => __('Repeat', 'themify'),
		'description' => '',
		'type' => 'multi',
		'meta' => array(
		    'fields' => array(
			array(
			    'name' => 'repeat',
			    'label' => '',
			    'type' => 'dropdown',
			    'meta' => array(
				array(
				    'value' => '',
				    'selected' => true,
				    'name' => __('None', 'themify')
				),
				array(
				    'value' => 'day',
				    'name' => __('Daily', 'themify')
				),
				array(
				    'value' => 'week',
				    'name' => __('Weekly', 'themify')
				),
				array(
				    'value' => 'year',
				    'name' => __('Yearly', 'themify')
				)
			    ),
			    'default' => ''
			),
			array(
			    'name' => 'repeat_x',
			    'label' => '',
			    'description' => '',
			    'type' => 'textbox',
			    'meta' => array('size' => 'small'),
			    'before' => sprintf('<span style="margin:0 5px 0 15px;">%s</span>', __('Every', 'themify')),
			    'after' => sprintf('<span style="margin-left:5px;">%s</span>', __('week', 'themify')),
			),
		    ),
		    'description' => '',
		    'before' => '',
		    'after' => '',
		    'separator' => ''
		)
	    ),
	    // Hide end event date in the loop
	    array(
		'name' => 'event_end_date_hide',
		'title' => __('Hide event end date on display', 'themify'),
		'type' => 'checkbox',
		'meta' => array(),
	    ),
	    // Location
	    array(
		'name' => 'location',
		'title' => __('Location', 'themify'),
		'description' => __('Enter city or venue name.', 'themify'),
		'type' => 'textbox',
		'meta' => array(),
	    ),
	    // Map Address
	    array(
		'name' => 'map_address',
		'title' => __('Map Address', 'themify'),
		'description' => __('Enter full address for Google Map.', 'themify'),
		'type' => 'textarea',
		'meta' => array(),
	    ),
	    // Buy Tickets
	    array(
		'name' => 'buy_tickets',
		'title' => __('Buy Ticket Link', 'themify'),
		'description' => __('Enter link to ticket buying page.', 'themify'),
		'type' => 'textbox',
		'meta' => array(),
	    ),
	    // Video URL
	    array(
		'name' => 'video_url',
		'title' => __('Video URL', 'themify'),
		'description' => __('Replace Featured Image with a video embed URL such as YouTube or Vimeo video url (<a href="https://themify.me/docs/video-embeds">details</a>).', 'themify'),
		'type' => 'textbox',
		'meta' => array(),
	    ),
	    // External Link
	    array(
		'name' => 'external_link',
		'title' => __('External Link', 'themify'),
		'description' => __('Link Featured Image and Post Title to external URL.', 'themify'),
		'type' => 'textbox',
		'meta' => array(),
	    ),
	    // Lightbox Link
	    themify_lightbox_link_field(),
	    // Custom menu for page
	    array(
		'name' => 'custom_menu',
		'title' => __('Custom Menu', 'themify'),
		'description' => '',
		'type' => 'dropdown',
		'meta' => themify_get_available_menus()
	    )
	);
    }

}

if (!function_exists('themify_event_slug')) {

    /**
     * Event Slug
     * @param array $data
     * @return string
     */
    function themify_event_slug($data = array()) {

	$data = themify_get_data();

	$event_slug = isset($data['themify_event_slug']) ? $data['themify_event_slug'] : apply_filters('themify_event_rewrite', 'event');
	$event_category_slug = isset($data['themify_event_category_slug']) ? $data['themify_event_category_slug'] : apply_filters('themify_event_category_rewrite', 'event-category');
	$event_tag_slug = isset($data['themify_event_tag_slug']) ? $data['themify_event_tag_slug'] : apply_filters('themify_event_tag_rewrite', 'event-tag');

	return '
			<p>
				<span class="label">' . __('Event Base Slug', 'themify') . '</span>
				<input type="text" name="themify_event_slug" value="' . $event_slug . '" class="slug-rewrite">
			</p>
			<p>
				<span class="label">' . __('Event Category Slug', 'themify') . '</span>
				<input type="text" name="themify_event_category_slug" value="' . $event_category_slug . '" class="slug-rewrite">
			</p>
			<p>
				<span class="label">' . __('Event Tag Slug', 'themify') . '</span>
				<input type="text" name="themify_event_tag_slug" value="' . $event_tag_slug . '" class="slug-rewrite">
			</p>
			<hr>';
    }

}
if (!function_exists('themify_theme_get_event_metaboxes')) {

    function themify_theme_get_event_metaboxes(array $args, &$meta_boxes) {
	return array(
	    array(
		'name' => __('Event Options', 'themify'),
		'id' => 'event-options',
		'options' => themify_theme_event_meta_box(),
		'pages' => 'event'
	    ),
	    array(
		'name' => __('Event Appearance', 'themify'),
		'id' => 'event-theme-design',
		'options' => themify_theme_design_meta_box(),
		'pages' => 'event'
	    )
	);
    }

}
