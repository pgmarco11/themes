<?php
require_once get_template_directory() . '/src/filters/cpt-permalinks.php';
require_once get_template_directory() . '/src/functions/theme-settings.php';


//Theme Setup
function theme_setup() {
    add_theme_support( 'title-tag' );
	add_theme_support( 'custom-header' );
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
  wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '5.15.4', 'all');

  // Enqueue scripts
  wp_enqueue_script('jquery');
  wp_enqueue_script('popper-js', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js', array('jquery'), '2.5.4', true);
  wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'), '4.5.2', 'all');

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
            wp_enqueue_style('my-theme-style', $css_file, array(), null);
    }
    // Enqueue the JS file
    if ($js_file) {
        wp_enqueue_script('my-theme-scripts', $js_file, array(), null, true);
    }
    if ($manifest !== null) {

          // Enqueue the CSS file using the path from the manifest, including the hash as version
        if (isset($manifest['main.css'])) {
            $css_file = $manifest['main.css'];
            wp_enqueue_style('my-theme-style', get_template_directory_uri() . $css_file, array());      
        }   

          // Enqueue the JS file using the path from the manifest
        if (isset($manifest['main.js'])) {
            $js_file = $manifest['main.js'];
            wp_enqueue_script('my-theme-scripts', get_template_directory_uri() . $js_file, array(), null, true);
        }            
    }
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');

// Enqueue Swiper.js in WordPress
function enqueue_slider_scripts() {
    wp_enqueue_style('swiper-style', 'https://unpkg.com/swiper/swiper-bundle.min.css');
    wp_enqueue_script('swiper-script', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], null, true);
    wp_add_inline_script('swiper-script', "
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.swiper', {
                slidesPerView: 5,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 3,
                        centeredSlides: true,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 6,
                        spaceBetween: 30,
                    },
                },
            });
        });
    ");
}
add_action('wp_enqueue_scripts', 'enqueue_slider_scripts');