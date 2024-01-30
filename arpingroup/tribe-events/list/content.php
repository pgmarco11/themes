<?php
/**
 * List View Content Template
 * The content template for the list view. This template is also used for
 * the response that is returned on list view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/content.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php

		$display = tribe_get_listview_display();

?>
<?php
if( $display == 'list' && tribe_is_event_category() == false):

	$featured_events = tribe_get_events( [
				'posts_per_page' => 1,
				'featured'		=> true,
	] );

	$non_featured_events = tribe_get_events( [
				'posts_per_page' => 1,
				'featured'		=> false,
				'start_date'     => 'today',	
	] );

?>
<div class="push-top"></div>
<div class="full-width tribe-events-single-section tribe-events-section-category tribe-clearfix">
	<div class="event-filters container p0">
		<div class="menu-event-menu-container">
			<ul id="menu-event-categories" class="menu">
			<?php

			$categories = get_terms( array(
				'taxonomy'	=> 'tribe_events_cat',
				'hide_empty'=> true,
			));			

			foreach($categories as $tribe_category){

				$category_link = get_term_link($tribe_category);

				if(is_wp_error($category_link)){
					continue;
				}

				echo '<li id="menu-item-'.$tribe_category->term_id.'" class="menu-item menu-item-type-taxonomy menu-item-object-tribe_events_cat current-menu-item menu-item-'.$tribe_category->term_id.'"><a href="'. esc_url($category_link) . '">'. $tribe_category->name . '</a></li>';

			}

				echo '<li id="menu-item-all" class="menu-item menu-item-type-taxonomy menu-item-object-tribe_events_cat current-menu-item menu-item-all"><a href="'. tribe_get_events_link() . '">All</a></li>';

			?>
			</ul>
		</div>	
	</div>
</div>
<div id="featured-event" class="center-block">

			<?php 

			if(!empty($featured_events)):

				foreach ($featured_events as $event){

					$venue_id = tribe_get_venue( $event->ID );
					$state = tribe_get_state($venue_id);
					$city = tribe_get_city($venue_id);
					$start_date = tribe_get_start_date($event->ID, true, 'd M Y');
					$event_link = tribe_get_event_link($event->ID);
					$event_image_id = get_post_meta($event->ID, 'image_id', true);

			?>
			<a href="<?php echo esc_url($event_link); ?>" title="<?php echo $event->post_title; ?>">
				<?php $image = wp_get_attachment_image_src($event_image_id, 'featured-event-image', false); 
					  $event_featured_image = tribe_event_featured_image($event->ID, 'featured-event-image', false, false); 
				if($image == false && $event_featured_image == false):

				?>
				<div style="max-width: 1170px; width: 200%; height: 426px; background-color: #303236;"></div>
				<?php elseif($image == true): ?>
				<img src="<?php echo $image[0]; ?>" alt="Arpin Featured Event">
				<?php elseif($event_featured_image == true): ?>
				<img src="<?php echo $event_featured_image; ?>" alt="Arpin Featured Event">
				<?php endif; ?>
			</a>
				<?php					
					echo '<div class="details pull-left"><div class="padding">';
					echo '<div class="label pull-left">';
					if( !empty($state) && !empty($city) ): echo $city . ", " . $state;
					elseif( !empty($state) && empty($city) ): echo $state;
					elseif( empty($state) && !empty($city) ): echo $city;
					endif;
					echo '</div>';
					echo '<div class="label date">' . $start_date . '</div>';
					echo '<div class="pull-left event-title clear"><a href="' . 
					esc_url($event_link) . '" title="' . $event->post_title . '">'
					. $event->post_title . '</a></div>';
					echo '</div></div>';

				}
			else:

				foreach ($non_featured_events as $event){

					$venue_id = tribe_get_venue( $event->ID );
					$state = tribe_get_state($venue_id);
					$city = tribe_get_city($venue_id);
					$start_date = tribe_get_start_date($event->ID, true, 'd M Y');
					$event_link = tribe_get_event_link($event->ID);
					$event_image_id = get_post_meta($event->ID, 'image_id', true);

				?>
				<a href="<?php echo esc_url($event_link); ?>" title="<?php echo $event->post_title; ?>">

				<?php $image = wp_get_attachment_image_src($event_image_id, 'featured-event-image');
					  $event_featured_image = tribe_event_featured_image($event->ID, 'featured-event-image', false, false); 
				if($image == false && $event_featured_image == false):

				?>
				<div style="max-width: 1170px; width: 200%; height: 426px; background-color: #303236;"></div>
				<?php elseif($image): ?>
				<img src="<?php echo $image[0]; ?>" alt="Arpin Featured Event">
				<?php elseif($event_featured_image): ?>
				<img src="<?php echo $event_featured_image; ?>" alt="Arpin Featured Event">
				<?php endif; ?>
			</a>
				<?php					
					echo '<div class="details pull-left"><div class="padding">';
					echo '<div class="label pull-left">';
					if( !empty($state) && !empty($city) ): echo $city . ", " . $state;
					elseif( !empty($state) && empty($city) ): echo $state;
					elseif( empty($state) && !empty($city) ): echo $city;
					endif;
					echo '</div>';
					echo '<div class="label date">' . $start_date . '</div>';
					echo '<div class="pull-left event-title clear"><a href="' . 
					esc_url($event_link) . '" title="' . $event->post_title . '">'
					. $event->post_title . '</a></div>';
					echo '</div></div>';

				}

			endif;
				?>
</div>
<div id="tribe-events-content" class="tribe-events-list">

	<?php
	/**
	 * Fires before any content is printed inside the list view.
	 */
	do_action( 'tribe_events_list_before_the_content' );
	?>

	<!-- Notices -->
	<?php //tribe_the_notices() ?>

	<!-- List Header -->
	<?php do_action( 'tribe_events_before_header' ); ?>
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>

		<!-- Header Navigation -->
		<?php do_action( 'tribe_events_before_header_nav' ); ?>
		<?php //tribe_get_template_part( 'list/nav', 'header' ); ?>
		<?php do_action( 'tribe_events_after_header_nav' ); ?>

	</div>
	<!-- #tribe-events-header -->
	<?php do_action( 'tribe_events_after_header' ); ?>

	<!-- Events Loop -->
		<?php do_action( 'tribe_events_before_loop' ); ?>
		<?php 

			if(!empty($featured_events)):
				tribe_get_template_part( 'list/loop-featured' );
			else:
				tribe_get_template_part( 'list/loop' );
			endif;

		?>
		<?php do_action( 'tribe_events_after_loop' ); ?>

	<!-- List Footer -->
