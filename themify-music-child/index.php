<?php
/**
 * Template for common archive pages, author and search results
 * @package themify
 * @since 1.0.0
 */
?>
<?php get_header(); ?>

<?php 
/** Themify Default Variables
 *  @var object */
global $themify;
?>

<header id="content-header" class="clearfix">
	<time datetime="<?php the_time( 'o-m-d' ); ?>"></time>

<?php 
	/////////////////////////////////////////////
	// Search Title	 							
	/////////////////////////////////////////////
	?>
	<?php if( is_search() ): ?>
		<h1 class="page-title"><?php _e('Search Results for:','themify'); ?> <em><?php echo get_search_query(); ?></em></h1>
	<?php endif; ?>

<?php
	/////////////////////////////////////////////
	// Date Archive Title
	/////////////////////////////////////////////
	?>
	<?php if ( is_day() ) : ?>
		<h1 class="page-title"><?php printf( __( 'Daily Archives: <span>%s</span>', 'themify' ), get_the_date() ); ?></h1>
	<?php elseif ( is_month() ) : ?>
		<h1 class="page-title"><?php printf( __( 'Monthly Archives: <span>%s</span>', 'themify' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'themify' ) ) ); ?></h1>
	<?php elseif ( is_year() ) : ?>
		<h1 class="page-title"><?php printf( __( 'Yearly Archives: <span>%s</span>', 'themify' ), get_the_date( _x( 'Y', 'yearly archives date format', 'themify' ) ) ); ?></h1>
	<?php endif; ?>

	<?php 
	/////////////////////////////////////////////
	// Category Title	 							
	/////////////////////////////////////////////
	?>
	<?php if( is_category() || is_tag() || is_tax() ): ?>
			<h1 class="page-title"><?php single_cat_title(); ?></h1>
		<?php echo themify_get_term_description(); ?>
	<?php endif; ?>

	<?php if(is_post_type_archive()): 

		if ( get_post_type( get_the_ID() ) == 'album') { ?>
			<h1 class="page-title"><?php echo get_the_title('3949'); ?></h1>
		<?php } else { ?>
			<h1 class="page-title"><?php post_type_archive_title(); ?></h1>
	<?php
		}
	 	endif; ?>

</header>

