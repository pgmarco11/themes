<?php 
get_header();
/* Template Name: Arctic Montlhy Live */
?>

<?php

	$arcticMonthly= array(
	'post_type' => 'shows',
	'posts_per_page' => 4,
	'orderby' => 'date',
	'order' => 'ASC',
	'tax_query' => array(
		array(
			'taxonomy' => 'show-type',
			'field' => 'slug',
			'terms' => array('arctic-monthly')
			)
		)
	);

	$arcticMonthlyLive= get_posts($arcticMonthly);

?>

<section id="single-wrapper" class="m5left m5right">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<header>
			<nav class="breadcrumb">
				<?php if( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
			</nav>
		</header>

	<div id="single-row1" class="widthfull alignleft">

		<div id="heading">
			<h1><?php the_title(); ?></h1>

		</div>

		<div id="single-col1">

			<article id="film-top">
				<?php the_post_thumbnail('smallpage-featured-image', array('class' => 'alignright mw480 m2right width100')); ?>					
				
				<div class="content alignleft width55">
				        <?php the_content('Read More...'); ?>							
				</div>

			</article>

			<?php endwhile; else: ?>
							<p><?php _e( 'The page you are looking for could not be found.'); ?></p>
			<?php endif; ?>

			<article id="film-bottom">

			<?php if($arcticMonthlyLive != null) { ?>

			<h2 class="m1left m1bottom">Arctic Monthly Live</h2>

			<?php foreach ($arcticMonthlyLive as $post) : setup_postdata($post); ?>

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


									<br />	
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

							</div>		

					

			</article>

			<?php endforeach; wp_reset_query(); ?>

			<?php } else { 
			echo '<style> #film-top { border-bottom: none; } </style>';
			} ?>

						
		</div>


	</div>


</section>
<?php get_footer(); ?>

