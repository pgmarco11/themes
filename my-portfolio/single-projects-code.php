<?php
/*
* Template Name: Plugin and React Projects
* Template Post Type: projects
*/

get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();

        // Check if the post type is 'project'
        ?>

        <div class="row project-container container-fluid">

            <div class="col-lg-12 project-content p-5 mt-5">
                <?php 
                $website_url = get_field('website_url'); 
                $github_link = get_field('github_link');
                $project_description = get_field('project_description');
                $title_url = get_the_title();
                ?>
                <?php 
                
                the_title('<h1>', '</h1>');               

                if($project_description) :
                    echo '<p>' . htmlspecialchars_decode($project_description) . '</p>';
                endif;
                ?>
                

                <?php if($website_url) : ?>
                    <h5>Website link:</h5>
                    <a href="<?= $website_url; ?>" title="<?= $title_url; ?>" target="_blank"><?= $website_url; ?></a>
                    <br><br>
                <?php endif; ?>
     
                <?php if($github_link) : ?>
                    <h5>Github link:</h5>
                    <a href="<?= $github_link; ?>" title="<?= $title_url; ?>" target="_blank"><?= $github_link; ?></a>
                <?php endif; ?>
                <br><br>
                <?php the_content(); ?>   

            </div>

        </div>
        <div id="image-modal" class="modal">
            <div class="image-modal">
                <span class="close">&times;</span>
                <img class="modal-content" id="modal-image">
            </div>            
        </div>
        <div class="project-images container-fluid">
            <?php
            // Retrieve images from the ACF field `project_slideshow_images`
            $slide_images = get_field('project_slideshow_images'); // Assumes this field is set as a gallery or post_object

            if ($slide_images) : ?>
                <div class="project-container-images">
                    <div class="project-wrapper">
                        <?php foreach ($slide_images as $slide_image) :
                            // Handle WP_Post objects
                            $image_url = is_object($slide_image) ? $slide_image->guid : (is_array($slide_image) ? $slide_image['url'] : wp_get_attachment_url($slide_image));
                            ?>
                            <div class="slide">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="" class="popup-image">
                            </div>
                        <?php endforeach; ?>
                    </div>    
                </div>

                <script>
                document.addEventListener('DOMContentLoaded', function () {  

                    // Modal functionality
                    const modal = document.getElementById('image-modal');
                    const modalImage = document.getElementById('modal-image');
                    const closeBtn = document.getElementsByClassName('close')[0];

                    document.querySelectorAll('.popup-image').forEach(image => {
                        image.addEventListener('click', function(event) {
                            event.preventDefault();
                            modal.style.display = 'block';
                            modalImage.src = this.src;
                        });
                    });

                    closeBtn.onclick = function() {
                        modal.style.display = 'none';
                    }

                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = 'none';
                        }
                    }

                });
                </script>
                
            <?php endif; ?>
        </div>

        <?php
    endwhile;
else :
    echo '<p>No content found</p>';
endif;

get_footer();