<!-- layout -->
<div id="layout" class="pagewidth clearfix">

	<!-- content -->
    <?php themify_content_before(); //hook ?>

    <?php if ( is_post_type_archive('album') == false ){  ?>

		<div id="content" class="clearfix">

	<?php } else { ?>

		<div id="content" class="clearfix" style="width: 100%">

    <?php } themify_content_start(); //hook ?>
		
		<?php 
		/////////////////////////////////////////////
		// Author Page	 							
		/////////////////////////////////////////////
		if(is_author()) : ?>
			<?php
			global $author, $author_name;
			$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
			$author_url = $curauth->user_url;
			?>
			<div class="author-bio clearfix">
				<p class="author-avatar"><?php echo get_avatar( $curauth->user_email, $size = '48' ); ?></p>
				<h2 class="author-name"><?php _e('About ','themify'); ?> <span><?php echo $curauth->display_name; ?></span></h2>
				<?php if($author_url != ''): ?><p class="author-url"><a href="<?php echo $author_url; ?>"><?php echo $author_url; ?></a></p><?php endif; //author url ?>
				<div class="author-description">
					<?php echo $curauth->user_description; ?>
				</div>
				<!-- /.author-description -->
			</div>
			<!-- /.author bio -->
			
			<h2 class="author-posts-by"><?php _e('Posts by','themify'); ?> <?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?>:</h2>
		<?php endif; ?>
	


		<?php 
		/////////////////////////////////////////////
		// Default query categories	 							
		/////////////////////////////////////////////
		?>
		<?php if( !is_search() ): ?>
			<?php
				global $query_string;
				query_posts( apply_filters( 'themify_query_posts_args', $query_string.'&order='.$themify->order.'&orderby='.$themify->orderby ) );
			?>
		<?php endif; ?>

		<?php 
		/////////////////////////////////////////////
		// Loop	 							
		/////////////////////////////////////////////
		?>
		<?php if (have_posts()) : $count = 0; ?>

			

			<!-- loops-wrapper -->
			<div id="loops-wrapper" class="loops-wrapper <?php echo $themify->layout . ' ' . $themify->post_layout; ?>">

			<?php if ( is_post_type_archive('album') ){

					$songs =  new WP_Query( array(
						'post_type' => 'album',
						'posts_per_page' => -1,
						'order' => 'ASC',
						'orderby' => 'menu_order',
						)
					);

					if ( $songs->have_posts() ) : while ( $songs->have_posts() ) : $songs->the_post();

				?>

				<div class="tracklist track<?php echo $count; ?>">

				<?php the_post_thumbnail('thumbnail') ?>

				<div class="track-info">

					<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>


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

				</div>
				

				<!-- /album-info -->
				
				<div class="album-container clearfix">
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
					</div>
				</div>
				<br>

				<div class="post-content">
						<?php the_content(); ?>
				</div>

				<?php
						
					    $itunes = get_post_meta( $post->ID, 'itunes', true );
					    $spotify = get_post_meta( $post->ID, 'spotify', true );
					    $amazon = get_post_meta( $post->ID, 'amazon', true );
					    $reverb = get_post_meta( $post->ID, 'reverb', true );
					    $gplay = get_post_meta( $post->ID, 'gplay', true );
					    $cdbaby = get_post_meta( $post->ID, 'cdbaby', true );
					    $sndcld = get_post_meta( $post->ID, 'sndcld', true );
					    $bandcamp = get_post_meta( $post->ID, 'bandcamp', true );
					    $pandora = get_post_meta( $post->ID, 'pandora', true );


						if($reverb == null && 
							$itunes == null && 
							$spotify == null && 
							$amazon == null && 
							$gplay == null && 
							$cdbaby == null &&
							$sndcld == null &&
							$bandcamp == null &&
							$pandora == null 
						){

						} else {

							_e('<h4>Online Stores</h4>');

							_e('<ul class="index-stores">');

							if($itunes != null){ 
								_e('<li><a href="'. $itunes .'" title="itunes store" target="blank"><i class="itunes"></i></a></li>');
							}
							if($spotify != null){ 
								_e('<li><a href="'. $spotify .'" title="spotify store" target="blank"><i class="spotify"></i></a></li>');
							}
							if($amazon != null){ 
								_e('<li><a href="'. $amazon .'" title="amazon store" target="blank"><i class="amazon""></i></a></li>');
							}
							if($reverb != null){ 
								_e('<li><a href="'. $reverb .'" title="reverb store" target="blank"><i class="reverb" ></i></a></li>');
							}							
							if($gplay != null){ 
								_e('<li><a href="'. $gplay .'" title="google play store" target="blank"><i class="gplay" ></i></a></li>');
							}
							if($cdbaby != null){ 
								_e('<li><a href="'. $cdbaby .'" title="cdbaby store" target="blank"><i class="cdbaby" ></i></a></li>');
							}
							if($sndcld != null){ 
								_e('<li><a href="'. $sndcld .'" title="soundcloud store" target="blank"><i class="sndcld" ></i></a></li>');
							}							
							if($bandcamp != null){ 
								_e('<li><a href="'. $bandcamp .'" title="bandcamp store" target="blank"><i class="bandcamp" ></i></a></li>');
							}
							if($pandora != null){ 
								_e('<li><a href="'. $pandora .'" title="pandora store" target="blank"><i class="pandora"></i></a></li>');
							}

							_e('</ul>');

						}

						$count = $count + 1;

						?>

						
					</div>

						<?php

						endwhile; 
						wp_reset_postdata();			
						endif;  

				 	} else { 

				 	 while (have_posts()) : the_post(); ?>

					<?php get_template_part( 'includes/loop', get_post_type() ); ?>		
				
					<?php endwhile; } ?>
							
			</div>
			<!-- /loops-wrapper -->

			<?php get_template_part( 'includes/pagination'); ?>
		
		<?php 
		/////////////////////////////////////////////
		// Error - No Page Found	 							
		/////////////////////////////////////////////
		?>
	
		<?php else : ?>
	
			<p><?php _e( 'Sorry, nothing found.', 'themify' ); ?></p>
	
		<?php endif; ?>			
	<?php themify_content_end(); //hook ?>
	</div>
    <?php themify_content_after(); //hook ?>
	<!-- /#content -->

	<?php 
	/////////////////////////////////////////////
	// Sidebar							
	/////////////////////////////////////////////
	if ($themify->layout != "sidebar-none"): 

	if ( is_post_type_archive('album') == false ){ 

	get_sidebar();
	
	}

	endif; ?>

</div>
<!-- /#layout -->

<?php get_footer(); ?>