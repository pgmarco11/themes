<?php 
get_header(); 

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$event_id = get_the_ID();
 ?>

<style>
#shows-col1 .menu-item-type-custom { height: 33px !important; margin-bottom: 0 !important; }
@media (max-width: 630px) { #shows-col1 .menu-item-type-custom { background-color: #6b8e23 !important; } }
</style>

<section id="shows-wrapper" class="m5left m5right">

		<header>
			<nav class="breadcrumb">
				<?php if( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
			</nav>
		</header>

	<div id="shows-row1" class="widthfull d-flex justify-content-start">

			<h1><?php the_title(); ?></h1>


					<?php
			
					 $main_menu = array(
					'theme_location' => 'shows',
					'container' => 'nav',
					'container_class' => 'd-flex justify-content-start w-100',
					'menu_id' => 'shows-col1',
					'depth' => 0
					); 

					wp_nav_menu( $main_menu ); ?>


		<div id="shows-col2">


<div id="tribe-events-content" class="tribe-events-single vevent hentry">

	<p class="tribe-events-back">
		<a href="<?php echo tribe_get_events_link() ?>"> <?php _e( '&laquo; All Events', 'tribe-events-calendar' ) ?></a>
	</p>

	<!-- Notices -->
	<?php tribe_events_the_notices() ?>
	
	<?php echo tribe_event_featured_image( $event_id, 'featured-event', false ); ?>
	
	<div class="event-info d-flex justify-content-start">
		<?php the_title( '<h2 class="tribe-events-single-event-title summary entry-title">', '</h2>' ); ?>
		
		<div class="tribe-events-schedule updated published tribe-clearfix">
			<?php echo tribe_events_event_schedule_details( $event_id, '<h3>', '</h3>' ); ?>
			<?php if ( tribe_get_cost() ) : ?>
				<span class="tribe-events-divider">|</span>
				<span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
			<?php endif; ?>
		</div>
		<!-- Event content -->
		<?php while ( have_posts() ) :  the_post(); ?>

		<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
		<div class="tribe-events-single-event-description tribe-events-content entry-content description">
			<?php the_content(); ?>
		</div>
		<!-- .tribe-events-single-event-description -->
		<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>		
	</div>


	<!-- Event header -->
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
		<!-- Navigation -->
		<h3 class="tribe-events-visuallyhidden"><?php _e( 'Event Navigation', 'tribe-events-calendar' ) ?></h3>
		<ul class="tribe-events-sub-nav">
			<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
			<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
		</ul>
		<!-- .tribe-events-sub-nav -->
	</div>
	<!-- #tribe-events-header -->

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
			<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
			<?php
			/**
			 * The tribe_events_single_event_meta() function has been deprecated and has been
			 * left in place only to help customers with existing meta factory customizations
			 * to transition: if you are one of those users, please review the new meta templates
			 * and make the switch!
			 */
			if ( ! apply_filters( 'tribe_events_single_event_meta_legacy_mode', false ) ) {
				tribe_get_template_part( 'modules/meta' );
			} else {
				echo tribe_events_single_event_meta();
			}
			?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>

		</div> <!-- #post-x -->

		<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
	<?php endwhile; ?>


	<!-- Event footer -->
	<div id="tribe-events-footer">
		<!-- Navigation -->
		<!-- Navigation -->
		<h3 class="tribe-events-visuallyhidden"><?php _e( 'Event Navigation', 'tribe-events-calendar' ) ?></h3>
		<ul class="tribe-events-sub-nav">
			<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
			<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
		</ul>
		<!-- .tribe-events-sub-nav -->
	</div>
	<!-- #tribe-events-footer -->

</div><!-- #tribe-events-content -->						


			</div>

		</div>

	</div>

	</div>


</section>
<?php get_footer(); ?>