</div><!-- #tribe-events-content -->
<?php elseif( tribe_is_event_category() && $display != 'past' ): 

		global $post;
        $tribe_events_post_type = 'tribe_events';
        $category = get_query_var('term');
        $tribe_events_post_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $events_category_args = array( 
                    'post_type'        => $tribe_events_post_type,
                    'post_status'      => 'publish',
                    'posts_per_page'   => 10, 
                    'paged' 		   => $tribe_events_post_paged,
					'tax_query'		=> array(
							array(
								'taxonomy' => 'tribe_events_cat',
								'field'	=> 	'slug',
								'terms' => $category
							)
						),
					'orderby'=>'_EventStartDate',
                    'order'            => 'ASC'
       );

		$events_category = new WP_Query( $events_category_args );

?>

<div class="full-width tribe-events-single-section tribe-events-section-category tribe-clearfix">
	<div class="event-filters container p0">
		<div class="menu-event-menu-container">
			<ul id="menu-event-categories" class="menu">
			<?php

			$categories = get_terms( array(
				'taxonomy'	=> 'tribe_events_cat',
				'hide_empty'=> true,
			));			

			foreach($categories as $tribe_category){

				$category_link = get_term_link($tribe_category);

				if(is_wp_error($category_link)){
					continue;
				}

				echo '<li id="menu-item-'.$tribe_category->term_id.'" class="menu-item menu-item-type-taxonomy menu-item-object-tribe_events_cat current-menu-item menu-item-'.$tribe_category->term_id.'"><a href="'. esc_url($category_link) . '">'. $tribe_category->name . '</a></li>';

			}

				echo '<li id="menu-item-all" class="menu-item menu-item-type-taxonomy menu-item-object-tribe_events_cat current-menu-item menu-item-all"><a href="'. tribe_get_events_link() . '">All</a></li>';

			?>
			</ul>
		</div>	
	</div>
