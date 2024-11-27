<?php
// ** generates the permalink custom post type shows for search
add_filter('post_type_link', 'custom_post_permalink', 10, 2);
function custom_post_permalink($permalink, $post) {
    if ($post->post_type == 'shows') {
        $year = get_the_date('Y', $post->ID);
        $postname = $post->post_name;
        $permalink = home_url('/shows/' . $year . '/' . $postname . '/');
    }
    return $permalink;
}
// ** Fix search results to include all post types
add_filter( 'pre_get_posts', 'menu_fix_on_search_page' );
function menu_fix_on_search_page( $query ) {
  if ( is_search() ) {
    $query->set( 'post_type', array( 'page', 'post', 'shows', 'nav_menu_item' ) );
    return $query;
  }
  return $query;
}
//adds not-home class to all pages not homepage
add_filter('body_class', 'custom_body_class');
function custom_body_class($classes) {
  // Check if it's not the home page
  if (!is_home() && !is_front_page()) {
      // Add your custom class
      $classes[] = 'not-home';
  }
  return $classes;
}
// ** Remove default excerpt "Read More" link
add_filter('excerpt_more', 'remove_excerpt_more_link');
function remove_excerpt_more_link($more) {
  return '';
}
// ** Custom excerpt ellipsis (...)
add_filter('excerpt_more', 'custom_excerpt_more');
function custom_excerpt_more($more) {
  return '...';
}
?>