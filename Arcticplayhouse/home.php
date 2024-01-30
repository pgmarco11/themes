<?php get_header(); ?>

<section class="m5left m5right">

	<h2 style="display:none;">Tech Blog</h2>

	<div id="two-row2" class="width100">


		<div id="two-col1" class="alignleft width675">
	
				<div id="two-col-search">

					<nav class="breadcrumb">
						<?php if( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
					</nav>

					<h2><?php echo get_the_category_by_id( get_option( 'default_category' )); ?></h2>

					<?php wp_dropdown_categories('show_option_none=Select category'); ?>

						<script type="text/javascript"><!--
						    var dropdown = document.getElementById("cat");
						    function onCatChange() {
								if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
									location.href = "<?php echo get_option('home');?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
								}
						    }
						    dropdown.onchange = onCatChange;
						--></script>

				<form name="search" method="get" action="http://www.shimmertechno.com" class="alignright m5right">
					<input type="text" value="Search" name="s" id="sblog" class="opacity25" />
					<input type="submit" id="submitblog" value="" name="submit" class="alignleft" />
				</form>

				</div>
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<?php the_post_thumbnail('post-thumb'); ?>

				<div class="alignright blog-articles">
					<h2><a href="<?php the_permalink(); ?>" title="For more info on <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					
					<?php the_excerpt(); ?>

					<ul class="byline">
						<li><span class="opacity25">Name</span><br /> <?php the_author_posts_link(); ?></li>
						<li><span class="opacity25">Date</span><br /> <?php the_time( 'F d, Y' ) ?></li>
						<!--<a href="<?php the_permalink(); ?>#comments" title="<?php the_title_attribute(); ?> Comments">
						<?php comments_number('0 Comments', 'Only 1 Comment', '% Comments'); ?></a>-->
						<li><span class="opacity25">Posted in</span><br /> <?php the_category(', '); ?></li>
					</ul>

				</div>	


				</article>


				<?php endwhile; else: ?>
								
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>

				<?php endif; ?>


		</div>

		<div id="two-col2" class="alignright width325">

			<?php get_sidebar('blog-widgets'); ?>
		
		</div>

	</div>



</section>
<?php get_footer(); ?>