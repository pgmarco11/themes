<?php
/**
 *Template Name: Full Width
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

						<?php get_template_part( 'template-parts/content', 'page' ); ?>

						<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>

					<?php endwhile; // End of the loop. ?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!--#content-inside -->
		<div id="contact-info">
					
				<p><?php echo get_post_meta($post->ID, 'contact', true); ?></p>
				<div class="p60bottom">
					<a href="<?php echo site_url(); ?>/#contact" title="Contact Sentinel Safe Floors Today">CONTACT US TODAY</a>
				</div>

		</div>
	</div><!-- #content -->

<?php get_footer(); ?>
