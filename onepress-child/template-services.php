<?php
/**
 *Template Name: Services
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
				<div id="services-page">
					<h2><?php echo get_post_meta($post->ID, 'services-title', true); ?></h2>

					<?php get_sidebar('services-widgets'); ?>

				</div>

				<main id="main" class="site-main" role="main">

						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

						<div class="thumb_align">
							<?php the_post_thumbnail('medium'); ?>
						</div>

						<div class="alignleft pageWidth">
							<?php get_template_part( 'template-parts/content', 'page' ); ?>
						</div>


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
