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

<!-- Hero Section (Video Background) -->
<section id="hero" class="hero-section d-flex align-items-center justify-content-center text-center" >
    <?php if ($video_url): ?>
        <video class="hero-background-video" autoplay loop muted>
            <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    <?php endif; ?>

    <div class="hero-content">
        <h1 class="hero-tagline"><?php echo esc_html($tagline); ?></h1>
        <a href="<?php echo esc_url($button_link); ?>" class="btn btn-md btn-link hero-cta"><?php echo esc_html($button_text); ?></a>
    </div>
</section>

<!-- About Section -->
 <?php
 $column_1_icon = get_field('column_1_icon');
 $column_2_icon = get_field('column_2_icon');
 $column_3_icon = get_field('column_3_icon');
 
 ?>
<section class="about-column-section container-fluid">
    <div class="container">
        <button class="slider-arrow left" aria-label="Scroll left">&lt;</button>
        <div class="row">
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

if ($project_categories && $projects): ?>
    <section id="projects" class="projects-section container-fluid">
        <div class="container">
        
            <h2 class="section-title">Projects</h2>
            <?php foreach ($project_categories as $category): ?>                
                <div class="project-category">
                    <h3 class="category-title"><?php echo esc_html($category->name); ?></h3>
                    <p class="category-description"><?php echo esc_html($category->description); ?></p>
                    <button class="slider-arrow left" aria-label="Scroll left">&lt;</button>
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

                            // Limit to top 3 projects
                            $projects_in_category = array_slice($projects_in_category, 0, 3);

                            // Loop through the top 3 projects
                            foreach ($projects_in_category as $project):
                                $featured_image = get_the_post_thumbnail_url($project->ID, 'medium_large');
                                $excerpt = get_the_excerpt($project->ID);
                        ?>
                                <div class="col-md-4 project-item">
                                    <div class="project-card">
                                        <?php if ($featured_image): ?>
                                            <div class="project-image">
                                                <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr($project->post_title); ?>">
                                            </div>
                                        <?php endif; ?>
                                        <h4 class="project-title"><?php echo esc_html($project->post_title); ?></h4>
                                        <?php if($excerpt): ?>
                                        <p class="project-excerpt"><?php echo esc_html($excerpt); ?></p>
                                        <?php endif; ?>
                                        <a href="<?php echo get_permalink($project->ID); ?>" class="btn btn-sm btn-link">Read More</a>
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
                    <button class="slider-arrow right" aria-label="Scroll right">&gt;</button>
                </div>          
            <?php endforeach; ?>            
        </div>
    </section>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const sliderRow = document.querySelector('.about-column-section .row');
  const leftArrow = document.querySelector('.slider-arrow.left');
  const rightArrow = document.querySelector('.slider-arrow.right');
  const columns = document.querySelectorAll('.about-column-section .col-md-4');
  
  let currentIndex = 0; // Track the currently visible column

  const updateScrollPosition = () => {
    // Calculate the scroll position to center the current column
    const columnWidth = columns[0].offsetWidth; // Assume all columns are the same width
    const newScrollPosition = currentIndex * columnWidth - (sliderRow.offsetWidth - columnWidth) / 2;
    sliderRow.scrollTo({ left: newScrollPosition, behavior: 'smooth' });
  };

  leftArrow.addEventListener('click', () => {
    if (currentIndex === 0) {
      currentIndex = columns.length - 1; // Loop to the last column
    } else {
      currentIndex--;
    }
    updateScrollPosition();
  });

  rightArrow.addEventListener('click', () => {
    if (currentIndex === columns.length - 1) {
      currentIndex = 0; // Loop to the first column
    } else {
      currentIndex++;
    }
    updateScrollPosition();
  });

  // Ensure proper layout on window resize
  window.addEventListener('resize', updateScrollPosition);
});

document.addEventListener('DOMContentLoaded', () => {
  const projectRows = document.querySelectorAll('.project-category .row');
  const leftArrow = document.querySelector('.slider-arrow.left');
  const rightArrow = document.querySelector('.slider-arrow.right');
  const projectCards = document.querySelectorAll('.project-category .col-md-4');

  const updateScrollPosition = () => {
    // Calculate the scroll position to center the current column
    const columnWidth = columns[0].offsetWidth; // Assume all columns are the same width
    const newScrollPosition = currentIndex * columnWidth - (sliderRow.offsetWidth - columnWidth) / 2;
    sliderRow.scrollTo({ left: newScrollPosition, behavior: 'smooth' });
  };

  leftArrow.addEventListener('click', () => {
    if (currentIndex === 0) {
      currentIndex = columns.length - 1; // Loop to the last column
    } else {
      currentIndex--;
    }
    updateScrollPosition();
  });

  rightArrow.addEventListener('click', () => {
    if (currentIndex === columns.length - 1) {
      currentIndex = 0; // Loop to the first column
    } else {
      currentIndex++;
    }
    updateScrollPosition();
  });

  // Ensure proper layout on window resize
  window.addEventListener('resize', updateScrollPosition);
  });
});
</script> 

<?php

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        // Display the post content
        the_content();
    endwhile;
else :
    echo '<p>No content found</p>';
endif;

get_footer(); 