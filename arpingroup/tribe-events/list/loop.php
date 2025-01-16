<?php
/**
 * List View Loop
 * This file sets up the structure for the list loop
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/loop.php
 *
 * @version 4.4
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php
global $post;
global $more;
$more = false;
$count = 0;
		
$past_events = tribe_get_events( [
		'posts_per_page' => 8,
		'eventDisplay' => 'past',
		'end_date'		=> 'today',
] );

?>

<div class="tribe-events-loop">
	<div class="container">
	  	<div class="row">
	    <?php 
	    if( have_posts() ):

	    while ( have_posts() ) : the_post(); ?>
			<?php do_action( 'tribe_events_inside_before_loop' );  ?>

			<?php 		

			$count = $count + 1;

			if($count == 1){
				continue;
			}


			?>

			<?php if($count == 2 ): ?>
			<div class="col-md-6 pl0">
			<?php elseif($count == 4 && $count % 3 == 0): ?>
			<div class="col-md-3 pl0 pr0">
			<?php elseif($count > 3 && $count % 4 == 0): ?>
			<div class="col-md-3 pl0 pr0">		
			<?php else: ?>
			<div class="col-md-3 pl0">
			<?php endif; ?>

				<!-- Month / Year Headers -->
				<?php //tribe_events_list_the_date_headers(); ?>

				<!-- Event  -->
				<?php
				$post_parent = '';
				if ( $post->post_parent ) {
					$post_parent = ' data-parent-post-id="' . absint( $post->post_parent ) . '"';
				}
				?>
				<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?>" <?php echo $post_parent; ?>>
					<?php				

							/**
							 * Filters the event type used when selecting a template to render
							 *
							 * @param $event_type
							 */				

							if($count == 2 ): 
							tribe_get_template_part( 'list/single', 'featured' );
							else:
							tribe_get_template_part( 'list/single', 'event' );
							endif;

					?>
				</div>

			<?php do_action( 'tribe_events_inside_after_loop' ); ?>
			</div><!-- col -->
			<?php
			endwhile; 
			else:
				 	?><p class="p-large mt10">There are currently no upcoming events</p><?php
			endif;
			?>
		</div><!-- row -->		
	</div><!-- container -->
</div><!-- .tribe-events-loop -->


<div class="past-tribe-events-loop">
	<div class="container">
	<div class="row">
		<div class="col-sm-6 pull-left p0">
			<h2>Past Events</h2>
		</div>
		<div class="col-sm-6 pull-right pr0">
			<nav class="tribe-events-nav-pagination">
				<ul class="tribe-events-sub-nav pull-right mt20">
						<li>
							<a href="<?php echo esc_url(tribe_get_past_link() . '&tribe_paged=1'); ?>"><span>&laquo;</span> <?php echo esc_html( sprintf( __( 'Past %s', 'the-events-calendar' ), tribe_get_event_label_plural() ) ); ?></a>
						</li>
				</ul>
			</nav>
		</div>
	</div>
	<div class="row">
	<?php
		
		if( !empty($past_events) ): 

	    foreach ($past_events as $event){

			setup_postdata($event);
			?>
			<div class="col-xs-12 p0">

				<!-- Month / Year Headers -->
				<?php //tribe_events_list_the_date_headers(); ?>

				<!-- Event  -->
				<div id="post-<?php echo $event->ID ?>" class="past-event mb20 <?php tribe_events_event_classes($event->ID) ?>" >
					<?php				

							/**
							 * Filters the event type used when selecting a template to render
							 *
							 * @param $event_type
							 */				

							// Setup an array of venue details for use later in the template
							$venue_details = tribe_get_venue_details($event->ID);

							$venue_id = tribe_get_venue($event->ID);
							$state = tribe_get_state($venue_id);
							$city = tribe_get_city($venue_id);

							$start_date = tribe_get_start_date($event->ID, true, 'd M Y');
							$start_end_date = tribe_get_start_date($event->ID, true, 'd M');
							$end_date = tribe_get_end_date($event->ID, true, 'd M Y');

							?>

							<span class="pull-left"><?php echo tribe_event_featured_image( $event->ID, 'thumbnail' ); ?></span>

							<!-- Event Meta -->
							<?php do_action( 'tribe_events_before_the_meta' ); ?>

								<div class="pull-left past-event-info pt10 py10">

									<?php if ( $venue_details ) : ?>
										<!-- Venue Display Info -->
										<?php
										if( !empty($state) && !empty($city) ): echo $city . ", " . $state;
												elseif( !empty($state) && empty($city) ): echo $state;
												elseif( empty($state) && !empty($city) ): echo $city;
										endif;

									endif; ?>
									<!-- Event Title -->
									<?php do_action( 'tribe_events_before_the_event_title' ) ?>
										<h3 class="tribe-events-list-event-title clear">
										<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link($event->ID) ); ?>" title="<?php echo get_the_title($event->ID); ?>" rel="bookmark">
												<?php echo get_the_title($event->ID); ?>
											</a>
										</h3>
									<?php do_action( 'tribe_events_after_the_event_title' ) ?>
								</div>

								<div class="date pull-right pt10 py10"><?php echo $start_date; ?></div>								


							<?php do_action( 'tribe_events_after_the_meta' ) ?>

							<!-- Event Content -->
							<?php do_action( 'tribe_events_before_the_content' ) ?>
							<?php
							do_action( 'tribe_events_after_the_content' );

					?>
				</div>

			</div><!-- col -->
		<?php } //endforeach
		else:
		?>
		<div class="col-xs-12 p0">
				<div class="past-event mb20">
					<p class="p-large mt10"><?php _e('There are currently no past events'); ?></p>
				</div>
		</div>
		<?php endif; ?>
		</div><!-- row -->
	</div>
</div>
