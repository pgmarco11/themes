<?php
/**
 * Month View Nav Template
 * This file loads the month view navigation.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month/nav.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php do_action( 'tribe_events_before_nav' ) ?>

<h3 class="tribe-events-visuallyhidden"><?php esc_html_e( 'Calendar Month Navigation', 'the-events-calendar' ) ?></h3>

<ul class="tribe-events-sub-nav">
	<li class="tribe-events-nav-previous">
		<a href="" onclick="window.location.href='<?php echo tribe_get_previous_month_link(); ?>'" class="tribe-event-navigation" id="tribe-navi-prev" title="Previous Month">
        	<< <?php echo tribe_get_previous_month_text(); ?>
        </a>
	</li>
	<!-- .tribe-events-nav-previous -->
	<li class="tribe-events-nav-next">
		<a href="" onclick="window.location.href='<?php echo tribe_get_next_month_link(); ?>'" class="tribe-event-navigation" id="tribe-navi-next" title="Previous Month">
        	 <?php echo tribe_get_next_month_text(); ?> >>
        </a>
	</li>
	<!-- .tribe-events-nav-next -->
</ul><!-- .tribe-events-sub-nav -->

<?php
do_action( 'tribe_events_after_nav' );
