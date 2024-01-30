<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();
$image = tribe_event_featured_image($event_id, 'single-event-image', false, false); 
$speaker_title = get_post_meta($event_id, 'speaker_title', true);
$video_title = get_post_meta($event_id, 'video_title', true);

$args = array(
	'post_type' => 'event-speakers',
	'posts_per_page' => -1,
	'orderby' => 'title',
	'order' => 'ASC',
	'post_status' => 'publish',
);
$speakers = get_posts($args);

$args = array(
	'post_type' => 'event-videos',
	'posts_per_page' => -1,
	'orderby' => 'title',
	'order' => 'ASC',
	'post_status' => 'publish',
);
$video_posts = get_posts($args);

?>

<div class="push-top"></div>
<div id="tribe-event-single-background" 
style="background-image: url('<?php if( !empty($image) ): echo $image; endif;  ?>');">
</div>
<div id="tribe-events-content" class="tribe-events-single container mb0">
	<div id="tribe-event-pages">
		<div class="menu-event-menu-container">
			<ul id="menu-event-menu" class="event-menu">
			<?php 

				$event_speakers = [];
				foreach($speakers as $speaker) {
					setup_postdata($speaker);
					$event_speaker_id = get_post_meta($speaker->ID, "event_id", true);
					if($event_id == $event_speaker_id){
						array_push($event_speakers, $event_speaker_id);
					}
				}

				if( !empty($event_speakers) ){

					echo '<li class="menu-item"><a href="' . get_the_permalink($event_id) . '#speakers" title="event speakers">EVENT SPEAKERS</a></li>';	

				}

				$event_videos = [];
				foreach($video_posts as $video) {
					setup_postdata($video);
					$event_video_id = get_post_meta($video->ID, "event_id", true);
					if($event_id == $event_video_id){
						array_push($event_videos, $event_video_id);
					}
				}

				if( !empty($event_videos) ){

					echo '<li class="menu-item"><a href="' . get_the_permalink($event_id) . '#videos" title="event videos">EVENT VIDEOS</a></li>';	

				}

			?>
			</ul>
		</div>	
	</div>
	<div class="row">
    <div class="col-sm-6">

    		<!-- Notices -->
		<?php tribe_the_notices() ?>
		<div class="page-breadcrumbs">
			 
			<?php if(function_exists('bcn_display')) { bcn_display(); } ?>

		</div>

		<?php the_title( '<h1 class="tribe-events-single-event-title mb10">', '</h1>' ); ?>

		<div class="tribe-events-schedule tribe-clearfix mb40">
			<div class="label"><?php echo tribe_get_start_date($event_id, true, 'd F Y'); ?></div>
			<?php if ( tribe_get_cost() ) : ?>
				<span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
			<?php endif; ?>
		</div>
		<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content">
				<?php the_content(); ?>
			</div>
			<!-- .tribe-events-single-event-description -->
			<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>

		</div> <!-- #post-x -->
		<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
	<p class="tribe-events-back p0">
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( '&laquo; ' . esc_html_x( 'All %s', '%s Events plural label', 'the-events-calendar' ), $events_label_plural ); ?></a>
	</p>
    </div>
    <div class="col-sm-6">
    		<div class="event-meta">
    		<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
			<?php tribe_get_template_part( 'modules/meta' ); ?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
			</div>
    </div>
  </div>

	<?php endwhile; ?>

</div><!-- #tribe-events-content -->
<?php $text = get_post_meta($event_id, 'event_info', true); 

	if(!empty($text)):
?>
<div class="event-info tribe-events-single container">

<?php
			
	$content = htmlspecialchars_decode($text);
	$content = wpautop($content);
	echo $content;

