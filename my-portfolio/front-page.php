<?php
/*
*
* Template Name: Front Page Template
* 
*/


get_header(); 

//ACF Fields
$tagline = get_field('tagline');
$button_link = get_field('button_link');
$button_text = get_field('button_text');
$video_url = get_field('background_video');
?>

<?php if ($video_url): ?>
    <video class="site-background-video" autoplay loop muted>
        <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
<?php endif; ?>

<!-- Hero Section -->
<section id="hero" class="hero-section d-flex align-items-center justify-content-center text-center">
    <div class="hero-content">
        <h1 class="hero-tagline"><?php echo htmlspecialchars_decode($tagline); ?></h1>
        <a href="<?php echo esc_url($button_link); ?>" class="btn btn-md btn-link hero-cta"><?php echo esc_html($button_text); ?> <i class="fas fa-angles-right"></i></a>
    </div>
</section>

<!-- About Section -->
 <?php
 $column_1_icon = get_field('column_1_icon');
 $column_2_icon = get_field('column_2_icon');
 $column_3_icon = get_field('column_3_icon'); 
 ?>
<section id="About" class="about-column-section container-fluid my-0">
    <div class="container py-5">
        <button class="slider-arrow left" aria-label="Scroll left">&lt;</button>
        <div class="row py-4">
            <div class="col-md-4 text-center">
                <div class="content">
                    <?php if($column_1_icon): ?>
                        <div class="icon">
                            <?php echo get_field('column_1_icon'); // Output raw HTML ?>
                        </div>
                    <?php endif; ?>
                    <?php echo wp_kses_post(get_field('about_column_1')); ?>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="content">
                    <?php if($column_2_icon): ?>
                        <div class="icon">
                            <?php echo get_field('column_2_icon'); // Output raw HTML ?>
                        </div>
                    <?php endif; ?>
                    <?php echo wp_kses_post(get_field('about_column_2')); ?>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="content">
                    <?php if($column_3_icon): ?>
                        <div class="icon">
                            <?php echo get_field('column_3_icon'); // Output raw HTML ?>
                        </div>
                    <?php endif; ?>
                    <?php echo wp_kses_post(get_field('about_column_3')); ?>
                </div>
            </div>
        </div>
        <button class="slider-arrow right" aria-label="Scroll right">&gt;</button>
    </div>
</section>

<!-- Projects Section -->
<?php
$project_categories = get_terms([
    'taxonomy' => 'category',
    'hide_empty' => true,
]);
$projects = get_field('my_project'); // ACF relationship field

$desired_order = ['websites', 'wordpress-plugins', 'react-apps']; 

// Sort the categories based on the desired order
usort($project_categories, function ($a, $b) use ($desired_order) {
    $index_a = array_search($a->slug, $desired_order);
    $index_b = array_search($b->slug, $desired_order);

    // If one of the categories is not found in the desired order, it should come last
    $index_a = ($index_a === false) ? count($desired_order) : $index_a;
    $index_b = ($index_b === false) ? count($desired_order) : $index_b;

    return $index_a - $index_b;
});

