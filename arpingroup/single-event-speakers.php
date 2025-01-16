<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
get_header();

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();
$event_id = get_post_meta($post->ID, 'event_id', true);
$imageurl = get_post_meta($post->ID, "image_url", true);
$image_id = get_post_meta($post->ID, 'image_id', true);

$company = get_post_meta($post->ID, "company", true);
$jobtitle = get_post_meta($post->ID, "title", true);
$email = get_post_meta($post->ID, "email", true);
$website = get_post_meta($post->ID, "website", true);
$about = get_post_meta($post->ID, "about", true);

$event_image_url = tribe_event_featured_image($event_id, 'single-event-image', false, false);

?>
<main id="tribe-events-pg-template" class="tribe-events-pg-template">

<div id="tribe-events" class="" data-live_ajax="0" data-datepicker_format="0" data-category="" data-featured="">
<div class="tribe-events-before-html"></div>
<div class="push-top"></div>
<div id="tribe-event-single-background" style="background-image: url('<?php echo $event_image_url;  ?>');"></div>
<div id="tribe-events-content" class="tribe-events-single container mb40">

	<div class="row event-speaker">
		<div class="col-sm-3 speaker-photo" >
			<div class="panel" >
			<div class="profile">
				<div>
				<span>
					<?php 
					$image = wp_get_attachment_image_src($image_id, 'profile-image', false); 
					?>
					<div style="background-image: url('<?php echo $image[0]; ?>');" class="circle-photo" alt="<?php echo the_title(); ?>"></div>
				</span>
				</div>
			</div>
			</div>
		</div>

		<div class="col-sm-9 speaker-info">
			<div class="menu-event-menu-container pull-left clear">
				<p class="tribe-events-back mb0">
						<a href="<?php echo esc_url( tribe_get_event_link($event_id) ); ?>"> 
							<?php printf( '&laquo; ' . esc_html_x( 'Back to %s', '%s Event singular label', 'the-events-calendar' ), $events_label_singular ); ?></a>
				</p>
			</div>
			<div class="speaker-profile full-width pull-left clear">
				<h1 class="mb0 py0" ><?php echo the_title(); ?></h1>
				<p><?php echo $company; ?></p>
				<div class="profile-details">
					<?php if( !empty($jobtitle) ): ?>
					<label class="mb0">Title</label>
					<p><?php echo $jobtitle; ?></p>
					<?php endif; ?>
					<?php if( !empty($email) ): ?>
					<label class="mb0">Email</label>
					<p><a href="<?php echo esc_url('mailto:' . $email); ?>" title="Email <?php the_title(); ?>"><?php echo $email; ?></a></p>
					<?php endif; ?>
					<?php if ( !empty($website) ): ?>
					<label class="mb0">Website:</label>
					<p><a href="<?php echo esc_url($website); ?>" title="<?php the_title(); ?>"><?php echo $website; ?></a></p>
					<?php endif; ?>
					<div class="about">
						<?php if ( !empty($about) ): ?>
						<label class="mb0">About <?php the_title(); ?></label>
						<p><?php 
							$content = htmlspecialchars_decode($about);
							$content = wpautop($content);
							echo $content; 
						?></p>
						<?php endif; ?>
					</div>

				</div>


			</div>
		</div>
	</div> 		

 </div>

</div><!-- #tribe-events-content -->

	<!-- Event footer -->
<div id="tribe-events-footer" class="container">
		<!-- Navigation -->


</div>
<!-- #tribe-events-footer -->

<div class="tribe-events-after-html"></div>
</div><!-- #tribe-events -->
<!--
This calendar is powered by The Events Calendar.
http://m.tri.be/18wn
-->
</main>
<!-- #tribe-events-footer -->
<?php
get_footer();