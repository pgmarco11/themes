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
    
    foreach ($featuredShow as $post) : setup_postdata($post); ?>
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
					<article class="mb-4">
						<div class="row">
							<div class="col-lg-4">
								<div class="post-thumb">
									<?php print get_the_post_thumbnail($post->ID, 'shows-image', array('class' => 'd-flex justify-content-center mx-auto mb-4')); ?>
								</div>
							</div>						
							<div class="col-lg-8 pl-5 pr-5">
									<div class="now-playing">	
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

											<?php if($writer != null){ ?>
											<p>Written by: <?php echo $writer; ?> </p>

											<?php } ?>
											<?php if($director != null){ ?>
											<p>Directed by: <?php echo $director; ?></p>
											<?php } ?>

												<p class="address">
													<?php if($address != null){ echo $address . "<br />"; } ?>
													<?php if($city != null){ echo $city; } if($city != null){ echo "," . $state . "<br><br>"; } ?>									
													<?php echo $dates; ?>
													<?php if($dates2 != null ){ echo '<br />' . $dates2; } ?><br />
													<?php echo $time; ?><br />										
												</p><br />	
											
											<p>Price: <?php echo $price ?></p>

											<a class="btn tickets" href="<?php echo $ticket; ?>" target="_blank" title="buy tickets">Buy Tickets</a>

											<?php if($info != null){echo "<p>" . $info . "</p><br />"; } ?>
											<div class="textwidget mt-4">
												<?php the_excerpt(); ?>
											</div>													

							</div>							
						</div>
					</article>
						
	<?php 
	endforeach; 
	wp_reset_postdata();
	?>