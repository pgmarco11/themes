<?php get_header(); ?>

<section id="single-wrapper" class="m5left m5right">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

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
	$impact = get_the_post_thumbnail($post->ID, 'feature_show');
	$category = get_the_term_list($post->ID, 'show-type');

	?>

		<header>
			<nav class="breadcrumb">
				<?php if( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
			</nav>
		</header>


	<div id="single-row1" class="widthfull alignleft">

		
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
															
						<?php the_post_thumbnail( 'featured-shows', array('class' => 'alignleft mw580')); ?>
		                
		                <div class="show-info2 alignright m2right">	

								<?php if($writer != null){ ?>
								<p class="p0bottom">Written by: <?php echo $writer; ?> <br/>
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

								<?php 	

								if ( $ticket != ""  && strpos($category, 'Show Archives') == false) { ?>

								<p>Price: <?php echo $price ?></p>
								
								<?php echo '<a class="alignleft tickets" href="'. $ticket .'" target="_blank" title="buy tickets">Buy Tickets</a>'; ?>	
								
								<div class="clearfix"></div>
								<?php } ?>									

								<?php if($info != null){echo $info . "<br /><br />"; } ?>

								
								<?php if ( function_exists( 'sharing_display' ) ) {
								    sharing_display( '', true );
								}
								 
								if ( class_exists( 'Jetpack_Likes' ) ) {
								    $custom_likes = new Jetpack_Likes;
								    echo $custom_likes->post_likes( '' );
								} ?>	

								<?php the_content(); ?>

						</div>					
	
						<?php endwhile; else: ?>
							<p><?php _e( 'The show you are looking for could not be found.'); ?></p>
						<?php endif; ?>

						</article>



		</div>

						<nav class="navi clearfix alignleft m2left links">
								<ul>
									<li class="alignleft"><?php previous_post_link(); ?></li>
									<li class="alignright"><?php next_post_link(); ?></li>
								</ul>
						</nav>	

	</div>

</section>
<?php get_footer(); ?>