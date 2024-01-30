<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
get_header();

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();
$event_id = get_post_meta($post->ID, 'event_id', true);

$image_url = get_post_meta($post->ID, "image_url", true);
$image_id = get_post_meta($post->ID, 'image_id', true);

$video_embed_url = get_post_meta($post->ID, "video_embed_url", true);
$video_url = get_post_meta($post->ID, "video_url", true);
$video_id = get_post_meta($post->ID, 'video_id', true);
$about = get_post_meta($post->ID, "about", true);

$event_image_url = tribe_event_featured_image($event_id, 'single-event-image', false, false);

?>
<main id="tribe-events-pg-template" class="tribe-events-pg-template">

<div id="tribe-events" class="" data-live_ajax="0" data-datepicker_format="0" data-category="" data-featured="">
<div class="tribe-events-before-html"></div>
<div class="push-top"></div>
<div id="tribe-event-single-background" style="background-image: url('<?php echo $event_image_url;  ?>');"></div>
<div class="page-breadcrumbs-wrapper pb-without-bg">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="pull-center">
					<div class="page-breadcrumbs">
							<?php if(function_exists('bcn_display')) { bcn_display(); } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="tribe-events-content" class="tribe-events-single container mb40">

	<div class="row event-video py20">

		<div class="video full-width pull-left clear">
			<div class="menu-event-menu-container pull-left clear mt10">
				<p class="tribe-events-back">
							<a href="<?php echo esc_url( tribe_get_event_link($event_id) ); ?>"> 
							<?php printf( '&laquo; ' . esc_html_x( 'Back to %s', '%s Event singular label', 'the-events-calendar' ), $events_label_singular ); ?></a>
				</p>
			</div>

			<div class="video-holder mb10">


				<?php
					if(!empty($video_embed_url)):
				?>
					<div class="pull-center clear mb40 p0 vimeo">
						<iframe class="fullvideo-frame" align="center" src="<?php echo esc_url($video_embed_url); ?>" width="960" height="846" frameborder="0" allow="autoplay; encrypted-media; fullscreen" allowfullscreen></iframe>
					</div>
				<?php 
					else:
				?>
					<video muted controls preload="metadata" id="video_post" poster="<?php echo esc_url($image_url); ?>" >
						<source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
						Your browser does not support the video tag.
					</video>
				<?php endif; ?>


			</div>	

			<h1 class="py0" ><?php echo the_title(); ?></h1>
			<div class="about">
				<?php if ( !empty($about) ): ?>
				<p><?php 
					$content = htmlspecialchars_decode($about);
					$content = wpautop($content);
					echo $content; 
				?></p>
				<?php endif; ?>
			</div>
			<?php social_rocket($post->ID); ?>

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