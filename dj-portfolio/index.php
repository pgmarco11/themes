<?php
/*
 * Template Name: Home Page
 * Template Type: page
*/

get_header()

?>
<main>
    <div class="container-fluid pb-3">
                <?php         
                    if (is_front_page()) {
                        get_template_part('src/templates/home-page');
                    } else {
                        if (have_posts()) {
                            while (have_posts()) {
                                the_post();
                                the_content();
                            }
                        } else {
                            echo '<p>No content found</p>';
                        }
                    }
                ?>
    </div>
</main>

<?php

get_footer();
?>

