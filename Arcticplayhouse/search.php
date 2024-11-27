<?php get_header(); ?>

<section id="single-wrapper" class="container">

    <header class="row mx-2">
        <nav class="breadcrumb">
            <?php if( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
        </nav>
    </header>

    <div class="search-wrap widthfull mx-2">
		<div id="heading" class="col-lg-12 px-0">
				<h1 class="mx-auto">
					<?php 
					$search_query = get_search_query();
					
					if (!empty($search_query)) {
						$title = 'Search results for: "' . $search_query . '"';
					} else {
						$title = 'Search results';
					}
					
					echo $title;
					?>
				</h1>
		</div>

        <div class="w-100 search-results">

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" class="row">

                    <div class="col-md-6">
                        <?php the_post_thumbnail('shows-image', array('class' => 'd-flex justify-content-center mx-auto mb-4')); ?>
                    </div>

                    <div class="col-md-6">
                        <div class="info">
                            <h2><a href="<?php the_permalink(); ?>" title="For more info on <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

							<?php
							$post_id = get_the_ID();

							if (get_post_meta($post_id, 'month2', true) == null || get_post_meta($post_id, 'dates2', true) == null || get_post_meta($post_id, 'year2', true) == null ) {
								$dates = get_post_meta($post_id, 'month', true) . " " . get_post_meta($post_id, 'dates', true) . ", " . get_post_meta($post_id, 'year', true);
								$dates2 = null;                            
							} else {   
								$dates = get_post_meta($post_id, 'month', true) . " " . get_post_meta($post_id, 'dates', true) . ", " . get_post_meta($post_id, 'year', true);                         
								$dates2 = get_post_meta($post_id, 'month2', true) . " " . get_post_meta($post_id, 'dates2', true) . ", " . get_post_meta($post_id, 'year2', true);
							}

							?>

							<ul class="byline p-0">
								<?php if(the_category() !== null){ ?>
								<li><span>Posted in</span><br><?php the_category(', '); ?></li>
								<?php } ?>
								<?php if($dates !== null){ ?>
									<li><?php echo $dates; ?></li>
								<?php } ?>
								<?php if($dates2 !== null){ ?>
									<li><?php echo $dates2; ?></li>
								<?php } ?>
							</ul>

                            <?php the_excerpt(); ?>
				
                        </div>
                    </div>

                </article>

                <div class="row mx-auto">
                    <div class="d-flex w-100 align-items-center justify-content-center mt-4 mb-5">    
                        <img src="<?php echo get_template_directory_uri() ?>/images/right-new.svg" title="Arctic playhouse upcoming shows" class="right-img" />
                    </div>              
                </div>

            <?php endwhile; ?>
            <?php else: ?>

            <p><?php _e( 'What you are looking for could not be found.' ); ?></p> 
            <?php endif; ?>

        </div>
    </div>

</section>

<?php get_footer(); ?>
