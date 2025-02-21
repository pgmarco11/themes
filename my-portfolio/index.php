<?php
// Main template file for single-project.php

get_header(); // Include the header.php template

?>
<section class="container-fluid">
    <div class="pb-5">
        <div class="row w-100">
        <?php 
            if ( have_posts() ) : while ( have_posts() ) : the_post(); 

            the_content();  

            endwhile;
            else :
                echo '<p>No content found</p>';
            endif;
        ?>
        </div>
    </div>
</section>

<?php

get_footer(); // Include the footer.php template
?>

