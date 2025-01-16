<?php
// Main template file for single projects
?>
<style>
.image-modal {
    margin:0 auto;
    width: 90%;
}
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow-y: auto; /* Allow vertical scrolling within the modal */
    background-color: rgba(0, 0, 0, 0.8); /* Transparent dark background */
}
body.modal-open {
    overflow: hidden;
}

.modal-content {
    max-width: max-content;
    max-height: 90%;
    margin: 2.5rem auto 5rem auto;
    overflow-y: auto;
    display: block;  
    height: auto;
    max-height: calc(100% - 10rem); /* Adjust height to ensure it fits within the viewport */
    object-fit: contain; /* Ensure image fits within its container */
    width: 95% !important;
    border:4px solid rgba(0,0,0,.6) !important;
    background-color: rgba(0,0,0,.2) !important;
}

.close {
    top: 0;
    right: 35px;
    color: #f1f1f1 !important;
    font-size: 40px !important;
    transition: 0.3s;
    z-index: 1001; /* Ensure it appears above the modal content */
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}
</style>
<?php

get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();

        // Check if the post type is 'project'
        ?>

        <div class="row project-container container-fluid">

            <div class="col-lg-6 project-content p-5">
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
                    <a href="<?= $website_url; ?>" title="<?= $title_url; ?>"><?= $website_url; ?></a>
                <?php endif; ?>
     
                <?php if($github_link) : ?>
                    <h5>Github link:</h5>
                    <a href="<?= $github_link; ?>" title="<?= $title_url; ?>"><?= $github_link; ?></a>
                <?php endif; ?>
                <br><br>
                <?php the_content(); ?>   

            </div>

            <div class="col-lg-6 project-image p-5">
                <?php the_post_thumbnail('full'); ?>
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

