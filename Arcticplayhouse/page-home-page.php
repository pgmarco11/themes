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

?>

<section id="index-background" class="container-fluid">
	<div class="row">

		<div class="col-12 position-relative">
			<div id="slider-wrapper">
				<!-- Backdrop overlay -->
				<div id="slider-backdrop"></div>
				<!-- Slider content -->
				<div id="slider" class="carousel slide position-relative" data-ride="carousel">

					<?php 

					$get_main_slides = get_field('homepage_featured_photos');	

					//echo do_shortcode('[metaslider id="1935"]'); 

					echo $get_main_slides;													
					
					?>

					<!-- Now playing section -->
					<div id="now-playing"
						class="position-absolute w-100 h-100 d-flex justify-content-center align-items-center text-white">
						<div class="text-center nowplaying">
							
							<?php foreach ($featuredShow as $post) : setup_postdata($post); ?>

							<?php	
												$custom = get_post_custom($post->ID);
												$writer = $custom["writer"][0];
												$director = $custom["director"][0];
												$ticket = $custom["ticket"][0];									
												$info = $custom["info"][0];
										?>

							<div>

								<h2>NOW PLAYING</h2>

								<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a>
								</h3>

								<?php if($info != null){  ?>
								<div>
									<?= $info; ?>
								</div>
								<?php } ?>

								<?php if($writer != null){ ?>
								<p>Written by
									<?php echo $writer; ?>
									<?php } ?>
									<br>
									<?php if($director != null){ ?>
									Directed by
									<?php echo $director; ?>
								</p>
								<?php } elseif($writer === $director){ ?>
								<p>Written & Directed by
									<?php echo $writer; ?>
								</p>
								<?php } ?>

								<a class="btn-lg btn-secondary d-flex justify-content-center tickets"
									href="<?php echo $ticket; ?>" target="_blank" title="buy tickets">Buy Tickets</a>
							</div>

							<?php endforeach; ?>
							<?php if ($featuredShow == null) { ?>
							<div id="front-text">
								<div>
									<p>Please check back soon for our next show or <a
											href="http://www.thearcticplayhouse.com/shows-events/"
											title="upcoming shows">click here</a> to browse upcoming shows.</p>
								</div>
							</div>
							<?php } 
							wp_reset_postdata(); 
							?>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="index-wrapper" class="container-fluid mt-4">

		<?php $get_show_slides = get_field('homepage_shows'); ?>

		<?php if( !empty($get_show_slides) ): ?>
		<div class="row">
			<div class="col-12 slider-wrapper mt-5 mb-4">
				<div id="slider" class="carousel slide nivoslider" data-ride="carousel">
					<!-- Indicators -->
					<?php 
					echo $get_show_slides;					
					//echo do_shortcode("[metaslider id=1831]");  					
					?>					
				</div>
			</div>
		</div>
		<?php endif; ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php
			
			$desc = nl2br(get_post_meta( $post->ID, 'desc', true ));
			$signup = get_post_meta( $post->ID, 'signup', true );

			if($desc != null || $signup != null) {

			?>

			<div id="mailing-section">
				<img src="<?php echo get_template_directory_uri() . '/images/brochure.png' ?>" alt="arctic playhouse theatre brochure" />
				<p>
					<?php echo $desc; ?>
				</p>
				<a href="<?php echo get_the_permalink(2215)?>" title="mailing list">
					<?php echo $signup ?>
				</a>
			</div>

			<?php } ?>

			<div id="home-content" class="row widthfull mx-1 d-flex justify-content-start">
				<div class="col-12 w-100">
					<?php the_content(); ?>
				</div>
			</div>

			<?php if ( is_active_sidebar( 'homepage-widgets' ) ): ?>

				<div id="ccontact" class="row mx-1 d-flex justify-content-start widthfull">

					<div class="col-12">
						<?php get_template_part('widgets/homepage-widgets'); ?>
					</div>

				</div>

			<?php endif; ?>

			<div class="row widthfull mx-1">

				<div class="d-flex w-100 align-items-center justify-content-center mt-4 mb-5">
					<img src="<?php echo get_template_directory_uri() ?>/images/left-new.svg" title="Arctic playhouse upcoming shows"
						class="mr-2 left-img" />
					<h2 class="m-0 text-center">Upcoming Shows</h2>
					<img src="<?php echo get_template_directory_uri() ?>/images/right-new.svg" title="Arctic playhouse upcoming shows"
						class="ml-2 right-img" />
				</div>

				<?php get_template_part('inner/upcoming-shows-home'); ?>
				
			</div>

			<div class="row widthfull mx-1">

				<div class="d-flex w-100 align-items-center justify-content-center mt-4 mb-5">
					<img src="<?php echo get_template_directory_uri() ?>/images/left-new.svg" title="Arctic playhouse special events"
						class="mr-2 left-img" />
					<h2 class="m-0 text-center">Special Events</h2>
					<img src="<?php echo get_template_directory_uri() ?>/images/right-new.svg" title="Arctic playhouse special events"
						class="ml-2 right-img" />
				</div>

				<div class="col-12 wrapper-events">
						<?php get_template_part('inner/upcoming-events-home'); ?>
				</div>

			</div>

		<?php endwhile; endif; ?>


		<?php if ( is_active_sidebar( 'supporters-widget' ) ) : ?>
		<div class="row d-flex justify-content-start">

			<div class="d-flex w-100 align-items-center justify-content-center mt-4 mb-5">
				<img src="<?php echo get_template_directory_uri(); ?>/images/left-new.svg" title="Arctic playhouse Supporters"
					class="mr-2 left-img" />
				<h2 class="m-0 text-center">Supporters</h2>
				<img src="<?php echo get_template_directory_uri(); ?>/images/right-new.svg" title="Arctic playhouse Supporters"
					class="ml-2 right-img" />
			</div>

				<div class="col-12 w-100 widget_support d-flex justify-content-start mb-5">

					<ul id="supporters" class="widthfull mx-auto pl-0">
						<?php get_template_part('widgets/supporters-widget' ); ?>
					</ul>

				</div>
		</div>
		<?php endif; ?>
</section>

<?php get_footer(); ?>