?>
<section id="Projects" class="projects-section container-fluid">
    <div class="container">
        <?php 
        if ($project_categories && $projects): ?>        
            <h2 class="section-title">Projects</h2>
            <?php foreach ($project_categories as $category): ?>                
                <div class="project-category">
                    <h3 class="category-title"><?php echo esc_html($category->name); ?></h3>
                    <p class="category-description"><?php echo esc_html($category->description); ?></p>
                    <div class="row">   
                        <?php

                        // Filter projects belonging to the current category
                        $projects_in_category = array_filter($projects, function ($project) use ($category) {
                            $project_categories = wp_get_post_terms($project->ID, 'category', ['fields' => 'ids']);
                            return in_array($category->term_id, $project_categories);
                        });
                                    
                        if ($projects_in_category) {
                            // Sort projects by date (newest first)
                            usort($projects_in_category, function ($a, $b) {
                                return strtotime($b->post_date) - strtotime($a->post_date);
                            });

                            // Limit to top 5 projects
                           $projects_in_category = array_slice($projects_in_category, 0, 5);                            
                  
                            // Loop through the top 5 projects
                            foreach ($projects_in_category as $project):
                                $featured_image = get_the_post_thumbnail_url($project->ID, 'medium_large');
                                $excerpt = get_the_excerpt($project->ID); 
                                $project_description = get_field('project_description', $project->ID); 
                                $project_description = wp_strip_all_tags($project_description, true);                                

                        ?>

                                <div class="<?= (count($projects_in_category) === 3) ? 'col-md-12 col-lg-4' : 'col-sm-12 col-md-6'; ?> project-item mb-4">
                                    <div class="project-card">
                                        <?php if ($featured_image): ?>
                                            <div class="project-image">
                                                <a href="<?php echo get_permalink($project->ID); ?>">
                                                    <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr($project->post_title); ?>">
                                                </a>
                                            </div>
                                        <?php endif; ?>                                        
                                        <h4 class="project-title">
                                            <a href="<?php echo get_permalink($project->ID); ?>"`><?php echo esc_html($project->post_title); ?></a> 
                                        </h4>                                                                            
                                        <?php if($project_description): ?>
                                        <p class="project-excerpt"><?php echo esc_html($project_description); ?></p>
                                        <?php endif; ?>
                                        <a href="<?php echo get_permalink($project->ID); ?>" class="btn btn-sm btn-link">Read More <i class="fas fa-angles-right"></i></a>
                                    </div>
                                </div>
                        <?php                            
                            endforeach;
                        } else {
                            // Display a message if no projects are in this category
                            echo '<p>No projects available in this category.</p>';
                        }
                        ?>
                    </div>      
                </div>          
            <?php  endforeach; ?>
        <?php endif; ?> 
    </div>
</section>

<section id="Contact" class="contact-section container-fluid">
    <div class="container pb-5">
        <div class="row w-100 py-5">
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

get_footer(); 

?>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // About Section
  const aboutRow = document.querySelector('.about-column-section .row');
  const leftArrowAbout = document.querySelector('.slider-arrow.left');
  const rightArrowAbout = document.querySelector('.slider-arrow.right');
  const aboutColumns = document.querySelectorAll('.about-column-section .col-md-4');

  let currentIndexAbout = 0;
  let startX = 0;
  let isSwiping = false;

  const updateScrollPositionAbout = () => {
    const columnWidth = aboutColumns[0].offsetWidth;
    const newScrollPosition = currentIndexAbout * columnWidth;
    aboutRow.scrollTo({ left: newScrollPosition, behavior: 'smooth' });
  };

  const updateIndexAbout = (direction) => {
    if (direction === 'left') {
      currentIndexAbout = (currentIndexAbout === 0) ? aboutColumns.length - 1 : currentIndexAbout - 1;
    } else if (direction === 'right') {
      currentIndexAbout = (currentIndexAbout === aboutColumns.length - 1) ? 0 : currentIndexAbout + 1;
    }
    updateScrollPositionAbout();
  };

  leftArrowAbout.addEventListener('click', () => updateIndexAbout('left'));

  rightArrowAbout.addEventListener('click', () => updateIndexAbout('right'));

  // Swipe (drag) functionality
  const onTouchStart = (e) => {
    isSwiping = true;
    startX = e.touches ? e.touches[0].clientX : e.clientX;
  };

  const onTouchMove = (e) => {
    if (!isSwiping) return;

    const currentX = e.touches ? e.touches[0].clientX : e.clientX;
    const diffX = startX - currentX;

    if (diffX > 50) {
      // Swipe left
      updateIndexAbout('right');
      isSwiping = false; // Stop swiping after action
    } else if (diffX < -50) {
      // Swipe right
      updateIndexAbout('left');
      isSwiping = false; // Stop swiping after action
    }
  };

  const onTouchEnd = () => {
    isSwiping = false;
  };

  aboutRow.addEventListener('mousedown', onTouchStart);
  aboutRow.addEventListener('touchstart', onTouchStart);

  aboutRow.addEventListener('mousemove', onTouchMove);
  aboutRow.addEventListener('touchmove', onTouchMove);

  aboutRow.addEventListener('mouseup', onTouchEnd);
  aboutRow.addEventListener('touchend', onTouchEnd);

  // Ensure proper layout on window resize for About Section
  window.addEventListener('resize', updateScrollPositionAbout);
});
</script>
