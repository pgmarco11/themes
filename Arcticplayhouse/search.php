<?php
get_header(); ?>

<section id="single-wrapper" class="m5left m5right">

		<header>		
			<nav class="breadcrumb">
				<?php bcn_display(); ?>
			</nav>
		</header>
		
	<div id="single-row1" class="widthfull alignleft">

		<div id="heading">
			<h1><?php _e( 'You are searching for "' . get_search_query() . '"'); ?></h1>
		</div>
	
	<div id="single-col1">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


			<article id="post-<?php the_ID(); ?>" class="alignleft show-archive width100">
				
				<?php the_post_thumbnail('post-thumb'); ?>

				<div class="info alignright">
					<h2><a href="<?php the_permalink(); ?>" title="For more info on <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					
					<?php the_excerpt(); ?>

					<ul class="byline">
						<!--<a href="<?php the_permalink(); ?>#comments" title="<?php the_title_attribute(); ?> Comments">
						<?php comments_number('0 Comments', 'Only 1 Comment', '% Comments'); ?></a>-->
						<?php if(the_category() != null){ ?>
						<li><span class="opacity25">Posted in</span></br> <?php the_category(', '); ?></li>
						<?php } ?>
					</ul>

				</div>	


			</article>

				<?php endwhile; else: ?>
					<p><?php _e( 'What you are looking for could not be found.' ); ?></p>
				<?php endif; ?>

			</div>


			<div id="two-col2" class="alignright width325">
				
				<?php get_sidebar('page-widgets'); ?>

			</div>

	</div>

</section>

<?php get_footer(); ?>