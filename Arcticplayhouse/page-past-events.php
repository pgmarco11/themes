<?php 
/* Template Name: Past Events */
get_header(); ?>

<?php

$past= array(
	'post_type' => 'shows',
	'posts_per_page' => -1,
	'orderby' => 'date',
	'order' => 'DESC',
	'tax_query' => array(
		array(
			'taxonomy' => 'show-type',
			'field' => 'slug',
			'terms' => 'event-archives'
			)
		)
	);

	$pastShows= get_posts($past);


?>


<section id="shows-wrapper" class="m5left m5right">


		<header>
			<nav class="breadcrumb">
				<?php if( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
			</nav>
		</header>

	<div id="shows-row1" class="widthfull alignleft">

			<h1><?php the_title(); ?></h1>


					<?php
			
					 $main_menu = array(
					'theme_location' => 'shows',
					'container' => 'nav',
					'container_class' => 'alignleft width100',
					'menu_id' => 'shows-col1',
					'depth' => 0
					); 

					wp_nav_menu( $main_menu ); ?>

		

		<div id="shows-col2" class="pastshows">

				<article>

					<h2 class="m2left m1bottom">Event Archives</h2>

					<?php foreach ($pastShows as $post) : setup_postdata($post); ?>
					<?php	
							$custom = get_post_custom($post->ID);
							$writer = $custom["writer"][0];
							$director = $custom["director"][0];
							$address = $custom["address"][0];
							$city = $custom["city"][0];
							$state = $custom["state"][0];
							$dates= $custom["month"][0] . " " . $custom["dates"][0] . ", " . $custom["year"][0];
							if($custom["month2"][0] == null || $custom["dates2"][0] == null || $custom["year2"][0] == null ) {
								$dates2 = null;							
							} else {							
								$dates2= $custom["month2"][0] . " " . $custom["dates2"][0] . ", " . $custom["year2"][0];
							}							
							$info = $custom["info"][0];
					?>
					
					<div class="show-info alignleft width100">
					<?php print get_the_post_thumbnail($post->ID, 'featured-shows', array('class' => 'alignleft mw469')); ?>

							<div class="show-info2 alignright m2right">	

										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<?php if($writer != null){ ?>
										<p class="p0bottom">Written by: <?php echo $writer; ?> </p>

										<?php } ?>
										<?php if($director != null){ ?>
										<p class="p0bottom">Directed by: <?php echo $director; ?></p>
										<?php } ?>

									<p class="address">
										<?php if($address != null){ echo $address . "<br />"; } ?>
										<?php if($city != null){ echo $city; } if($city != null){ echo "," . $state . "<br />"; } ?>									
										<?php echo $dates; ?>
										<?php if($dates2 != null ){ echo '<br />' . $dates2; } ?><br />
										<?php if($info != null){echo '<br/>' . $info . "<br />"; } ?>
									</p>

										<?php the_excerpt(); ?>
									
							</div>

						</div>

						<?php endforeach; wp_reset_query(); ?>

					
				</article>

				</div>		

		</div>


</section>
<?php get_footer(); ?>