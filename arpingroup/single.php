<?php
/* 
*  Single Post
*
*/

get_header();

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

			$page_blog = get_post(293);

			$title = $page_blog->post_title;
			$excerpt = $page_blog->post_excerpt;
			$featured_image = get_the_post_thumbnail_url(293, 'full');

		?>

			<!-- Do not remove this class -->
				<div class="push-top"></div>

				<section class="section-intro bg-img stellar" data-stellar-background-ratio="0.4" style="background-image: url('<?php echo $featured_image; ?>');">
					<div class="bg-overlay op6"></div>
					<div class="container">
						<div class="row">
							<div class="col-md-5 col-sm-8">
								<h1 class="intro-title mb20">
								<?php echo $title; ?></h1>
								<p class="intro-p mb20">
								<?php echo nl2br($excerpt); ?>
								</p>
							</div>
						</div>
					</div>
				</section>

			<div class="page-breadcrumbs-wrapper pb-without-bg">
					<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<div class="pull-center">
									<div class="page-breadcrumbs">
			 
										<?php if(function_exists('bcn_display')) { bcn_display(); } ?>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


			<section class="section-page mb10">
				<div class="container">
					<div class="row">
						<div class="col-sm-4 col-md-3">

						<?php get_sidebar('blog-posts'); ?>

						</div>


						<div class="col-sm-8 col-md-9 space-left">
							<div class="row">
								<div class="col-sm-12">

									<article id="post-<?php the_ID(); ?>" <?php post_class('post-article'); ?>>

									    <h2><?php the_title(); ?></h2>

										<b><?php the_time('F d, Y') ?></b><br />
										
									
										<?php the_content(); ?>									
										<?php edit_post_link( 'Edit', '<p>', '</p>' ); ?> 	
									</article>


									<?php endwhile; else: ?>
									<p><?php _e( 'The post you are looking for could not be found.'); ?></p>
									<?php endif; ?>												  

								</div>
							</div>
						</div>


					</div>
				</div>
			</section> 
        


		<?php 
		wp_reset_query();

		?>

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>