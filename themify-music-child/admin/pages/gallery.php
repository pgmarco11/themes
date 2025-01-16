<?php

/**
 * Gallery Meta Box Options
 * @var array Options for Themify Custom Panel
 * @since 1.0.0
 */
if (!function_exists('themify_theme_gallery_meta_box')) {

    function themify_theme_gallery_meta_box() {
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
	    // Gallery Shortcode
	    array(
		'name' => 'gallery_shortcode',
		'title' => __('Gallery', 'themify'),
		'description' => '',
		'type' => 'gallery_shortcode',
	    ),
	    // Featured Image Size
	    array(
		'name' => 'feature_size',
		'title' => __('Image Size', 'themify'),
		'description' => sprintf(__('Image sizes can be set at <a href="%s">Media Settings</a> and <a href="%s" target="_blank">Regenerated</a>', 'themify'), 'options-media.php', 'https://wordpress.org/plugins/regenerate-thumbnails/'),
		'type' => 'featimgdropdown',
		'meta' => array(),
		'display_callback' => 'themify_is_image_script_disabled'
	    ),
	    // Multi field: Image Dimension
	    themify_image_dimensions_field(),
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
 * Gallery Slug
 * @param array $data
 * @return string
 */
function themify_gallery_slug($data = array()) {

    $data = themify_get_data();

    $gallery_slug = isset($data['themify_gallery_slug']) ? $data['themify_gallery_slug'] : apply_filters('themify_gallery_rewrite', 'gallery');
    $gallery_category_slug = isset($data['themify_gallery_category_slug']) ? $data['themify_gallery_category_slug'] : apply_filters('themify_gallery_category_rewrite', 'gallery-category');
    $gallery_tag_slug = isset($data['themify_gallery_tag_slug']) ? $data['themify_gallery_tag_slug'] : apply_filters('themify_gallery_tag_rewrite', 'gallery-tag');

    return '<p>
		       <span class="label">' . __('Gallery Base Slug', 'themify') . '</span>
		       <input type="text" name="themify_gallery_slug" value="' . $gallery_slug . '" class="slug-rewrite">
	       </p>
	       <p>
		       <span class="label">' . __('Gallery Category Slug', 'themify') . '</span>
		       <input type="text" name="themify_gallery_category_slug" value="' . $gallery_category_slug . '" class="slug-rewrite">
	       </p>
	       <p>
		       <span class="label">' . __('Gallery Tag Slug', 'themify') . '</span>
		       <input type="text" name="themify_gallery_tag_slug" value="' . $gallery_tag_slug . '" class="slug-rewrite">
	       </p>
	       <hr>';
}

if (!function_exists('themify_theme_get_gallery_metaboxes')) {

    function themify_theme_get_gallery_metaboxes(array $args, &$meta_boxes) {
	return array(
	    array(
		'name' => __('Gallery Options', 'themify'),
		'id' => 'gallery-options',
		'options' => themify_theme_gallery_meta_box(),
		'pages' => 'gallery'
	    ),
	    array(
		'name' => __('Gallery Appearance', 'themify'),
		'id' => 'gallery-theme-design',
		'options' => themify_theme_design_meta_box(),
		'pages' => 'gallery'
	    )
	);
    }

}
