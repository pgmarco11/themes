<?php get_header(); ?>

<section class="container">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div id="two-row1" class="w-100">
		<header>
		<nav class="breadcrumb">
			<?php if( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
		</nav>

			<h1><?php the_title(); ?></h1>	
			<div class="byline">by <?php the_author_posts_link(); ?> on <span class="date"><?php the_time('F d, Y'); ?>
			with <a href="<?php the_permalink(); ?>#comments" title="<?php the_title_attribute(); ?> Comments"><?php comments_number('0 comments', 
			'Only 1 comment', '% comments') ?></a></div>
		</header>

	</div>

	<div id="two-row2" class="w-100">

		<div id="two-col1" class="d-flex justify-content-start width675 p0left">
						
						<article id="post-<?php the_ID(); ?>" <?php post_class('post-article'); ?>>
															
							<div class="content">
								<div class="d-flex justify-content-end post-image"><?php the_post_thumbnail( 'page-featured-image' ); ?></div>
		                        <?php the_content(); ?>							
								<?php edit_post_link( 'Edit', '<p>', '</p>' ); ?>		
							</div>

							<nav class="navi clearfix">
								<ul>
									<li class="d-flex justify-content-start"><?php previous_post_link(); ?></li>
									<li class="d-flex justify-content-end"><?php next_post_link(); ?></li>
								</ul>
							</nav>
	
						</article>
						
						<div class="author clearfix">
							<h3>Written by: <?php the_author_posts_link(); ?></h3>
							<?php echo get_avatar( get_the_author_meta('user_email', 2), '80', 'Avatar of '.get_the_author_meta( 'first_name' ).' '.get_the_author_meta( 'last_name' ) ); ?>															
							<?php if( get_the_author_meta( 'description' ) ) { ?>
						    <p><?php the_author_meta( 'description' ) ?></p>
						    <?php } ?>
						    <?php if( get_the_author_meta( 'user_url' ) ) { ?>
							<a href="<?php the_author_meta( 'user_url' ); ?>" title="<?php the_author_meta( 'first_name'); ?>'s Website" target="_blank">
							<?php the_author_meta( 'user_url' ); ?></a>
						    <?php } ?>
						</div>
	

						<div class="comments">
							<?php comments_template(); ?>
						</div>	

						<?php endwhile; else: ?>
							<p><?php _e( 'The post you are looking for could not be found.'); ?></p>
						<?php endif; ?>
		</div>



		<div id="two-col2" class="d-flex justify-content-end width325">
			<?php get_sidebar('blog-widgets'); ?>
		</div>

	</div>

</section>
<?php get_footer(); ?>