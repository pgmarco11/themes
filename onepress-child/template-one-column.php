<?php
/**
 *Template Name: One Column With Image
 *
 * @package OnePress
 */

get_header(); ?>

	<div id="content" class="site-content">

		<div class="page-header">
				<nav>
					<?php echo onepress_breadcrumb(); ?>
				</nav>
		</div>
		

		<div id="content-inside" class="container">
			<?php while ( have_posts() ) : the_post(); ?>

			<div id="primary" class="content-area">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>	

				
				<main id="main" class="site-main" role="main">					

						<?php get_template_part( 'template-parts/content', 'page' ); ?>



				</main><!-- #main -->
				<div class="featured-images">

				<?php the_post_thumbnail( 'medium' );
				   
				   if( class_exists('Dynamic_Featured_Image') ) {
				       global $dynamic_featured_image;
				       global $post;					

				    	$featured_images = $dynamic_featured_image->get_featured_images( $post->ID );

				    	

					    if ( $featured_images ){
					        foreach( $featured_images as $images ):
							            $mediumSizedImage = $dynamic_featured_image->get_image_url($images['attachment_id'], 'medium');       
							            echo '<img src="'.$mediumSizedImage.'" class="attachment-medium size-onepress-small wp-post-image" alt="floor safety">';
					      	endforeach;

					      
					    }
					}?>
				</div>
				
				<?php endwhile; // End of the loop. ?>
			</div><!-- #primary -->		

		</div><!--#content-inside -->
		<div id="contact-info">
					
				<p><?php echo get_post_meta($post->ID, 'contact', true); ?></p>

		</div>
	</div><!-- #content -->

<?php get_footer(); ?>
