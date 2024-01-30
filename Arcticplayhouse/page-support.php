<?php 
/* Template Name: Support with Sidebar */ get_header(); ?>

<section id="single-wrapper" class="m5left m5right">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<header>
			<nav class="breadcrumb">
				<?php if( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
			</nav>
		</header>

	<div id="single-row1" class="widthfull alignleft">

		<div id="heading">
			<h1><?php the_title(); ?></h1>

		</div>

		<div id="single-col1" >
			<article>

					<div class="content alignleft width72">     

						<?php the_post_thumbnail('smallpage-featured-image', array('class' => 'alignleft')); ?>	

						<?php the_content('Read More...'); ?>	
					
					</div>
	
						<?php endwhile; else: ?>
							<p><?php _e( 'The page you are looking for could not be found.'); ?></p>
						<?php endif; ?>

			</article>

		</div>

		<div id="two-col2" class="alignright m2right support-page">
			<?php get_sidebar('supportus-widgets'); ?>
		</div>


	</div>


</section>
<?php get_footer(); ?>

