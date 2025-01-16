<?php

/**
 * Video Meta Box Options
 * @var array Options for Themify Custom Panel
 * @since 1.0.0
 */
if (!function_exists('themify_theme_video_meta_box')) {

    function themify_theme_video_meta_box() {
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
		    array('value' => 'sidebar-none', 'img' => 'images/layout-icons/sidebar-none.png', 'selected' => true, 'title' => __('No Sidebar ', 'themify'))
		),
		'default' => 'default'
	    ),
	    // Content Width
	    array(
		'name' => 'content_width',
		'title' => __('Content Width', 'themify'),
		'description' => '',
		'type' => 'layout',
		'show_title' => true,
		'meta' => array(
		    array(
			'value' => 'default_width',
			'img' => 'themify/img/default.svg',
			'selected' => true,
			'title' => __('Default', 'themify')
		    ),
		    array(
			'value' => 'full_width',
			'img' => 'themify/img/fullwidth.svg',
			'title' => __('Fullwidth', 'themify')
		    )
		),
		'default' => 'default_width'
	    ),
	    // Section Type
	    array(
		'name' => 'video_type',
		'title' => __('Video', 'themify'),
		'description' => '',
		'type' => 'radio',
		'show_title' => true,
		'meta' => array(
		    array(
			'value' => 'embed',
			'name' => __('Embed URL', 'themify'),
			'selected' => true
		    ),
		    array(
			'value' => 'file',
			'name' => __('Custom Upload', 'themify')
		    ),
		),
		'enable_toggle' => true,
		'default' => 'embed'
	    ),
	    // Video URL
	    array(
		'name' => 'video_url',
		'title' => __('Video URL', 'themify'),
		'description' => __('Video embed URL such as YouTube or Vimeo video url (<a href="https://themify.me/docs/video-embeds">details</a>).', 'themify'),
		'type' => 'textbox',
		'meta' => array(),
		'toggle' => 'embed-toggle'
	    ),
	    // Video File
	    array(
		'name' => 'video_file',
		'title' => __('Video File', 'themify'),
		'description' => '',
		'type' => 'video',
		'meta' => array(),
		'toggle' => 'file-toggle'
	    ),
	    // Featured Image Size
	    array(
		'name' => 'feature_size',
		'title' => __('Image Size', 'themify'),
		'description' => sprintf(__('Image sizes can be set at <a href="%s">Media Settings</a> and <a href="%s" target="_blank">Regenerated</a>', 'themify'), 'options-media.php', 'https://wordpress.org/plugins/regenerate-thumbnails/'),
		'type' => 'featimgdropdown',
		'display_callback' => 'themify_is_image_script_disabled',
		'meta' => array(),
	    ),
	    // Multi field: Image Dimension
	    themify_image_dimensions_field(),
	    // External Link
	    array(
		'name' => 'external_link',
		'title' => __('External Link', 'themify'),
		'description' => __('Link Featured Image and Post Title to external URL', 'themify'),
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

/**
 * Video Slug
 * @param array $data
 * @return string
 */
function themify_video_slug($data = array()) {

    $data = themify_get_data();

    $video_slug = isset($data['themify_video_slug']) ? $data['themify_video_slug'] : apply_filters('themify_video_rewrite', 'video');
    $video_category_slug = isset($data['themify_video_category_slug']) ? $data['themify_video_category_slug'] : apply_filters('themify_video_category_rewrite', 'video-category');
    $video_tag_slug = isset($data['themify_video_tag_slug']) ? $data['themify_video_tag_slug'] : apply_filters('themify_video_tag_rewrite', 'video-tag');

    return '<p>
				<span class="label">' . __('Video Base Slug', 'themify') . '</span>
				<input type="text" name="themify_video_slug" value="' . $video_slug . '" class="slug-rewrite">
			</p>
			<p>
				<span class="label">' . __('Video Category Slug', 'themify') . '</span>
				<input type="text" name="themify_video_category_slug" value="' . $video_category_slug . '" class="slug-rewrite">
			</p>
			<p>
				<span class="label">' . __('Video Tag Slug', 'themify') . '</span>
				<input type="text" name="themify_Video_tag_slug" value="' . $video_tag_slug . '" class="slug-rewrite">
			</p>
			<hr>';
}

if (!function_exists('themify_theme_get_video_metaboxes')) {

    function themify_theme_get_video_metaboxes(array $args, &$meta_boxes) {
	return array(
	    array(
		'name' => __('Video Options', 'themify'),
		'id' => 'video-options',
		'options' => themify_theme_video_meta_box(),
		'pages' => 'video'
	    ),
	    array(
		'name' => __('Video Appearance', 'themify'),
		'id' => 'video-theme-design',
		'options' => themify_theme_design_meta_box(),
		'pages' => 'video'
	    )
	);
    }

}
