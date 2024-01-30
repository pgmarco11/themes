<?php 
/* Template Name: Upcoming Shows */
get_header(); ?>

<?php

$args= array(
	'post_type' => 'shows',
	'posts_per_page' => 1,
	'tax_query' => array(
		array(
			'taxonomy' => 'show-type',
			'field' => 'slug',
			'terms' => 'now-playing'
			)
		)
	);

	$featuredShow= get_posts($args);

	$upcomingS = array(
	'post_type' => 'shows',
	'posts_per_page' => 8,
	'orderby' => 'date',
	'order' => 'ASC',
	'tax_query' => array(
		array(
			'taxonomy' => 'show-type',
			'field' => 'slug',
			'terms' => array('upcoming-shows')
			)
		)
	);

	$upcomingShows= get_posts($upcomingS);

	$upcomingE= array(
	'post_type' => 'shows',
	'posts_per_page' => 8,
	'orderby' => 'date',
	'order' => 'ASC',
	'tax_query' => array(
		array(
			'taxonomy' => 'show-type',
			'field' => 'slug',
			'terms' => array('events')
			)
		)
	);

	$upcomingEvents= get_posts($upcomingE);


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

		

		<div id="shows-col2">

				<article>
					<h2 class="m2left m1bottom">Now Playing</h2>			
					<?php foreach ($featuredShow as $post) : setup_postdata($post); ?>
					<?php	
							$custom = get_post_custom($post->ID);
							$writer = $custom["writer"][0];
							$director = $custom["director"][0];
							$address = $custom["address"][0];
							$city = $custom["city"][0];
							$state = $custom["state"][0];
							$ticket = $custom["ticket"][0];
							$price = $custom["price"][0];
							$dates= $custom["month"][0] . " " . $custom["dates"][0] . ", " . $custom["year"][0];
							if($custom["month2"][0] == null || $custom["dates2"][0] == null || $custom["year2"][0] == null ) {
								$dates2 = null;							
							} else {							
								$dates2= $custom["month2"][0] . " " . $custom["dates2"][0] . ", " . $custom["year2"][0];
							}							
							$time= $custom["time"][0] . " " . $custom["ampm"][0];
							$info = $custom["info"][0];
					?>
					
					<?php print get_the_post_thumbnail($post->ID, 'featured-shows', array('class' => 'alignleft mw469')); ?>

						<div class="now-playing alignright m2right">	

							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

								<?php if($writer != null){ ?>
								<p>Written by: <?php echo $writer; ?> </p>

								<?php } ?>
								<?php if($director != null){ ?>
								<p>Directed by: <?php echo $director; ?></p>
								<?php } ?>


									<p class="address">
										<?php if($address != null){ echo $address . "<br />"; } ?>
										<?php if($city != null){ echo $city; } if($city != null){ echo "," . $state . "<br />"; } ?>									
										<?php echo $dates; ?>
										<?php if($dates2 != null ){ echo '<br />' . $dates2; } ?><br />
										<?php echo $time; ?><br />										
									</p><br />	
								
								<p>Price: <?php echo $price ?></p>

								<a class="alignleft tickets " href="<?php echo $ticket; ?>" target="_blank" title="buy tickets">Buy Tickets</a>

								<div class="clearfix"></div>


								<?php if($info != null){echo "<p>" . $info . "</p><br />"; } ?>
								<?php the_excerpt(); ?>

												

						</div>

						<?php endforeach; ?>

						<div class="alignleft" id="shows-coming">
							
							<h2 class="m1left m1bottom">Upcoming Shows</h2>

							<?php foreach ($upcomingShows as $post) : setup_postdata($post); ?>

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
							$time= $custom["time"][0] . " " . $custom["ampm"][0];
							$info = $custom["info"][0];
							$ticket = $custom["ticket"][0];
							$price = $custom["price"][0];
							?>

							<div class="show-info alignleft width100">

							<?php print get_the_post_thumbnail($post->ID, 'featured-shows', array('class' => 'alignleft mw469')); ?>
							
								<div class="show-info2 alignright m2right">
			
								<h3 class="widgettitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

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
										<?php echo $time; ?><br />										
									</p><br />	

									<div class="clearfix"></div>

									<?php if ( $ticket != "") { ?>
									<p>Price: <?php echo $price ?></p>
									<?php echo '<a class="alignleft tickets" href="'. $ticket .'" target="_blank" title="buy tickets">Buy Tickets</a>'; ?>	
									<div class="clearfix"></div>
									<?php } ?>									

									<?php if($info != null){echo $info . "<br />"; } ?>

									<div class="textwidget"><?php the_excerpt(); ?></div>
									
							
								</div>							

								<?php endforeach; ?>

								<?php	

									if($upcomingShows == null) {

								?>
												
										<div id="show-post-none"  class="width100 alignleft">

											<p>There are no upcoming shows. Please check back soon.</p>
							
										</div>											

									<?php } ?>
 
							<h2 class="m1left m1bottom" id="events">Upcoming Events</h2>

							<?php foreach ($upcomingEvents as $post) : setup_postdata($post); ?>

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
							$time= $custom["time"][0] . " " . $custom["ampm"][0];
							$info = $custom["info"][0];
							$ticket = $custom["ticket"][0];
							$price = $custom["price"][0];
							?>

							<div class="show-info alignleft width100">

							<?php print get_the_post_thumbnail($post->ID, 'featured-shows', array('class' => 'alignleft mw469')); ?>
							
								<div class="show-info2 alignright m2right">
			
								<h3 class="widgettitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

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
										<?php echo $time; ?><br />										
									</p><br />	

									<div class="clearfix"></div>

									<?php if ( $ticket != "") { ?>
									<p class="p0bottom">Price: <?php echo $price ?></p>
									<?php echo '<a class="alignleft tickets" href="'. $ticket .'" target="_blank" title="buy tickets">Buy Tickets</a>'; ?>	
									<div class="clearfix"></div>
									<?php } ?>									

									<?php if($info != null){echo $info . "<br />"; } ?>

									<div class="textwidget"><?php the_excerpt(); ?></div>
									
							
								</div>

								<?php endforeach; wp_reset_query(); ?>

								<?php	

									if($upcomingEvents == null) {

								?>
						
									<div id="event-post-none"  class="width100 alignleft">

									    <p>There are no upcoming events. Please check back soon.</p>

									</div>		

								<?php } ?>			


							</div>	

						</div>	



						</div>

				

				</article>
						


		</div>

		</div>


</section>
<?php get_footer(); ?>