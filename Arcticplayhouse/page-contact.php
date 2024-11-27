<?php
/* Template Name: Contact Page Template */
get_header(); ?>

<section id="single-wrapper" class="container">
	
	<header class="row mx-2">
		<nav class="breadcrumb">
			<?php if( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
		</nav>
	</header>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div class="widthfull mx-2">

		<div id="heading" class="w-100 px-0">
			<h1><?php the_title(); ?></h1>
		</div>

		<div class="row">
            <!-- Post Thumbnail -->
            <div class="col-lg-4 order-lg-2 order-md-1 order-1">
                <div class="post-thumb">
                    <?php the_post_thumbnail('page-featured-image', array('class' => 'img-thumbnail')); ?>
                </div>
                <aside>
                    <?php get_sidebar('contact'); ?>
                </aside>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-8 order-lg-1 order-md-2 order-2">
                <article>				
                    <div class="content">	
                        <?php the_content('Read More...'); ?>							
                    </div>
                </article>						
            </div>
		</div>

	</div>

	<?php endwhile; else: ?>
		<p><?php _e( 'The page you are looking for could not be found.'); ?></p>
	<?php endif; ?>

</section>
<?php get_footer(); ?>
