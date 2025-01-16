<?php
/** 
 *  Main Template File
 *
**/

get_header();

?>

<div id="primary" class="content-area">
<main id="main" class="site-main" role="main">

<?php while( have_posts() ) : the_post();

$parent = wp_get_post_parent_id( $post->ID );

if( is_front_page() ){ ?>

		<section class="section-intro-2 bg-img bg06" data-stellar-background-ratio="0.4" style="background-image: url('<?php echo get_the_post_thumbnail_url($post->ID, 'large') ?>');background-position: 50% -80px; ">
			<div class="bg-overlay op6"></div>
			<div class="container">
				<div class="row mt20 mb20">
					<div class="col-sm-12">
						<h1 class="title-slider-large text-center mb20"><?php the_title(); ?></h1>
						<div class="br-bottom-center mb30"></div>
						<h4 class="title-slider-small uppercased mb0 text-center">
						<?php the_excerpt(); ?>		

						</h4>
					</div>
				</div>
			</div>
		</section>

		<section class="section-bg section-large section-dark m0">
			<div class="container">
				<div class="row col-p30 mt30 mb20">

					<?php get_sidebar('home-main'); ?>

				</div>
			</div>
		</section>	

		<section class="section mb10">
			<div class="container">
				<div class="row col-p30">
				
				<div class="col-sm-6 xs-box3">
						<div class="br-bottom mb20"></div>
									<?php $youtube = get_post_meta($post->ID,'youtube', true); ?>
					
									<iframe class="rs-video" src="<?php echo $youtube; ?>" allow="accelerometer; encrypted-media; gyroscope;"  frameborder="0" allowfullscreen></iframe>
									
					</div>
					<div class="col-sm-6 xs-box3">
						<div class="br-bottom mb20"></div>
						<p><?php the_content(); ?></p>

						<div class="mb40"></div>
						
					</div>
					
					</div>
				</div>
		</section>

		 <section class="section p0 max_height sm_max_height">
			<div class="row col-p0">

			<?php get_sidebar('home-services'); ?> 

			  		
			</div>
		</section>
		

		<section class="section-bg section-large section-light organizations" data-stellar-background-ratio="0.4" >
			
			<div class="container">
				<div class="row mb40">	

				<?php $org_title = get_post_meta($post->ID, 'orgTitle', true); ?>

				 <h2 class="title-border"><?php echo $org_title; ?></h2>			

				<?php get_sidebar('home-organizations'); ?>       	                    
					
			</div>
					
			</div>
		</section>

<?php
} else {

$page_data_about = get_post(214);			
$page_data_services = get_post(216);
$page_data = get_post($post->ID);

if( $parent == 214 || is_page(214) ){		
	$title = $page_data_about->post_title;	
	$excerpt = $page_data_about->post_excerpt;
	$featured_image = get_the_post_thumbnail_url(214, 'full');
	$menu = array( 'theme_location' => 'about', 'menu_class' => 'unstyled-list' );	
} else if( $parent == 216 || is_page(216) ) {
	$title = $page_data_services->post_title;	
	$excerpt = $page_data_services->post_excerpt;
	$featured_image = get_the_post_thumbnail_url(216, 'full');
	$menu = array( 'theme_location' => 'services', 'menu_class' => 'unstyled-list' );
} else {
	$title = $page_data->post_title;
	$excerpt = $page_data->post_excerpt;
	$featured_image = get_the_post_thumbnail_url($post->ID, 'full');
}
?>
	<!-- Do not remove this class -->
		<div class="push-top"></div>

		<section class="section-intro bg-img stellar" data-stellar-background-ratio="0.4" style="background-image: url('<?php echo $featured_image; ?>');">
			<div class="bg-overlay op6"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-5 col-sm-8">
						<h1 class="intro-title mb20">
						<?php echo $title; ?></h1>
						<p class="intro-p mb20">
						<?php echo nl2br($excerpt); ?>
						</p>
					</div>
				</div>
			</div>
		</section>

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

		<section class="section-page mb10">
			<div class="container">
				<div class="row">

				<?php if( $parent == 214 || $parent == 216 || is_page(216) || is_page(214)  ) { ?>
				
					<div class="col-sm-4 col-md-3">

						<aside class="sidebar-nav">
							<nav class="navigation-sidebar">
							<?php wp_nav_menu( $menu ); ?>
							</nav>
						</aside>
						
					</div>

					<div class="col-sm-8 col-md-9 space-left">
						
						<div class="row">
							<div class="col-sm-12">							
	  
					           <h2 class="title-border"><?php the_title() ?></h2>
					           <p><?php the_content() ?></p>

							</div>
						</div>

				<?php } else if(is_page( array(225, 'Companies') )) { ?>

					<div class="col-sm-12">

	            	<?php the_content(); ?>

	            	<?php get_sidebar('companies'); ?>	

				<?php } else { ?>

				<div class="col-sm-12">

					<div class="row mb20">
													
						<div class="col-sm-8">

						   <?php the_content(); ?>											
						
						</div>

						<div class="col-sm-4">							

							<?php if(is_page( array(39, 'Careers') )) {

								get_sidebar('careers');

							?>	

							<?php } else { 

								get_sidebar('default');

							?>
							
						</div>						

				<?php

						} 

					}

				?>
	 

				</div>
			</div>
		</div>
	</section> 

<?php } 
endwhile;
wp_reset_query();

?>

		</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>