<?php
require_once get_template_directory() . '/src/functions/theme-settings.php';


//Theme Setup
function theme_setup() {
    add_theme_support( 'title-tag' );
	add_theme_support( 'custom-header' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
	    // Register menu locations
		register_nav_menus( array(
            'main' => 'Main Menu'
		) );
}
add_action( 'after_setup_theme', 'theme_setup' );


function my_theme_enqueue_scripts() {

  // Enqueue Bootstrap from CDN
  wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', array(), '4.5.2', 'all');

  // Enqueue Font Awesome from CDN
  wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0', 'all');

  // Enqueue scripts
  wp_enqueue_script('jquery');
  wp_enqueue_script('popper-js', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js', array('jquery'), '2.5.4', true);
  wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'), '4.5.2', 'all');

  if(is_front_page()){
    wp_enqueue_script('load-more', get_template_directory_uri() . '/src/scripts/load-more.js', array('jquery'), null, true);

    // Add localized data for AJAX
    wp_localize_script('load-more', 'load_more_params', array(
        'ajax_url' => admin_url('admin-ajax.php'), 
        'nonce' => wp_create_nonce('load_more_nonce')
    ));
  }     

    // Path to the manifest file
    $manifest_file = get_template_directory() . '/dist/manifest.json';
    $dist_folder = get_template_directory_uri() . '/dist/';
    $css_file = null;
    $js_file = null;
    $manifest = null;

    // Attempt to load the manifest file
    if (file_exists($manifest_file)) {
        $manifest = json_decode(file_get_contents($manifest_file), true);

        if ($manifest !== null) {
            // Get CSS and JS paths from the manifest
            $css_file = isset($manifest['main.css']) ? $dist_folder . $manifest['main.css'] : null;
            $js_file = isset($manifest['main.js']) ? $dist_folder . $manifest['main.js'] : null;
        }
    }
    // Fallback: Look for the most recent main.css and main.js files in /dist
    if (!$css_file) {
        $css_glob = glob(get_template_directory() . '/dist/css/main*.css');
        if (!empty($css_glob)) {
            $css_file = $dist_folder . 'css/' . basename($css_glob[0]);
        }
    }
    if (!$js_file) {
            $js_glob = glob(get_template_directory() . '/dist/js/main*.js');
            if (!empty($js_glob)) {
                $js_file = $dist_folder . 'js/' . basename($js_glob[0]);
            }
    }
    // Enqueue the CSS file
    if ($css_file) {
            wp_enqueue_style('dj-portfolio-style', $css_file, array(), null);
    }
    // Enqueue the JS file
    if ($js_file) {
        wp_enqueue_script('dj-portfolio-scripts', $js_file, array(), null, true);
    }
    if ($manifest !== null) {

          // Enqueue the CSS file using the path from the manifest, including the hash as version
        if (isset($manifest['main.css'])) {
            $css_file = $manifest['main.css'];
            wp_enqueue_style('dj-portfolio-style', get_template_directory_uri() . $css_file, array());      
        }   

          // Enqueue the JS file using the path from the manifest
        if (isset($manifest['main.js'])) {
            $js_file = $manifest['main.js'];
            wp_enqueue_script('dj-portfolio-scripts', get_template_directory_uri() . $js_file, array(), null, true);
        }            
    }
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');

function add_defer_to_jquery( $tag, $handle ) {
    if ( 'jquery' !== $handle ) {
        return $tag;
    }

    return str_replace( ' src', ' defer="defer" src', $tag );
}
add_filter( 'script_loader_tag', 'add_defer_to_jquery', 10, 2 );
