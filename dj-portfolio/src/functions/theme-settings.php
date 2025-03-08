<?php

//Global Fields for Social Theme Settings
function theme_add_settings_page() {
    add_menu_page(
        'Theme Settings',
        'Theme Settings',
        'manage_options',
        'theme-settings',
        'theme_settings_page_html',
        'dashicons-admin-generic',
        20
    );
}
add_action('admin_menu', 'theme_add_settings_page');

function theme_settings_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_POST['theme_settings_submit'])) {
        update_option('email_address', sanitize_email($_POST['email_address']));
        update_option('facebook_url', esc_url_raw($_POST['facebook_url']));
        update_option('x_url', esc_url_raw($_POST['x_url']));
        update_option('instagram_url', esc_url_raw($_POST['instagram_url']));
        update_option('youtube_url', esc_url_raw($_POST['youtube_url']));
    }

    $email_address = get_option('email_address');
    $facebook_url = get_option('facebook_url');
    $x_url = get_option('x_url');
    $instagram_url = get_option('instagram_url');
    $youtube_url = get_option('youtube_url');
   
    ?>

    <div class="wrap">
        <h1>Theme Settings</h1>
        <form method="POST">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="email_address">Email Address</label></th>
                    <td><input type="email" name="email_address" id="email_address" value="<?php echo esc_attr($email_address); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="facebook_url">Facebook URL</label></th>
                    <td><input type="url" name="facebook_url" id="facebook_url" value="<?php echo esc_url($facebook_url); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="x_url">X URL</label></th>
                    <td><input type="url" name="x_url" id="x_url" value="<?php echo esc_url($x_url); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="instagram_url">Instagram URL</label></th>
                    <td><input type="url" name="instagram_url" id="instagram_url" value="<?php echo esc_url($instagram_url); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="youtube_url">YouTube URL</label></th>
                    <td><input type="url" name="youtube_url" id="youtube_url" value="<?php echo esc_url($youtube_url); ?>" class="regular-text"></td>
                </tr>
            </table>
            <p class="submit">
                <button type="submit" name="theme_settings_submit" class="button button-primary">Save Changes</button>
            </p>
        </form>
    </div>

    <?php
}

//CTP for dj mixes
function register_mixes_post_type() {
    $labels = array(
        'name'               => __('Mixes'),
        'singular_name'      => __('Mix'),
        'menu_name'          => __('Mixes'),
        'name_admin_bar'     => __('Mix'),
        'add_new'            => __('Add New Mix'),
        'add_new_item'       => __('Add New Mix'),
        'new_item'           => __('New Mix'),
        'edit_item'          => __('Edit Mix'),
        'view_item'          => __('View Mix'),
        'all_items'          => __('All Mixes'),
        'search_items'       => __('Search Mixes'),
        'not_found'          => __('No mixes found'),
        'not_found_in_trash' => __('No mixes found in Trash')
    );

//Taxonomy for Mixes
$args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'show_in_rest'       => true, 
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-album',
        'supports'           => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'taxonomies'         => array('mix_genre'),
    );

    register_post_type('mixes', $args);
}
add_action('init', 'register_mixes_post_type');

function register_mix_genre_taxonomy() {
    $labels = array(
        'name'              => __('Mix Genres'),
        'singular_name'     => __('Mix Genre'),
        'search_items'      => __('Search Genres'),
        'all_items'         => __('All Genres'),
        'parent_item'       => __('Parent Genre'),
        'parent_item_colon' => __('Parent Genre:'),
        'edit_item'         => __('Edit Genre'),
        'update_item'       => __('Update Genre'),
        'add_new_item'      => __('Add New Genre'),
        'new_item_name'     => __('New Genre Name'),
        'menu_name'         => __('Mix Genres'),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'hierarchical'      => true,
        'show_admin_column' => true,
        'show_in_rest'      => true, 
    );

    register_taxonomy('mix_genre', array('mixes'), $args);
}
add_action('init', 'register_mix_genre_taxonomy');

function register_mix_type_taxonomy() {
    $labels = array(
        'name'              => __('Mix Types'),
        'singular_name'     => __('Mix Type'),
        'search_items'      => __('Search Types'),
        'all_items'         => __('All Types'),
        'edit_item'         => __('Edit Type'),
        'update_item'       => __('Update Type'),
        'add_new_item'      => __('Add New Type'),
        'new_item_name'     => __('New Type Name'),
        'menu_name'         => __('Mix Types'),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'hierarchical'      => false, 
        'show_admin_column' => true,
        'show_in_rest'      => true, 
    );

    register_taxonomy('mix_type', array('mixes'), $args);
}
add_action('init', 'register_mix_type_taxonomy');

