<?php
/* Template Name: Home Page */
get_header(); 

	$args= array(
	'post_type' => 'shows',
	'posts_per_page' => 1,
	'orderby' => 'date',
	'tax_query' => array(
		array(
			'taxonomy' => 'show-type',
			'field' => 'slug',
			'terms' => 'now-playing'
			)
		)
	);

	$featuredShow= get_posts($args);

	$upcoming= array(
	'post_type' => 'shows',
	'posts_per_page' => 3,
	'orderby' => 'date',
	'order' => 'ASC',
	'tax_query' => array(
		array(
			'taxonomy' => 'show-type',
			'field' => 'slug',
			'terms' => 'upcoming-shows'
			)
		)
	);

	$upcomingShows= get_posts($upcoming);


	$events= array(
	'post_type' => 'shows',
	'posts_per_page' => 2,
	'orderby' => 'date',
	'order' => 'ASC',
	'tax_query' => array(
		array(
			'taxonomy' => 'show-type',
			'field' => 'slug',
			'terms' => array('events', 'arctic-monthly')
			)
		)
	);

	$upcomingEvents= get_posts($events);


?>
<section id="index-background" class="widthfull">


		<div id="index-row0" class="m5left m5right">

		<div id="non-slide">
			<a href="<?php the_permalink('2223'); ?>" title="mailing list" >
			<div class="feat-image alignleft">
					<p>SUPPORT &amp; DONATE</p>
			</div>
			</a>
		</div>

		<?php echo do_shortcode('[metaslider id="2347"]'); ?>


		</div>

		<div id="index-row1" class="m5left m5right">

			<div class="slider-wrapper alignleft">
				<div id="slider" class="nivoslider">
					<?php echo do_shortcode("[metaslider id=1831]");  ?>

				</div>
			</div>	
						
			<div class="alignright" id="index-col2">
			
			<?php foreach ($featuredShow as $post) : setup_postdata($post); ?>
				
				<?php	
						$custom = get_post_custom($post->ID);
						$writer = $custom["writer"][0];
						$director = $custom["director"][0];
						$ticket = $custom["ticket"][0];
						$dates= $custom["month"][0] . " " . $custom["dates"][0] . ", " . $custom["year"][0];
						if($custom["month2"][0] == null || $custom["dates2"][0] == null || $custom["year2"][0] == null ) {
							$dates2 = null;							
						} else {							
							$dates2= $custom["month2"][0] . " " . $custom["dates2"][0] . ", " . $custom["year2"][0];
						}
						$time= $custom["time"][0] . " " . $custom["ampm"][0];
						$info = $custom["info"][0];
				?>

					<h2>NOW PLAYING</h2>

					<div class="nowplaying textwidget">

								<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

								<p class="time">
									<?php echo $dates; ?>
									<?php if($dates2 != null ){ echo '<br />' . $dates2; } ?>
									<?php echo $time ?><br />
									<?php if($info != null){ echo $info; } ?>
								</p>

								<?php if($writer != null){ ?>
								<p>Written by: <?php echo $writer; ?> 
								<?php } ?>
								<br/>
								<?php if($director != null){ ?>
								Directed by: <?php echo $director; ?></p>
								<?php } ?>

								<p>
								<a class="alignleft tickets " href="<?php echo $ticket; ?>" target="_blank" title="buy tickets"><img src="<?php print IMAGES ?>/buy_tickets.png" alt="arctic playhouse tickets" /></a>
								</p>

					</div>


				<?php
				endforeach; 

				if($featuredShow == null){

				?>

				<div id="front-text">
					<h2>Now Playing</h2>
					<div class="textwidget">
						<p>Please check back soon for our next show or <a href="http://www.thearcticplayhouse.com/shows-events/" title="upcoming shows" >click here</a> to browse upcoming shows.</p>
					</div>
				
				</div>

				<?php } ?>


		</div>			
			
	</div>

</section>

<div class="clear"></div>


