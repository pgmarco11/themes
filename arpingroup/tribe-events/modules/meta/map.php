<?php
/**
 * Single Event Meta (Map) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/map.php
 *
 * @package TribeEventsCalendar
 * @version 4.4
 */





if ( empty( $map ) ) {
	return;
}

?>

<div class="tribe-events-venue-map">
	<?php
	// Display the map.
	do_action( 'tribe_events_single_meta_map_section_start' );
	if( tribe_address_exists( get_the_ID() ) ) {
	    if (tribe_get_embedded_map( get_the_ID() )) {
	        echo tribe_get_embedded_map( get_the_ID() );
	    }
	}
	do_action( 'tribe_events_single_meta_map_section_end' );
	?>
</div>
