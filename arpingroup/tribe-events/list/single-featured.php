<?php
/**
 * List View Single Event Featured
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @version 4.6.19
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$event_id = get_the_ID();

// Setup an array of venue details for use later in the template
$venue_details = tribe_get_venue_details();

// The address string via tribe_get_venue_details will often be populated even when there's
// no address, so let's get the address string on its own for a couple of checks below.
$venue_address = tribe_get_address();

// Venue
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

$venue_id = tribe_get_venue();
$state = tribe_get_state($venue_id);
$city = tribe_get_city($venue_id);

$start_date = tribe_get_start_date($event_id, true, 'd M Y');
$start_end_date = tribe_get_start_date($event_id, true, 'd M');
$end_date = tribe_get_end_date($event_id, true, 'd M Y');

$featured_image = tribe_event_featured_image( null, 'thumbnail-event-featured' );
?>

<?php 
if($featured_image == false):
	echo '<div class="thumbnail-event-featured"></div>';
else:
echo $featured_image;

endif;
?>

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
				<?php the_title() ?>
			</a>
		</h3>
	<?php do_action( 'tribe_events_after_the_event_title' ) ?>
</div><!-- .tribe-events-event-meta -->
<?php do_action( 'tribe_events_after_the_meta' ) ?>

<!-- Event Content -->
<?php do_action( 'tribe_events_before_the_content' ) ?>
<?php
do_action( 'tribe_events_after_the_content' );