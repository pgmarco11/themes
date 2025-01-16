<?php 
/* Template Name: Archives */
get_header(); ?>

<section id="single-wrapper" class="container">

		<header>
			<nav class="breadcrumb">
				<?php if( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
			</nav>
		</header>


	<div class="row widthfull d-flex justify-content-start">

			
			<h1><?php
			if ( is_day() )
				_e( 'You are viewing the ' . get_the_date() . ' daily archives' );
			elseif ( is_month() )
				_e( 'You are viewing' . get_The_date( 'F Y' ) . ' monthly archives' );
			elseif ( is_year() )
				_e( 'You are viewing the ' . get_the_Date( 'Y' ) . ' yearly archives');
			elseif ( is_author() )
				_e( 'You are viewing author archives' );
			else
				_e( 'You are viewing the "' . single_cat_title('', false ) . '"');
			?>
			</h1>

		<?php
		
				 $main_menu = array(
				'theme_location' => 'shows',
				'container' => 'nav',
				'container_class' => 'd-flex justify-content-start w-100',
				'menu_id' => 'shows-col1',
				'depth' => 0
				); 

		wp_nav_menu( $main_menu ); ?>
	
	<div class="col-12">	

		<?php query_posts($query_string."&orderby=date&order=DESC"); ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	

		<?php
			$custom = get_post_custom($post->ID);
			$writer= $custom["writer"][0];
			$director= $custom["director"][0];

		?>
	
				<article id="post-<?php the_ID(); ?>" class="d-flex justify-content-start show-archive w-100">
					
						<?php the_post_thumbnail('featured-shows', array('class' => 'd-flex justify-content-start'));	?>
					
						<div class="info d-flex justify-content-end">
					
							<h1><a href="<?php the_permalink(); ?>" title="For more info on <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
							<?php if($writer != null){ ?>
							<p>Written by: <?php echo $writer; ?> </p>

							<?php } ?>
							<?php if($director != null){ ?>
							<p>Directed by: <?php echo $director; ?></p>
							<?php } ?>
							<br />

							<?php the_excerpt(); ?>	

						</div>
							
				</article>

				<div class="clearfix"></div>

				<?php endwhile; else: ?>
					<p><?php _e( 'The archives you are looking for could not be found.' ); ?></p>
				<?php endif; ?>

			</div>


		<div class="d-flex justify-content-end">
			<?php get_sidebar('page-widgets'); ?>
		</div>

	</div>

</section>

<?php get_footer(); ?>