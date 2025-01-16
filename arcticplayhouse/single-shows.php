<?php get_header(); ?>

<section id="single-wrapper" class="container">
	<header class="row mx-2">
		<nav class="breadcrumb">
			<?php if( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
		</nav>
	</header>

	<?php 	
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	
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
	<div class="widthfull mx-2">
		<article>
			<h1><?php the_title(); ?></h1>	
				<div class="row">
					<div class="col-lg-4">	
						<div class="post-thumb">							
							<?php the_post_thumbnail( 'shows-image', array('class' => 'mb-4')); ?>
						</div>	
					</div>		                
		            <div class="col-lg-8 pl-5 pr-5">
								<?php if($writer != null){ ?>
								<p class="pb-0 mb-0">Written by: <?php echo $writer; ?> <br/>
								<?php } ?>
								<?php if($director != null){ ?>
								<p class="pb-0">Directed by: <?php echo $director; ?></p>
								<?php } ?>
									<p class="address">
										<?php if($address != null){ echo $address . "<br />"; } ?>
										<?php if($city != null){ echo $city; } if($city != null){ echo "," . $state . "<br><br>"; } ?>									
										<?php echo $dates; ?>
										<?php if($dates2 != null ){ echo '<br />' . $dates2; } ?><br />
										<?php echo $time; ?><br />									
									</p><br />		
								<?php 	

								if ( $ticket != ""  && strpos($category, 'Show Archives') == false) { ?>

								<p>Price: <?php echo $price ?></p>
								
								<?php echo '<a class="btn tickets mb-4" href="'. $ticket .'" target="_blank" title="buy tickets">Buy Tickets</a>'; ?>	
								
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
				</div>
				<?php endwhile; ?>
						<nav class="w-100 mx-auto">
							<ul class="m-0 p-0">
								<li class="float-left my-4"><?php previous_post_link(); ?></li>
								<li class="float-right my-4"><?php next_post_link(); ?></li>
							</ul>
						</nav>	
				<?php else: ?>
							<p><?php _e( 'The show you are looking for could not be found.'); ?></p>
				<?php endif; ?>	
		</article>
	</div>

</section>
<?php get_footer(); ?>