<section id="index-wrapper" class="m5left m5right">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php
	
	$desc = nl2br(get_post_meta( $post->ID, 'desc', true ));
    $signup = get_post_meta( $post->ID, 'signup', true );

    if($desc != null || $signup != null) {

 ?>


    <div id="mailing-section">
    <img src="<?php echo IMAGES . '/brochure.png' ?>" alt="arctic playhouse theatre brochure" />
    <p><?php echo $desc; ?></p>
    <a href="<?php echo get_the_permalink(2215)?>" title="mailing list"><?php echo $signup ?></a>
    </div>

<?php } ?>

	<div id="home-content" class="widthfull clearfix alignleft">
		<?php the_content(); ?>

	</div>

	
	<div id="ccontact" class="clearfix alignleft widthfull">

		<?php get_sidebar('front-widgets'); ?>

	
	</div>


	<div id="index-row2" class="widthfull clearfix">
	
			<img src="<?php print IMAGES; ?>/upcoming_shows.png" title="Arctic playhouse shows" class="alignleft upcoming"/>

			<?php foreach ($upcomingShows as $post) : setup_postdata($post); ?>

			<?php	
						$custom = get_post_custom($post->ID);
						$writer = $custom["writer"][0];
						$director = $custom["director"][0];
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

				<div class="show-info width100 alignleft">

					<?php print get_the_post_thumbnail($post->ID, 'featured-shows', array('class' => 'alignleft mw469')); ?>

					<div class="show-info2 alignright m2right">	

							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

									<p class="dates">							
										<?php echo $dates; ?>
										<?php if($dates2 != null ){ echo '<br />' . $dates2; } ?><br />
										<?php echo $time; ?>
									</p>
									<br />
									<?php if ( $price != "" || $price != null) { ?>
									<p class="alignleft">Price: <?php echo $price; ?></p>
									<div class="clearfix"></div>
									<?php } ?>	
									<?php if ( $ticket != "") {
									echo '<a class="alignleft tickets" href="'. $ticket .'" target="_blank" title="buy tickets">Buy Tickets</a><br/>';
									}
									?>
									<div class="clearfix"></div>
									<?php if($info != null){echo  '<p class="alignleft">' . $info . '</p<br />'; } ?>	

								<div class="textwidget alignleft">
								<?php the_excerpt(); ?>	
								</div>										

						</div>

				</div>

			<?php endforeach; ?>

			<?php	

					if($upcomingShows == null) {

						?>
				
					<div id="show-post-none"  class="show-info width100 alignleft">
							<div class="aligncenter">

					        	<p>There are no upcoming shows. Please check back soon.</p>

					        </div>
					</div>											

					<?php } ?>

	</div>


	<div id="index-row3" class="widthfull clearfix">
	
			<img src="<?php print IMAGES; ?>/special_events.png" title="Arctic playhouse shows" class="alignleft upcoming"/>

			<div class="wrapper-events width100">

			<?php foreach ($upcomingEvents as $post) : setup_postdata($post); ?>

			<?php	
						$custom = get_post_custom($post->ID);
						$ticket = $custom["ticket"][0];
						$price = $custom["price"][0];
						$time= $custom["time"][0] . " " . $custom["ampm"][0];
			?>

				<?php 
				$category = get_category(11);
				$category2 = get_category(10);
				$per_page = $category->category_count;
				$per_page2 = $category2->category_count;
				if( ($per_page < 2 && $per_page2 == null) || ($per_page2 < 2 && $per_page == null) ) {
				?>
				<article id="event-<?php the_ID(); ?>" <?php post_class(); ?> style="width:100%; padding-right:0;">
				<?php } else if ( $per_page < 2 && $per_page2 < 2) { ?>
				<article id="event-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php } else { ?>
				<article id="event-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php } ?>

					 <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>	

					<div id="event-post"  class="alignleft">

						<div class="alignleft">

				            <ul class="event-date">

				                <li class="month"><?php echo $custom["month"][0]; ?></li>
				                <li class="day"><?php echo $custom["dates"][0]; ?></li>
				                <li class="year"><?php echo $custom["year"][0]; ?></li>
				                <li class="event-time"><?php echo "@ " . $time; ?></li>
				                
				           </ul>    

	             		</div>   


	             		 	<a href="<?php the_permalink(); ?>"  class="alignleft"><?php the_post_thumbnail('home-events-image'); ?></a> 

             			
							 <div id="event-content" class="alignleft m2left">

							 	<div class="alignleft price">

	                  				<?php if ( $price != "" || $price != null) { ?>
									<p>Price: <?php echo $price; ?></p>
									<?php } ?>	

	                  			</div>
	                  			<div class="clearfix"></div>

							 	<?php if ( $ticket != "") {
									echo '<a class="alignleft tickets" href="'. $ticket .'" target="_blank" title="buy tickets">Buy Tickets</a><br/>';
									}
									?>	
							                				                 				
              				</div>  

              				<div class="alignleft info">

	                  			<?php the_excerpt(); ?>
	                  					
	                  		</div>           			

					</div>
						

				</article> 	

				<?php endforeach; ?>	
						
						<?php	

							if($upcomingEvents == null) {

						?>
				
					<div id="event-post-none"  class="width100 alignleft">
							<div class="aligncenter">

					        	<p>There are no upcoming events. Please check back soon.</p>

					        </div>
					</div>											

						<?php } ?>

						<?php
						$pageID = 1032;
						$page = get_post($pageID);
						?>

						<a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Shows & Events' ) ) ); ?>#events" title="<?php echo $page->post_title; ?>" class="thecategory">Go To Events</a>
											

			</div>

						
	</div>

			<?php endwhile; endif; ?>

				
			<div id="row2" class="alignleft width100 p1bottom">

				<img src="<?php print IMAGES; ?>/supporters.png" title="Arctic playhouse supporters" class="alignleft supporters"/>

				<div class="widget widget_support alignleft m5_5left">

					<ul id="supporters">
						<?php get_sidebar( 'support-widget' ); ?>
					</ul>

				</div>

			</div>
	

</section>



<?php get_footer(); ?>