<?php
/**
 *Template Name: Floor Safety Commercial
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

		<div id="content-inside" class="container no-sidebar">
			<?php while ( have_posts() ) : the_post(); ?>

			<div id="primary" class="content-area">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>				
				<main id="main" class="site-main" role="main">

						<div class="alignleft pageWidth">
							<?php get_template_part( 'template-parts/content', 'page' ); ?>
						</div>

						<div class="thumb_align">
							<?php the_post_thumbnail('medium'); 
							if( class_exists('Dynamic_Featured_Image') ) {
						       global $dynamic_featured_image;
						       global $post;					

						    	$featured_images = $dynamic_featured_image->get_featured_images( $post->ID );


							    if ( $featured_images != NULL ){
							        foreach( $featured_images as $images ):
							        	$mediumSizedImage = $dynamic_featured_image->get_image_url($images['attachment_id'], 'medium');       
							            echo '<img src="'.$mediumSizedImage.'" class="attachment-medium size-onepress-small wp-post-image" alt="commercial floors">';
							      	endforeach;

							      
							    }
							}
							?>
						</div>

					<?php endwhile; // End of the loop. ?>

				</main><!-- #main -->
			</div><!-- #primary -->

		</div><!--#content-inside -->
		<div id="brochure-info">
					
				<p><?php echo get_post_meta($post->ID, 'brochure', true); ?></p>
				<div class="p60bottom">
					<a href="<?php print DOWNLOADS; ?>/Sentinal_Floor_Brochure.pdf" title="NANO-GRIP BROCHURE">DOWNLOAD OUR BROCHURE</a>
				</div>

		</div>
		<div id="secondary" class="container no-sidebar">
			<div class="content-area">
				
					<div id="safety-secondary">

						<?php get_sidebar('safety-commercial'); ?>

					</div>

			</div>		
		</div>
		<div id="contact-info">
					
				<p><?php echo get_post_meta($post->ID, 'contact', true); ?></p>

		</div>

	</div><!-- #content -->

<?php get_footer(); ?>