?>
</div>
<?php 
	endif;
	
	$speaker_array = array();	
	foreach($speakers as $speaker ){
		setup_postdata($speaker);
		$event_speaker_id = get_post_meta($speaker->ID, "event_id", true);
		array_push($speaker_array, $event_speaker_id);
	}		

	if(in_array($event_id, $speaker_array)){

?>
<div id="speakers"></div>
<div class="speakers tribe-events-single container">
	<h2><?php echo $speaker_title; ?></h2>
	<div class="row">
    	<div class="col">


    			<?php
    				foreach($speakers as $speaker ){
						setup_postdata($speaker);
						$event_speaker_id = get_post_meta($speaker->ID, "event_id", true);

						$imageid = get_post_meta($speaker->ID, "image_id", true);
					    $jobtitle = get_post_meta($speaker->ID, "title", true);
						
						if($event_id == $event_speaker_id){	

					?>
	    	
				    <div class="speaker-grid pull-left pr10">
				    <a href="<?php the_permalink($speaker->ID); ?>" title="<?php echo get_the_title($speaker->ID); ?>">
				    <figure>
				    <?php  if( !empty($imageid) ):
			                   echo wp_get_attachment_image($imageid, 'profile-image');
			                   endif;
			        ?>
				    		<figcaption>
				    			<div class="personal-info">
				    			<h3><?php echo get_the_title($speaker->ID); ?></h3>
				    			</div>
				    			<div class="job-title">
				    			<h3><?php echo $jobtitle; ?></h3>
				    			</div>
				    		</figcaption>
				    		</figure>
				    		</a>
				    </div>
				    <?php 
						}
					}
					?>

	    	</ul>
    	</div>
    </div>
 </div>

<?php 
	}

	$video_array = array();	
	foreach($video_posts as $video ){
		setup_postdata($video);
		$event_video_id = get_post_meta($video->ID, "event_id", true);
		array_push($video_array, $event_video_id);
	}	

	if(in_array($event_id, $video_array)){

?>
<div id="videos"></div>
<div class="videos tribe-events-single container mt20">
	<h2><?php echo $video_title; ?></h2>
   	

    			<?php

    			$video_categories = get_categories( array(
    					'taxonomy' => 'video-category',
    					'orderby' => 'name',
    					'order'	=> 'ASC'
    				) );

    			?>
    			<div class="row">
    			<?php

    			foreach($video_categories as $category ){

    				$args = array(
						'post_type' => 'event-videos',
						'taxonomy' => 'video-category',
						'posts_per_page' => -1,
						'orderby' => 'title',
						'order' => 'ASC',
						'post_status' => 'publish',
						'tax_query' => array(
				            array(
				                'taxonomy' => $category->taxonomy,
				                'field' => 'slug',
				                'terms' => array($category->slug),
				                'operator' => 'IN',
				            )
				         )
					);
					$videos = get_posts($args);

					if( !empty($category) ):

	    					echo '<h3>' . $category->name . '</h3>';

    				endif;		

					foreach($videos as $video ){
						setup_postdata($video);
						
						$video_embed_url = get_post_meta($video->ID, 'video_embed_url', true);

						$video_url = get_post_meta($video->ID, 'video_url', true);
    					$video_id = get_post_meta($video->ID, 'video_id', true);

    					$image_url = get_post_meta($video->ID, "image_url", true);
						$image_id = get_post_meta($video->ID, "image_id", true);						

						if($event_id == $event_video_id  ){			
	

					?>
	    			<div class="col">
						<div class="video-grid pr10">		        
						        	
						        		<div class="video-holder">
						        			<a class="video_link" href="<?php the_permalink($video->ID); ?>" title="<?php echo get_the_title($video->ID); ?>">

						        			<?php
						        			if(!empty($video_embed_url)):
						        			?>
						        				<div class="alignleft clear mb10 p0 vimeo linkwrap">
						        				<div class="blocker"></div>
													<iframe  class="video-frame" align="left" src="<?php echo esc_url($video_embed_url . '?controls=0'); ?>" width="640" height="564" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
												</div>

						        			<?php 
						        				else:
										    ?>
										    <video muted preload="metadata" width="340" height="200" class="video_control" poster="<?php echo esc_url($image_url); ?>" >
										    	<source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
										    	Your browser does not support the video tag.
										    </video>
											<?php endif; ?>

										    <div class="video_title"><?php echo get_the_title($video->ID); ?></div>

										    </a>
									    </div>
									
						</div>
					</div>

					<?php 
						}
					}		

				}
				?>
				</div>

				<?php



				$args = array(
						'post_type' => 'event-videos',
						'taxonomy' => 'video-category',
						'posts_per_page' => -1,
						'orderby' => 'title',
						'order' => 'ASC',
						'post_status' => 'publish',
						'tax_query' => array(
				            array(
				                'taxonomy' => 'video-category',
				                'field' => 'term_id',
				                'terms' => '',
				                'operator' => 'NOT EXISTS',
				            )
				         )
					);
					$videos_nocategory = get_posts($args);
					?>
					<br>
					<div class="row">

					<?php

					foreach($videos_nocategory as $video ){
						setup_postdata($video);
						
						$video_url = get_post_meta($video->ID, 'video_url', true);
    					$video_id = get_post_meta($video->ID, 'video_id', true);

    					$image_url = get_post_meta($video->ID, "image_url", true);
						$image_id = get_post_meta($video->ID, "image_id", true);						

						if($event_id == $event_video_id  ){							

					?>
	    			<div class="col">
						<div class="video-grid pull-left pr10">		        
						        	
						        		<div class="video-holder">
						        			<a class="video_link" href="<?php the_permalink($video->ID); ?>" title="<?php echo get_the_title($video->ID); ?>">
										    <video muted preload="metadata" width="340" height="200" class="video_control" poster="<?php echo esc_url($image_url); ?>" >
										    	<source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
										    	Your browser does not support the video tag.
										    </video>
										    <div class="video_title"><?php echo get_the_title($video->ID); ?></div>
										    </a>
									    </div>
									
						</div>
					</div>

					<?php 
						}
					}	
					
					?>
				</div>



 </div>

<?php 
	}

?>

	<!-- Event footer -->
	<div id="tribe-events-footer" class="container">
		<!-- Navigation -->
		<nav class="tribe-events-nav-pagination mt20" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
			<ul class="tribe-events-sub-nav p0">
				<li class="tribe-events-nav-previous pull-left"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
				<li class="tribe-events-nav-next pull-right"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
			</ul>
			<!-- .tribe-events-sub-nav -->
		</nav>
	</div>
	<!-- #tribe-events-footer -->