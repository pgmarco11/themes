<?php get_header(); ?>

<section id="single-wrapper" class="container">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<header class="row mx-2">
			<nav class="breadcrumb">
				<?php if( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
			</nav>
		</header>
	<div class="widthfull row mx-2">

		<div id="heading" class="col-lg-12 px-0">
			<h1><?php the_title(); ?></h1>
		</div>

		<div class="col-lg-12 pl-0 pr-0">
			<article>				
					<div class="content">
						<?php the_post_thumbnail('page-featured-image-wide', array('class' => 'd-flex justify-content-center mb-4')); ?>	
						<?php the_content('Read More...'); ?>							
					</div>

			</article>						
			<?php endwhile; else: ?>
				<p><?php _e( 'The page you are looking for could not be found.'); ?></p>
			<?php endif; ?>
		</div>

	</div>
</section>
<?php get_footer(); ?>