function add_default_mix_terms() {

    if (!taxonomy_exists('mix_genre') || !taxonomy_exists('mix_type')) {
        return;
    }

    // Add default genres
    if (!term_exists('House', 'mix_genre')) {
        wp_insert_term('House', 'mix_genre');
    }
    if (!term_exists('Deep House', 'mix_genre')) {
        wp_insert_term('Deep House', 'mix_genre', array('parent' => get_term_by('name', 'House', 'mix_genre')->term_id));
    }
    if (!term_exists('Techno', 'mix_genre')) {
        wp_insert_term('Techno', 'mix_genre');
    }

    // Add default mix types
    if (!term_exists('Digital', 'mix_type')) {
        wp_insert_term('Digital', 'mix_type');
    }
    if (!term_exists('Vinyl', 'mix_type')) {
        wp_insert_term('Vinyl', 'mix_type');
    }
    if (!term_exists('CD', 'mix_type')) {
        wp_insert_term('CD', 'mix_type');
    }
}

function load_more_posts() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'load_more_nonce')) {
        wp_die('Permission Denied');
    }

    // Get already displayed post IDs
    $excluded_posts = isset($_POST['excluded_posts']) ? array_map('intval', $_POST['excluded_posts']) : [];
    $posts_per_page = 1; // Load ONE mix at a time

    $args = array(
        'post_type'      => 'mixes',
        'posts_per_page' => $posts_per_page,
        'orderby'        => 'date',
        'order'          => 'ASC',
        'post__not_in'   => $excluded_posts // Exclude already displayed posts
    );

    error_log('DEBUG: WP_Query args: ' . print_r($args, true)); // Log query params

    $mixes_query = new WP_Query($args);

    if (!$mixes_query->have_posts()) {
        error_log('DEBUG: No more posts to load.');
        wp_send_json_success(['no_more_posts' => true]);
        wp_die();
    }

    ob_start();

    while ($mixes_query->have_posts()) {
        $mixes_query->the_post();
        $excluded_posts[] = get_the_ID(); // Track newly displayed post

        // Get genres
        $genres = [];
        $genre_terms = get_the_terms(get_the_ID(), 'mix_genre');
        if ($genre_terms) {
            foreach ($genre_terms as $genre) {
                if ($genre->parent == 0) {
                    $genres[$genre->name][] = get_the_ID();
                }
            }
        }

        // Now display each parent genre with its mixes
        foreach ($genres as $parent_genre => $mix_ids):
        ?>
            <div class="col-12">
                <h3 class="text-center"><?php echo esc_html($parent_genre); ?></h3>
                <div class="row">
                    <?php foreach ($mix_ids as $mix_id): 
                        $post = get_post($mix_id);
                        setup_postdata($post);
                        $soundcloud_url = get_field('soundcloud_url');
                        $sub_genre = '';
                        $mix_type = get_the_terms(get_the_ID(), 'mix_type');

                        // Get sub-genres
                        $sub_genre_terms = get_the_terms(get_the_ID(), 'mix_genre');
                        foreach ($sub_genre_terms as $genre) {
                            if ($genre->parent != 0) {
                                $sub_genre = $genre->name;
                            }
                        }

                        if ($mix_type) {
                            $mix_type_names = array_map(function($type) {
                                return esc_html($type->name);
                            }, $mix_type);
                        }
                    ?>
                    <div class="w-100 mix-item" data-post-id="<?php echo get_the_ID(); ?>">
                        <div class="mix-card">
                            <div class="row" style="width: 100%; display: flex; align-items: center;"> 
                                <div class="col-4">
                                    <?php if (has_post_thumbnail()): ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium', ['class' => 'img-fluid']); ?>
                                        </a>
                                    <?php endif; ?>  
                                </div>                                                    
                                <div class="col-8">
                                    <div class="mix-content text-left mb-1">
                                        <h4><?php the_title(); ?></h4>
                                        <div class="d-inline position-relative w-100">
                                            <?php if ($sub_genre): ?>
                                                <strong>Genre:</strong> <?php echo esc_html($sub_genre) . '&nbsp;&nbsp;'; ?>
                                            <?php endif; ?>
                                            <?php if ($mix_type): ?>
                                                <strong>Mix Type:</strong> <?php echo implode(' + ', $mix_type_names); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if ($soundcloud_url): ?>
                                    <div class="mix-player">
                                            <iframe id="soundcloud-widget" width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" show_related=false
                                                src="https://w.soundcloud.com/player/?url=<?php echo urlencode($soundcloud_url); ?>&auto_play=false&show_artwork=false"></iframe>
                                    </div>
                                    <?php endif; ?>
                                </div>                                                    
                            </div>
                        </div> <!-- end mix card -->   
                    </div> <!-- end mix item -->   
                    <?php endforeach; ?>
                </div> <!-- end row -->
            </div> <!-- end col -->
        <?php endforeach; ?>
        <?php
    }

    $html = ob_get_clean();    
    error_log('DEBUG: Sending response with excluded posts: ' . print_r($excluded_posts, true)); // Log updated excluded posts

    wp_send_json_success([
        'html' => $html,
        'excluded_posts' => $excluded_posts
    ]);

    wp_reset_postdata();
    wp_die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');


