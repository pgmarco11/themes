<?php 
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

foreach ($upcomingShows as $post) : setup_postdata($post); ?>

			<?php
				$custom = get_post_custom($post->ID);
				$writer = $custom["writer"][0];
				$director = $custom["director"][0];
				$ticket = $custom["ticket"][0];
				$price = $custom["price"][0];
				$dates = $custom["month"][0] . " " . $custom["dates"][0] . ", " . $custom["year"][0];
				if ($custom["month2"][0] == null || $custom["dates2"][0] == null || $custom["year2"][0] == null) {
					$dates2 = null;
				} else {
					$dates2 = $custom["month2"][0] . " " . $custom["dates2"][0] . ", " . $custom["year2"][0];
				}
				$time = $custom["time"][0] . " " . $custom["ampm"][0];
				$info = $custom["info"][0];
				?>

			<div class="col-12 show-info d-flex justify-content-between pb-4">
					<div class="row">
							<div class="col-5 featured-thumbnail">
									<?php print get_the_post_thumbnail($post->ID, 'shows-image', array('class' => 'mw469')); ?>
							</div>

							<div class="col-7 shows">
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<p class="dates">
										<?php echo $dates; ?>
										<?php if ($dates2 != null) {
											echo '<br />' . $dates2;
										} ?><br />
										<?php echo $time; ?>
									</p>
									<?php if ($price != "" || $price != null) { ?>
										<p class="price">Price: <?php echo $price; ?></p>
									<?php } ?>
									<?php if ($ticket != "") {
										echo '<a class="tickets btn" href="' . $ticket . '" target="_blank" title="Buy Tickets">Buy Tickets</a><br/>';
									} ?>
									<?php if ($info != null) { echo '<p class="info">' . $info . '</p>'; } ?>
									<div class="excerpt pt-5 pb-3">
										<?php the_excerpt(); ?>
										<a href="<?php the_permalink(); ?>" class="more">MORE INFO</a>
									</div>
							</div>
					</div>
			</div>

			<?php 
				endforeach; 
				wp_reset_postdata();
				if($upcomingShows == null) {
				?>
					<div id="show-post-none" class="col-12 show-info justify-content-center">
						<div class="w-100">
							<div class="justify-content-center">
								<p>There are no upcoming shows. Please check back soon.</p>
							</div>
						</div>
					</div>
				<?php 
				} ?>