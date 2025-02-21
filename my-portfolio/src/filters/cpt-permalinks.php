<?php

function custom_project_permalink_structure( $post_link, $post ) {
    if ( 'projects' == $post->post_type ) {
        $terms = get_the_terms( $post->ID, 'category' );
        if ( $terms && ! is_wp_error( $terms ) ) {
            $category = array_shift( $terms );
            $category_slug = $category->slug;
            $post_link = network_home_url( '/projects/' . $category_slug . '/' . $post->post_name . '/' );
        } else {
            $post_link = network_home_url( '/projects/' . $post->post_name . '/' );
        }
    }
    return $post_link;
}
add_filter( 'post_type_link', 'custom_project_permalink_structure', 10, 2 );


function custom_rewrite_rule() {
    add_rewrite_rule(
        '^projects/([^/]+)/([^/]+)/?',
        'index.php?post_type=projects&name=$matches[2]',
        'top'
    );
}
add_action( 'init', 'custom_rewrite_rule', 10, 0 );


function custom_flush_rewrite_rules() {
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'custom_flush_rewrite_rules' );




