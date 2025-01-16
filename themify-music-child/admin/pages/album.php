<?php

/**
 * Album Meta Box Options
 * @var array Options for Themify Custom Panel
 * @since 1.0.0
 */
if (!function_exists('themify_theme_album_meta_box')) {

    function themify_theme_album_meta_box() {
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
	    // Artist
	    array(
		'name' => 'artist',
		'title' => __('Artist', 'themify'),
		'description' => __('Enter the artist(s) featured in this album.', 'themify'),
		'type' => 'textbox',
		'meta' => array(),
	    ),
	    // Artist
	    array(
		'name' => 'released',
		'title' => __('Released', 'themify'),
		'description' => __('Enter the year of release of this album.', 'themify'),
		'type' => 'textbox',
		'meta' => array(),
	    ),
	    // Artist
	    array(
		'name' => 'genre',
		'title' => __('Genre', 'themify'),
		'description' => __('Enter the genre of the music in this album.', 'themify'),
		'type' => 'textbox',
		'meta' => array(),
	    ),
	    // Artist
	    array(
		'name' => 'buy_album',
		'title' => __('Buy Album Link', 'themify'),
		'description' => __('Enter link to album buying page.', 'themify'),
		'type' => 'textbox',
		'meta' => array(),
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
	    // Video URL
	    array(
		'name' => 'video_url',
		'title' => __('Video URL', 'themify'),
		'description' => __('Replace Featured Image with a video embed URL such as YouTube or Vimeo video url (<a href="https://themify.me/docs/video-embeds">details</a>).', 'themify'),
		'type' => 'textbox',
		'meta' => array()
	    ),
	    // Multi field: Image Dimension
	    themify_image_dimensions_field(array(
		'meta' => array(
		    'fields' => array(
			// Image Width
			array(
			    'name' => 'image_width',
			    'label' => __('width', 'themify'),
			    'description' => '',
			    'type' => 'textbox',
			    'meta' => array('size' => 'small'),
			    'before' => '',
			    'after' => '',
			),
			// Image Height
			array(
			    'name' => 'image_height',
			    'label' => __('height', 'themify'),
			    'type' => 'textbox',
			    'meta' => array('size' => 'small'),
			    'before' => '',
			    'after' => '',
			),
		    ),
		    'description' => __('Enter height = 0 to disable vertical cropping with image script enabled.', 'themify') . '<br/><strong>' . __('In single album view, the width value is used for width and height to render a squared cover.') . '</strong>',
		    'before' => '',
		    'after' => '',
		    'separator' => ''
		),
	    )),
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
 * Tracks Meta Box Options
 * @return array
 * @since 1.0.0
 */
function themify_theme_tracks_meta_box() {

    return array(
	array(
	    'name' => 'tracks_type',
	    'description' => '',
	    'type' => 'radio',
	    'meta' => array(
		array(
		    'value' => 'sound_tracks',
		    'name' => __('Sound Tracks', 'themify'),
		),
		array(
		    'value' => 'custom_embeds',
		    'name' => __('Custom Embeds', 'themify'),
		)
	    ),
	    'enable_toggle' => true,
	    'default' => 'sound_tracks',
	),
	array(
	    'name' => 'album_tracks',
	    'type' => 'repeater',
	    'toggle' => 'sound_tracks-toggle',
	    'fields' => array(
		array(
		    'name' => '_separator_track',
		    'title' => '',
		    'description' => '',
		    'type' => 'separator',
		    'meta' => array(
			'html' => '<h4>' . __('Track Details', 'themify') . '</h4><hr class="meta_fields_separator"/>'
		    ),
		),
		array(
		    'name' => 'name',
		    'title' => __('Name', 'themify'),
		    'description' => '',
		    'type' => 'textbox',
		    'meta' => array(),
		),
		array(
		    'name' => 'file',
		    'title' => __('Song File', 'themify'),
		    'description' => sprintf(__('Supported audio formats: %s.', 'themify'), implode(', ', wp_get_audio_extensions())),
		    'type' => 'audio',
		    'meta' => array()
		),
		array(
		    'name' => 'button',
		    'title' => __('Button Label', 'themify'),
		    'description' => '',
		    'type' => 'textbox',
		    'meta' => array(),
		),
		array(
		    'name' => 'button_url',
		    'title' => __('Button URL', 'themify'),
		    'description' => '',
		    'type' => 'textbox',
		    'meta' => array(),
		),
	    ),
	    'add_new_label' => __('Add new track', 'themify')
	),
	array(
	    'name' => 'album_embeds',
	    'description' => __('Custom audio embeds such as Spotify, SoundCloud, etc.', 'themify'),
	    'type' => 'textarea',
	    'toggle' => 'custom_embeds-toggle',
	    'meta' => array()
	)
    );
}

/**
 * Markup for album category selection for audio player.
 * @return string
 */
function themify_audio_player_module() {
    $albums = get_posts(array(
	'post_type' => 'album',
	'no_found_rows' => true,
	'posts_per_page' => -1
    ));
    $categories = array(
	'off' => array(
	    'name' => __('Disable Audio Player', 'themify'),
	    'value' => ''
	)
    );
    if (!empty($albums)) {
	foreach ($albums as $album) {
	    $categories[$album->ID] = array(
		'name' => $album->post_title,
		'value' => $album->post_name
	    );
	}
    }
    $albums = null;

    /**
     * Module markup
     * @var string
     */
    $key = 'setting-audio_player_type';
    $type = themify_get($key, '', true);
    $html = '<div><span class="label">' . __('Player Displays', 'themify') . '</span></div>';
    $html .= sprintf(
	    '<div class="themify_player_types">
                                <label for="themify_player_type_album">
                                    <input %5$s type="radio" name="%4$s" id="themify_player_type_album" value="album" /> 
                                    %1$s
                                </label>
                                <label for="themify_player_type_songs">
                                    <input %6$s type="radio" name="%4$s" id="themify_player_type_songs" value="songs" />
                                    %2$s
                                </label>
                                <label for="themify_player_type_code">
                                    <input %7$s type="radio" name="%4$s" id="themify_player_type_code" value="code" />
                                    %3$s
                                </label>
                            </div>
			',
	    __('Album', 'themify'),
	    __('Custom Songs', 'themify'),
	    __('Custom Code', 'themify'),
	    $key,
	    !$type || $type == 'album' ? 'checked="checked"' : '',
	    $type == 'songs' ? 'checked="checked"' : '',
	    $type == 'code' ? 'checked="checked"' : ''
    );
    $key = 'setting-audio_player';
    $html .= ' <div class="pushlabel hide themify_album_tabs" id="themify_player_type_album_">';
    $html .= sprintf('
                            <select name="%s">%s</select>
                            <p><small>%s</small></p>
                            ',
	    $key,
	    themify_options_module($categories, $key),
	    __('Select an album to display or disable it completely.', 'themify')
    );

    $key = 'setting-audio_player_autoplay';
    /**
     * Autoplay markup
     * @var string
     */
    $html .= sprintf('<p><span><label for="%1$s"><input type="checkbox" id="%1$s" name="%1$s" %2$s /> %3$s</label></span></p>',
	    $key,
	    checked(themify_get($key, '', true), 'on', false),
	    __('Auto play audio.', 'themify')
    );
    $html .= '</div>';

    /**
     * Custom Songs 
     */
    $key = 'setting-audio_player_songs';


    $html .= '<div class="hide themify_album_tabs pushlabel" id="themify_player_type_songs_">';
    for ($i = 1; $i <= 7; ++$i) {
	$title = themify_get($key . '_title_' . $i, '', true);
	$url = themify_get($key . '_url_' . $i, '', true);
	$img = themify_get($key . '_img_' . $i, '', true);
	$html .= sprintf('
                                <div class="row">
                                    <p>
                                        <label class="label" for="themify_player_type_songs_title_' . $i . '">%s</label>
                                        <input type="text" class="width9" id="themify_player_type_songs_title_' . $i . '" value="' . $title . '" name="%4$s_title_' . $i . '" />
                                    </p>
                                    <p>
                                        <label class="label" for="themify_player_type_songs_url_' . $i . '">%s</label>
                                        <input type="text" class="width9" id="themify_player_type_songs_url_' . $i . '" value="' . $url . '" name="%4$s_url_' . $i . '" />
                                        <span class="themify_medialib_wrapper">
											<a href="#" class="themify-media-lib-browse" data-submit=\'' . json_encode(array('action' => 'themify_handle_songs_url', 'field_name' => 'themify_player_type_songs_url_' . $i)) . '\' data-uploader-title="' . __('Upload Song', 'themify') . '" data-uploader-button-text="' . __('Upload song', 'themify') . '" data-fields="themify_player_type_songs_url_' . $i . '" data-type="audio">' . __('Browse Library', 'themify') . '</a>
										</span>
                                    </p>
                                    <p>
                                        <label class="label" for="themify_player_type_songs__image_' . $i . '">%s</label>
                                        <input type="text" class="width9" id="themify_player_type_songs_image_' . $i . '" value="' . $img . '" name="%4$s_img_' . $i . '" />
                                        <span class="themify_medialib_wrapper">
											<a href="#" class="themify-media-lib-browse" data-submit=\'' . json_encode(array('action' => 'themify_handle_image_upload', 'field_name' => 'themify_player_type_songs_image_' . $i . '')) . '\' data-uploader-title="' . __('Upload Image', 'themify') . '" data-uploader-button-text="' . __('Upload Image', 'themify') . '" data-fields="themify_player_type_songs_image_' . $i . '" data-type="image">' . __('Browse Library', 'themify') . '</a>
										</span>
                                    </p>
                                </div>
                                ',
		sprintf(__('Song Title %s', 'themify'), $i),
		sprintf(__('Song File URL %s', 'themify'), $i),
		sprintf(__('Song Image %s', 'themify'), $i),
		$key
	);
    }

    $key = 'setting-audio_player_autoplay_songs';
    /**
     * Autoplay markup
     * @var string
     */
    $html .= sprintf('<p><span><label for="%1$s"><input type="checkbox" id="%1$s" name="%1$s" %2$s /> %3$s</label></span></p>',
	    $key,
	    checked(themify_get($key, '', true), 'on', false),
	    __('Auto play audio.', 'themify')
    );
    $html .= '</div>';

    /**
     * Custom code 
     */
    $key = 'setting-audio_player_code';
    $value = themify_get($key, '', true);
    $html .= '<div class="hide themify_album_tabs pushlabel" id="themify_player_type_code_">';
    $html .= '<p><textarea class="widthfull" rows="4" name="' . $key . '">' . $value . '</textarea></p>';
    $html .= sprintf('<p><small>%s</small></p>', __('Insert any code (e.g SoundCloud embed code)'));
    $html .= '</div>';
    return $html;
}

/**
 * Album Slug
 * @param array $data
 * @return string
 */
function themify_album_slug($data = array()) {

    $data = themify_get_data();
    $album_slug = isset($data['themify_album_slug']) ? $data['themify_album_slug'] : apply_filters('themify_album_rewrite', 'album');
    $album_category_slug = isset($data['themify_album_category_slug']) ? $data['themify_album_category_slug'] : apply_filters('themify_album_category_rewrite', 'album-category');
    $album_tag_slug = isset($data['themify_album_tag_slug']) ? $data['themify_album_tag_slug'] : apply_filters('themify_album_tag_rewrite', 'album-tag');
    return '
			<p>
				<span class="label">' . __('Album Base Slug', 'themify') . '</span>
				<input type="text" name="themify_album_slug" value="' . $album_slug . '" class="slug-rewrite">
			</p>
			<p>
				<span class="label">' . __('Album Category Slug', 'themify') . '</span>
				<input type="text" name="themify_album_category_slug" value="' . $album_category_slug . '" class="slug-rewrite">
			</p>
			<p>
				<span class="label">' . __('Album Tag Slug', 'themify') . '</span>
				<input type="text" name="themify_album_tag_slug" value="' . $album_tag_slug . '" class="slug-rewrite">
			</p>
			<hr/>';
}

if (!function_exists('themify_theme_get_album_metaboxes')) {

    function themify_theme_get_album_metaboxes(array $args, &$meta_boxes) {
	return array(
	    array(
		'name' => __('Album Options', 'themify'),
		'id' => 'album-options',
		'options' => themify_theme_album_meta_box(),
		'pages' => 'album'
	    ),
	    array(
		'name' => __('Album Appearance', 'themify'),
		'id' => 'album-theme-design',
		'options' => themify_theme_design_meta_box(),
		'pages' => 'album'
	    ),
	    array(
		'name' => __('Album Tracks', 'themify'),
		'id' => 'album-tracks',
		'options' => themify_theme_tracks_meta_box(),
		'pages' => 'album'
	    ),
	);
    }

}
