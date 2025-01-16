<?php
/**
 * Template for single post view
 * @package themify
 * @since 1.0.0
 */
?>

<?php get_header(); ?>

<?php
/** Themify Default Variables
 *  @var object */
global $themify;

$is_in_lightbox = isset( $_GET ) && isset( $_GET['post_in_lightbox'] ) && '1' == $_GET['post_in_lightbox'];
?>

<?php if( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'small'); ?>


<div id="background-cover" style="background-image: url('<?php echo esc_url($featured_image_url); ?>');">	

	<!-- layout-container -->
	<div id="layout" class="pagewidth clearfix">

		<?php if ( is_single() ) : ?>
			<?php if ( $themify->hide_title != 'yes' ): ?>
				<?php themify_before_post_title(); // Hook ?>
				<?php if ( $themify->unlink_title == 'yes' ): ?>
					<h2 class="post-title entry-title"><?php the_title(); ?></h2>
				<?php else: ?>
					<h2 class="post-title entry-title">
						<a href="<?php echo themify_get_featured_image_link(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</h2>
				<?php endif; //unlink post title ?>
				<?php themify_after_post_title(); // Hook ?>
			<?php endif; //post title ?>
		<?php endif; // is single ?>	

		<?php if ( post_password_required() ): ?>

			<?php if ( $is_in_lightbox ) : ?>
				<div class="album-container clearfix">
					<i class="close-lightbox ti-close"></i>
					<div class="album-cover">
						<?php get_template_part( 'includes/post-media', get_post_type() ); ?>
					</div>
					<!-- /album cover -->

					<p class="nopassword"><?php printf( __( 'This album is password protected. Go to its <a href="%s">single view</a> to unlock.', 'themify' ), get_permalink() ); ?></p>
				</div>
				<!-- /.album-container -->
			<?php endif; ?>

		<?php else: ?>

			<div class="album-container clearfix">

				<?php if ( $is_in_lightbox ) : ?>
					<i class="close-lightbox ti-close"></i>
				<?php endif; ?>

				<div class="album-cover">
					<?php get_template_part( 'includes/post-media', get_post_type() ); ?>

					<?php if ( $buy_album = themify_get( 'buy_album' ) ) : ?>
						<a href="<?php echo esc_url( $buy_album ); ?>" class="buy-button"><?php _e( 'Buy Album', 'themify' ); ?></a>
					<?php endif; // buy album ?>

					<?php if ( $is_in_lightbox ) : ?>
						<div class="album-lightnox-excerpt"><?php the_excerpt(); ?></div>
					<?php endif; ?>

				</div>
				<!-- /album cover -->

				<div class="album-playlist">
					<div class="jukebox">
						<ol class="tracklist">
							<?php
							$playlist = '';
							for ( $track = 1; $track <= apply_filters( 'themify_theme_number_of_tracks', 18 ); $track++ ) {
								$this_track = '';
								$this_track_name = '';
								if ( $track_name = themify_get( 'track_name_' . $track ) ) {
									$this_track .= 'title="' . $track_name . '" ';
									$this_track_name = $track_name;
								}

								$track_src = themify_get( 'track_file_' . $track );
								if ( '' != $track_src ) {
									$this_track .= 'src="' . esc_url( themify_https_esc( $track_src ) ) . '"';
								}

								if ( '' != $this_track ) {
									$playlist .= '<li class="track is-playable"><a class="track-title" href="#"><span>'. $this_track_name .'</span></a>' . '[audio ' . $this_track . ']</li>';
								}
							}
							echo do_shortcode( $playlist );
							?>
						</ol>
					</div>
					<!-- /jukebox -->
				</div>

				<!-- /album-playlist -->

				<div class="album-info">

					<ul class="record-details">
						<?php if ( $artist = themify_get( 'artist' ) ) : ?>
							<li>
								<h6 class="record-artist"><?php _e( 'Artist', 'themify' ); ?></h6>
								<p class="record-artist" itemprop="byArtist"><?php echo $artist; ?></p>
							</li>
						<?php endif; // artist?>
						<?php if ( $released = themify_get( 'released' ) ) : ?>
							<li>
								<h6 class="record-release"><?php _e( 'Released', 'themify' ); ?></h6>
								<p class="record-release" itemprop="dateCreated"><?php echo $released; ?></p>
							</li>
						<?php endif; // released ?>
						<?php if ( $genre = themify_get( 'genre' ) ) : ?>
							<li>
								<h6 class="record-genre"><?php _e( 'Genre', 'themify' ); ?></h6>
								<p class="record-genre" itemprop="genre"><?php echo $genre; ?></p>
							</li>
						<?php endif; // genre ?>
					</ul>

				</div>
				<!-- /album-info -->


			</div>
			<!-- /.album-container -->			

		<?php endif; // password required ?>

		<?php get_template_part( 'includes/social-share' ); ?>

		<?php themify_content_before(); // hook ?>
		<!-- content -->
		<div id="content">
			<?php themify_content_start(); // hook ?>

			<?php get_template_part( 'includes/loop', get_post_type() ); ?>

			<?php

			 			$itunes = get_post_meta( $post->ID, 'itunes', true );
					    $spotify = get_post_meta( $post->ID, 'spotify', true );
					    $amazon = get_post_meta( $post->ID, 'amazon', true );
					    $gplay = get_post_meta( $post->ID, 'gplay', true );
					    $cdbaby = get_post_meta( $post->ID, 'cdbaby', true );
					    $sndcld = get_post_meta( $post->ID, 'sndcld', true );
					    $bandcamp = get_post_meta( $post->ID, 'bandcamp', true );
					    $pandora = get_post_meta( $post->ID, 'pandora', true );

						if($itunes == null && $spotify == null && $amazon == null && $gplay == null && $cdbaby == null && $sndcld == null && $bandcamp == null && $pandora == null ){

						} else {

							_e('<h4>ONLINE STORES</h4>');

							_e('<ul class="index-stores">');

							if($itunes != null){ 
								_e('<li><a href="'. $itunes .'" title="itunes store" target="_blank"><i class="itunes"></i></a></li>');
							}
							if($spotify != null){ 
								_e('<li><a href="'. $spotify .'" title="spotify store" target="_blank"><i class="spotify"></i></a></li>');
							}
							if($amazon != null){ 
								_e('<li><a href="'. $amazon .'" title="amazon store" target="_blank"><i class="amazon"></i></a></li>');
							}				
							if($gplay != null){ 
								_e('<li><a href="'. $gplay .'" title="gplay store" target="_blank"><i class="gplay"></i></a></li>');
							}
							if($cdbaby != null){ 
								_e('<li><a href="'. $cdbaby .'" title="cdbaby store" target="_blank"><i class="cdbaby"></i></a></li>');
							}
							if($sndcld != null){ 
								_e('<li><a href="'. $sndcld .'" title="soundcloud store" target="_blank"><i class="sndcld"></i></a></li>');
							}
							if($bandcamp != null){ 
								_e('<li><a href="'. $bandcamp .'" title="bandcamp store" target="_blank"><i class="bandcamp"></i></a></li>');
							}
							if($pandora != null){ 
								_e('<li><a href="'. $pandora .'" title="pandora store" target="_blank"><i class="pandora"></i></a></li>');
							}

							_e('</ul>');

						}

			?>

			<?php wp_link_pages( array( 'before' => '<p class="post-pagination"><strong>' . __( 'Pages:', 'themify' ) . ' </strong>', 'after' => '</p>', 'next_or_number' => 'number' ) ); ?>

			<?php get_template_part( 'includes/author-box', 'single' ); ?>

			<?php get_template_part( 'includes/post-nav' ); ?>

			<?php if(!themify_check('setting-comments_posts')): ?>
				<?php comments_template(); ?>
			<?php endif; ?>

			<?php themify_content_end(); // hook ?>
		</div>
		<!-- /content -->
		<?php themify_content_after(); // hook ?>

		<?php
		/////////////////////////////////////////////
		// Sidebar
		/////////////////////////////////////////////
		if ( $themify->layout != 'sidebar-none' ): get_sidebar(); endif; ?>

	</div>
	<!-- /layout-container -->

</div>

<?php endwhile; ?>

<?php get_footer(); ?>
