<?php

get_header();

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php 

			$featured_image = get_the_post_thumbnail_url(364, 'full');


		?>

			<!-- Do not remove this class -->
				<div class="push-top"></div>

				<section class="section-intro bg-img stellar" data-stellar-background-ratio="0.4" style="background-image: url('<?php echo $featured_image; ?>');">
					<div class="bg-overlay op6"></div>
					<div class="container">
						<div class="row">
							<div class="col-md-5 col-sm-8">
								<h1 class="intro-title mb20">
								404 Page Not Found</h1>
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
					 
							<h4 style="color:#303539">We're Sorry. The page you are looking for cannot be found or has moved, please update your bookmarks.</h4>

							</div>
						</div>
					</div>
				</div>
			</div>
		</section> 


	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>