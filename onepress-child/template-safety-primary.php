<?php
/**
 *Template Name: Floor Safety Primary
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
							<?php the_post_thumbnail('medium'); ?>
						</div>	

					<?php endwhile; // End of the loop. ?>

				</main><!-- #main -->
				<div id="safety-page-1">

					<?php get_sidebar('safety-primary-1'); ?>

				</div>
			</div><!-- #primary -->

		</div><!--#content-inside -->
		<div id="brochure-info">
					
				<p><?php echo get_post_meta($post->ID, 'brochure', true); ?></p>
				<div class="p60bottom">
					<a href="<?php print DOWNLOADS; ?>/Nano-Grip_Tri-Fold.pdf" title="NANO-GRIP BROCHURE">DOWNLOAD NANO-GRIP BROCHURE</a>
				</div>

		</div>
		<div id="secondary" class="container no-sidebar">
			<div class="content-area">
				<div id="safety-page-2">

					<?php get_sidebar('safety-primary-2'); ?>

				</div>

			</div>		
		</div>
		<div id="contact-info">
					
				<p><?php echo get_post_meta($post->ID, 'contact', true); ?></p>

				<a href="https://nfsi.org/" title="NFSI Sponsor" class="sponsor"><img src="<?php print IMAGES; ?>/NFSI.jpg" alt="slip prevention" /></a>

				<div class="p60bottom">
					<a href="<?php echo site_url(); ?>/#contact" title="Contact Sentinel Safe Floors Today">CONTACT US TODAY</a>
				</div>

		</div>

	</div><!-- #content -->

<?php get_footer(); ?>