</div>
<div class="tribe-events-loop">
<div class="container">

	<div class="row">
		<div class="col-sm-6 pull-left p0 mt20">
			<?php 
			$category_title = tribe_get_events_title(false); 
			if( !empty($category) ) {
				$category_name = ucfirst($category);
				$exists = strpos($category_title, $category_name);
			} else {
				$exists = true;
			}
			?>
			<h1><?php 
				if( $exists == true ){
					echo tribe_get_events_title(false);
				} else {
					echo tribe_get_events_title(false) .' › ' . $category_name;
				} 
			?></h1>
		</div>
		<div class="col-sm-6 pull-right">
			<nav class="tribe-events-nav-pagination">
				<ul class="tribe-events-sub-nav pull-right mt20">
						<li>
							<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"><span>&laquo;</span> <?php echo esc_html( sprintf( __( 'All %s', 'the-events-calendar' ), tribe_get_event_label_plural() ) ); ?></a>
						</li>
				</ul>
			</nav>
		</div>

	</div>
	<div class="row">
		<?php if ( $events_category->have_posts() ) : while ( $events_category->have_posts() ) : 
			$events_category->the_post();  ?>
		<div class="col-md-6 pl0">
			<?php do_action( 'tribe_events_inside_before_loop' ); ?>

				<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?>" >
					<?php		
							$event_id = $events_category->ID;

							// Setup an array of venue details for use later in the template
							$venue_details = tribe_get_venue_details($event_id);

							// The address string via tribe_get_venue_details will often be populated even when there's
							// no address, so let's get the address string on its own for a couple of checks below.
							$venue_address = tribe_get_address($event_id);

							// Venue
							$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

							$venue_id = tribe_get_venue($event_id);
							$state = tribe_get_state($venue_id);
							$city = tribe_get_city($venue_id);

							$start_date = tribe_get_start_date($event_id, true, 'd M Y');
							$start_end_date = tribe_get_start_date($event_id, true, 'd M');
							$end_date = tribe_get_end_date($event_id, true, 'd M Y');

							?>

							<?php echo tribe_event_featured_image( $event_id, 'thumbnail-event-featured' ); ?>

							<!-- Event Meta -->
							<?php do_action( 'tribe_events_before_the_meta' ) ?>
							<div class="tribe-events-event-meta">
								<div class="author <?php echo esc_attr( $has_venue_address ); ?> pull-left">

									<?php if ( $venue_details ) : ?>
										<!-- Venue Display Info -->
										<?php
										if( !empty($state) && !empty($city) ): echo $city . ", " . $state;
												elseif( !empty($state) && empty($city) ): echo $state;
												elseif( empty($state) && !empty($city) ): echo $city;
										endif;

									endif; ?>

								</div>
								<div class="date pull-right"><?php echo $start_date; ?></div>
								<!-- Event Title -->
								<?php do_action( 'tribe_events_before_the_event_title' ) ?>
									<h3 class="tribe-events-list-event-title clear">
										<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
											<?php echo the_title() ?>
										</a>
									</h3>
								<?php do_action( 'tribe_events_after_the_event_title' ) ?>
							</div><!-- .tribe-events-event-meta -->
							<?php do_action( 'tribe_events_after_the_meta' ) ?>

							<!-- Event Content -->
							<?php do_action( 'tribe_events_before_the_content' ) ?>
							<?php
							do_action( 'tribe_events_after_the_content' );

					?>
				</div>

		<?php do_action( 'tribe_events_inside_after_loop' ); ?>
		</div>
	<?php 
		endwhile;
		endif;
	?>
</div>
<div class="row">
			<div class="col-sm-12 p0">
						<?php 
								$GLOBALS['wp_query']->max_num_pages = $events_category->max_num_pages;
								$nav = get_the_posts_pagination( array( 

									 	'end_size' => 0,
									 	'mid_size' => 2,
									 	'screen_reader_text' => __(' '),
									 	'next_text' => __('&gt;'),
									 	'type' => 'list'

								) ); 
								echo $nav;
						?>	     									
																  
			</div>
</div>

</div>
</div>

<?php wp_reset_query(); ?>

<?php else: 

		global $post;
        $tribe_events_post_type = 'tribe_events';
        $category = get_query_var('term');
        $tribe_events_post_past_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $events_past_args = array( 
                    'post_type'        => $tribe_events_post_type,
                    'eventDisplay' 	   => 'past',
                    'post_status'      => 'publish',
                    'posts_per_page'   => 10, 
                    'paged' 		   => $tribe_events_post_past_paged,
					'orderby'=>'_EventStartDate',
                    'order'            => 'ASC'
       );

		$events_past = new WP_Query( $events_past_args );

?>
<div class="full-width tribe-events-single-section tribe-events-section-category tribe-clearfix">
	<div class="event-filters container p0">
		<div class="menu-event-menu-container">
			<ul id="menu-event-categories" class="menu">
			<?php

			$categories = get_terms( array(
				'taxonomy'	=> 'tribe_events_cat',
				'hide_empty'=> true,
			));			

			foreach($categories as $tribe_category){

				$category_link = get_term_link($tribe_category);

				if(is_wp_error($category_link)){
					continue;
				}

				echo '<li id="menu-item-'.$tribe_category->term_id.'" class="menu-item menu-item-type-taxonomy menu-item-object-tribe_events_cat current-menu-item menu-item-'.$tribe_category->term_id.'"><a href="'. esc_url($category_link . '?tribe_event_display=past&tribe_paged=1') . '">'. $tribe_category->name . '</a></li>';

			}


				echo '<li id="menu-item-all" class="menu-item menu-item-type-taxonomy menu-item-object-tribe_events_cat current-menu-item menu-item-all"><a href="'. site_url() .'/events/list/?tribe_event_display=past&tribe_paged=1">All</a></li>';

			?>
			</ul>
		</div>	
	</div>
