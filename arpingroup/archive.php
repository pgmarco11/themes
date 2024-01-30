<?php
/* 
*  Template Name: Archives
*
*/

get_header();

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php 

			$page_blog = get_post(293);
			$excerpt = $page_blog->post_excerpt;
			$featured_image = get_the_post_thumbnail_url(293, 'full');

			$paged = ( get_query_var('paged') ) ? get_query_var( 'paged' ) : 1;
			$args = array(
				'posts_per_page' => '50',
				'paged' => $paged,
				);

			$query_archive = new WP_Query($args);

	?> 

			<!-- Do not remove this class -->
				<div class="push-top"></div>

				<section class="section-intro bg-img stellar" data-stellar-background-ratio="0.4" style="background-image: url('<?php echo $featured_image; ?>');">
					<div class="bg-overlay op6"></div>
					<div class="container">
						<div class="row">
							<div class="col-md-5 col-sm-8">
								<h1 class="intro-title mb20"><?php the_archive_title(); ?></h1>
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

			

			<section class="section-page">

			<div class="container">
				<div class="row">
					<div class="col-sm-4 col-md-3">

						<?php get_sidebar('blog-posts'); ?>

							
					</div>
					<div class="col-sm-8 col-md-9 col-md-push-3 col-sm-push-4 space-left push-off">
						<div class="row blog-list">

						<?php if ( $query_archive->have_posts() ) :	while ( $query_archive->have_posts() ) : $query_archive->the_post(); ?> 

							<div class="col-sm-12">
								<div class="row blog-item">
									<div class="col-sm-12 col-md-12 blog-caption">
										<h3 id="post-<?php the_ID(); ?>" class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
										<div class="sub-post-title">
											<span><?php the_time('F d, Y') ?></span>
										</div>
										<?php the_excerpt();?>
										<div class="clearfix">
											<div class="pull-left"><a href="<?php the_permalink(); ?>" class="read-more">read more</a></div>
											<div class="pull-right"><i class="fa fa-copy post-format"></i></div>
										</div>
									</div>
								</div>
		                    </div> <!-- END Blog Item -->                 	

					    <?php endwhile; ?>
						</div> <!-- end posts -->

						<div class="row">
							<div class="col-sm-12">
									<div class="mb20"></div>

									 <?php 
									 $GLOBALS['wp_query']->max_num_pages = $query_archive->max_num_pages;
									 $nav = get_the_posts_pagination( array( 

									 	'end_size' => 0,
									 	'mid_size' => 2,
									 	'screen_reader_text' => __(' '),
									 	'next_text' => __('&gt;'),
									 	'type' => 'list'

									 ) ); 
									 echo $nav;
									 ?>	     									
																  
							</div>
						</div>

				
					</div>
					<?php else : ?>
							<p><?php _e( 'Sorry, no posts found.' ); ?></p>
					<?php endif; 
						wp_reset_postdata();
					?>

		

				</div>
			</div>

			</section> <!-- END Blog Page-->	
			<?php 
			 

			?>			



	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>