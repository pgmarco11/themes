<?php
// Main template file for single-project.php

get_header(); // Include the header.php template
echo '<p>index Post ID: ' . get_the_ID() . '</p>';
if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        // Debugging: Output post ID and post type
        echo '<p>index Post ID: ' . get_the_ID() . '</p>';
        echo '<p>index Post Type: ' . get_post_type() . '</p>';

        // Display the post title and content
        the_title('<h1>', '</h1>');
        the_content();
    endwhile;
else :
    echo '<p>No content found</p>';
endif;

get_footer(); // Include the footer.php template
?>