</div>
<div class="tribe-events-loop">
<div class="container">

	<div class="row">
		<div class="col-sm-6 pull-left p0 mt20">
			<?php 
			$category_title = tribe_get_events_title(false); 
			if( !empty($category) ) {
				$category_name = ucfirst($category);
				$exists = strpos($category_title, $category_name);
			} else {
				$exists = true;
			}
			
			?>
			<h1><?php 
				if( $exists == true ){
					echo tribe_get_events_title(false);
				} else {
					echo tribe_get_events_title(false) .' › ' . $category_name;
				} 
			?></h1>
		</div>
		<div class="col-sm-6 pull-right">
			<nav class="tribe-events-nav-pagination">
				<ul class="tribe-events-sub-nav pull-right mt20">
						<li>
							<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"><span>&laquo;</span> <?php echo esc_html( sprintf( __( 'All %s', 'the-events-calendar' ), tribe_get_event_label_plural() ) ); ?></a>
						</li>
				</ul>
			</nav>
		</div>

	</div>
		<div class="row">
		<?php if ( $events_past->have_posts() ) : while ( $events_past->have_posts() ) : 
			$events_past->the_post();  ?>
		<div class="col-md-6 pl0">
			<?php do_action( 'tribe_events_inside_before_loop' ); ?>

				<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?>" >
					<?php		
							$event_id = $events_past->ID;

							// Setup an array of venue details for use later in the template
							$venue_details = tribe_get_venue_details($event_id);

							// The address string via tribe_get_venue_details will often be populated even when there's
							// no address, so let's get the address string on its own for a couple of checks below.
							$venue_address = tribe_get_address($event_id);

							// Venue
							$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

							$venue_id = tribe_get_venue($event_id);
							$state = tribe_get_state($venue_id);
							$city = tribe_get_city($venue_id);

							$start_date = tribe_get_start_date($event_id, true, 'd M Y');
							$start_end_date = tribe_get_start_date($event_id, true, 'd M');
							$end_date = tribe_get_end_date($event_id, true, 'd M Y');

							?>

							<?php echo tribe_event_featured_image( $event_id, 'thumbnail-event-featured' ); ?>

							<!-- Event Meta -->
							<?php do_action( 'tribe_events_before_the_meta' ) ?>
							<div class="tribe-events-event-meta">
								<div class="author <?php echo esc_attr( $has_venue_address ); ?> pull-left">

									<?php if ( $venue_details ) : ?>
										<!-- Venue Display Info -->
										<?php
										if( !empty($state) && !empty($city) ): echo $city . ", " . $state;
												elseif( !empty($state) && empty($city) ): echo $state;
												elseif( empty($state) && !empty($city) ): echo $city;
										endif;

									endif; ?>

								</div>
								<div class="date pull-right"><?php echo $start_date; ?></div>
								<!-- Event Title -->
								<?php do_action( 'tribe_events_before_the_event_title' ) ?>
									<h3 class="tribe-events-list-event-title clear">
										<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
											<?php echo the_title() ?>
										</a>
									</h3>
								<?php do_action( 'tribe_events_after_the_event_title' ) ?>
							</div><!-- .tribe-events-event-meta -->
							<?php do_action( 'tribe_events_after_the_meta' ) ?>

							<!-- Event Content -->
							<?php do_action( 'tribe_events_before_the_content' ) ?>
							<?php
							do_action( 'tribe_events_after_the_content' );

					?>
				</div>

		<?php do_action( 'tribe_events_inside_after_loop' ); ?>
		</div>
	<?php 
		endwhile;
		else:
		?>
			<p><?php _e('There are currently no past events'); ?></p>
		<?php
		endif;
	?>
</div>
<div class="row">
			<div class="col-sm-12 p0">
						<?php 
								$GLOBALS['wp_query']->max_num_pages = $events_past->max_num_pages;
								$nav = get_the_posts_pagination( array( 

									 	'end_size' => 0,
									 	'mid_size' => 2,
									 	'screen_reader_text' => __(' '),
									 	'next_text' => __('&gt;'),
									 	'type' => 'list'

								) ); 
								echo $nav;
						?>	     									
																  
			</div>
</div>

</div>
</div>

<?php endif; ?>