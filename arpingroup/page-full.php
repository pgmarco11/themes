<?php
/* 
*  Template Name: Full Page No Sidebar
*
*/

get_header();

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php while( have_posts() ) : the_post();

			$page_data = get_post($post->ID);

			$title = $page_data->post_title;
			$excerpt = $page_data->post_excerpt;
			$featured_image = get_the_post_thumbnail_url($post->ID, 'full');

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
					
					<div class="col-sm-12 col-md-12 ">
						<div class="row">
							<div class="col-sm-12">

							 <h2 class="title-border"><?php the_title(); ?></h2>
							 
							<?php the_content(); ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</section> 


		<?php 
		endwhile;
		wp_reset_query();

		?>

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>