<?php

define('TEMPPATH', get_stylesheet_directory_uri());
define('IMAGES', TEMPPATH . "/images");

/* disable registrations */
add_action('register_form', function() {
    wp_die('Registrations are disabled.');
});

function custom_login_css() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() . '/login/login-style.css" />';
}
add_action('login_head', 'custom_login_css');

function kaeordic_wp_enqueues() {
    $parent_style = 'themify-music';

    wp_enqueue_style('kaeordic-google-fonts', 'https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900', false);

    $styles = [
        '/media-queries.min.css',
        '/rtl.min.css',
        '/themify/css/themify.framework.min.css',
        '/themify/css/themify-ui.min.css',
        '/themify/css/lightbox.min.css',
        '/themify/css/themify.common.min.css',
        '/themify/css/themify-ui-rtl.min.css',
        '/themify/css/themify-mediaelement.min.css',
        '/themify/css/themify-notification.min.css',
    ];

    foreach ($styles as $style) {
        wp_enqueue_style($parent_style, get_template_directory_uri() . $style);
    }
}
add_action('wp_enqueue_scripts', 'kaeordic_wp_enqueues');

function child_theme_setup() {
    // Register menus
    register_nav_menu('copyright', __('Copyright Menu', 'copyright-menu'));

    // Load textdomain
    load_child_theme_textdomain('themify-child', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'child_theme_setup');

function child_register_sidebar() {
    register_sidebar([
        'name' => 'Contact Us',
        'id' => 'contact-us',
        'description' => 'Widgets here are on the contact us page',
        'before_widget' => '<div id="contact-sidebar-%1$s" class="widget contact-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ]);
}
add_action('widgets_init', 'child_register_sidebar');

function custom_register_song_post_type() {
    register_post_type('album', [
        'labels' => [
            'name' => __('Albums', 'themify'),
            'singular_name' => __('Album', 'themify'),
        ],
        'supports' => ['title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'page-attributes'],
        'has_archive' => true,
        'hierarchical' => false,
        'public' => true,
        'exclude_from_search' => false,
        'rewrite' => ['slug' => 'songs', 'with_front' => false],
        'query_var' => true,
        'can_export' => true,
        'capability_type' => 'post',
        'menu_icon' => 'dashicons-images-alt2',
    ]);
}
add_action('init', 'custom_register_song_post_type', 20);

function gp_add_meta_boxes() {
    add_meta_box('song_link', 'Song Links', 'song_link_callback', 'album', 'advanced', 'high');
}
add_action('add_meta_boxes', 'gp_add_meta_boxes');

function song_link_callback($post) {
    $links = [
        'itunes' => 'iTunes Link',
        'spotify' => 'Spotify Link',
        'amazon' => 'Amazon Link',
        'gplay' => 'Google Play Link',
        'cdbaby' => 'CD Baby Link',
        'sndcld' => 'SoundCloud Link',
        'bandcamp' => 'BandCamp Link',
        'pandora' => 'Pandora Link',
    ];

    foreach ($links as $key => $label) {
        $value = get_post_meta($post->ID, $key, true);
        echo "<p>{$label}: <input type='text' name='{$key}' value='{$value}' style='width:100%;' /></p>";
    }
}

function wpdocs_save_meta_box($post_id, $post, $update) {
    if (get_post_type($post_id) !== 'album') {
        return;
    }

    $fields = ['itunes', 'spotify', 'amazon', 'gplay', 'cdbaby', 'sndcld', 'bandcamp', 'pandora'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, esc_attr($_POST[$field]));
        }
    }
}
add_action('save_post', 'wpdocs_save_meta_box', 10, 3);

function themify_audio_player_module() {
    $categories = array_merge(
        ['off' => ['name' => __('Disable Audio Player', 'themify'), 'value' => '']],
        themify_theme_get_albums()
    );

    $key = 'setting-audio_player_type';
    $type = themify_get($key);
    $html = '<div><span class="label">' . __('Player Displays', 'themify') . '</span></div>';
    $options = [
        'album' => __('Album', 'themify'),
        'songs' => __('Custom Songs', 'themify'),
        'code' => __('Custom Code', 'themify')
    ];

    $html .= '<div class="themify_player_types">';
    foreach ($options as $value => $label) {
        $checked = !$type && $value === 'album' || $type === $value ? 'checked="checked"' : '';
        $html .= "<label for='themify_player_type_{$value}'>
                    <input {$checked} type='radio' name='{$key}' id='themify_player_type_{$value}' value='{$value}' /> 
                    {$label}
                  </label>";
    }
    $html .= '</div>';

    $key = 'setting-audio_player';
    $html .= '<div class="pushlabel hide themify_album_tabs" id="themify_player_type_album_">';
    $html .= sprintf(
        '<select name="%s">%s</select>
        <p><small>%s</small></p>',
        $key,
        themify_options_module($categories, $key),
        __('Select an album to display or disable it completely.', 'themify')
    );

    $key = 'setting-audio_player_autoplay';
    $html .= sprintf(
        '<p><span><label for="%1$s"><input type="checkbox" id="%1$s" name="%1$s" %2$s /> %3$s</label></span></p>',
        $key,
        checked(themify_get($key), 'on', false),
        __('Auto play audio.', 'themify')
    );
    $html .= '</div>';

    $key = 'setting-audio_player_songs';
    $html .= '<div class="hide themify_album_tabs pushlabel" id="themify_player_type_songs_">';
    for ($i = 1; $i <= 12; $i++) {
        $title = themify_get($key . '_title_' . $i);
        $url = themify_get($key . '_url_' . $i);
        $img = themify_get($key . '_img_' . $i);
        $html .= sprintf(
            '<div class="row">
                <p>
                    <label class="label" for="themify_player_type_songs_title_%1$s">%2$s</label>
                    <input type="text" class="width10" id="themify_player_type_songs_title_%1$s" value="%3$s" name="%4$s_title_%1$s" />
                </p>
                <p>
                    <label class="label" for="themify_player_type_songs_url_%1$s">%5$s</label>
                    <input type="text" class="width10" id="themify_player_type_songs_url_%1$s" value="%6$s" name="%4$s_url_%1$s" />
                </p>
                <p>
                    <label class="label" for="themify_player_type_songs_image_%1$s">%7$s</label>
                    <input type="text" class="width10" id="themify_player_type_songs_image_%1$s" value="%8$s" name="%4$s_img_%1$s" />
                </p>
            </div>',
            $i,
            sprintf(__('Song Title %s', 'themify'), $i),
            esc_attr($title),
            $key,
            sprintf(__('Song File URL %s', 'themify'), $i),
            esc_attr($url),
            sprintf(__('Song Image %s', 'themify'), $i),
            esc_attr($img)
        );
    }

    $key = 'setting-audio_player_autoplay_songs';
    $html .= sprintf(
        '<p><span><label for="%1$s"><input type="checkbox" id="%1$s" name="%1$s" %2$s /> %3$s</label></span></p>',
        $key,
        checked(themify_get($key), 'on', false),
        __('Auto play audio.', 'themify')
    );
    $html .= '</div>';

    $key = 'setting-audio_player_code';
    $value = themify_get($key);
    $html .= '<div class="hide themify_album_tabs pushlabel" id="themify_player_type_code_">';
    $html .= '<p><textarea class="widthfull" rows="4" name="' . $key . '">' . esc_textarea($value) . '</textarea></p>';
    $html .= sprintf('<p><small>%s</small></p>', __('Insert any code (e.g SoundCloud embed code)'));
    $html .= '</div>';

    return $html;
}

?>