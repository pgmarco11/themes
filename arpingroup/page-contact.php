<?php
/* 
*  Template Name: Contact Template
*
*/

get_header();

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php 

			$customerArgs = array(
							'post_type' => 'contacts',
							'posts_per_page' => -1,
							'orderby' => 'title',
							'order' => 'ASC',
							'post_status' => 'publish',
							'tax_query' => array(
								array(
									'taxonomy' => 'division-type',
									'field' => 'slug',
									'terms' => array('customer-support')
								))
							);

			$intOfficeArgs = array(
							'post_type' => 'contacts',
							'posts_per_page' => -1,
							'orderby' => 'title',
							'order' => 'ASC',
							'post_status' => 'publish',
							'tax_query' => array(
								array(
									'taxonomy' => 'division-type',
									'field' => 'slug',
									'terms' => array('international-offices')
								))
							);

			while( have_posts() ) : the_post();

			$page_data = get_post($post->ID);

			$title = $page_data->post_title;
			$excerpt = $page_data->post_excerpt;
			$featured_image = get_the_post_thumbnail_url($post->ID, 'full');

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

				<section class="contactinfo">
				<?php

				$address = nl2br(get_post_meta($post->ID, 'address', true));
				$emailAddress = get_post_meta($post->ID, 'emailAddress', true);
				$phoneNumber = nl2br(get_post_meta($post->ID, 'phoneNumber', true));

				?>
				<div class="row col-p0 max_height xs_max_height">
					<div class="col-sm-6 col-md-4">
						<div class="box-services-d box-services-e el_max_height">
							<div class="bg-overlay"></div>
							<div class="row col-p0">
								<div class="col-sm-12">
									<p class="mb0 "><?php echo $address; ?></p>
									<i class="fa fa-map-marker"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="box-services-d box-services-e dark el_max_height">
							<div class="bg-overlay"></div>
							<div class="row col-p0">
								<div class="col-sm-12">
									<p class="mb0 "><a href="mailto:<?php echo $emailAddress; ?>"><?php echo $emailAddress; ?></a></p>
									<i class="fa fa-envelope-o"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="box-services-d box-services-e green el_max_height">
							<div class="bg-overlay"></div>
							<div class="row col-p0">
								<div class="col-sm-12">
									<p class="mb0 "><?php echo $phoneNumber; ?></p>
									<i class="fa fa-phone"></i>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</section>

			<section class="section page-contact mt30 mb30">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-md-7 sm-box3">
						<?php the_content(); ?>
						</div>

						<?php get_sidebar('contact') ?>

					</div>
				</div>
			</section>

			<section class="section mt30 page-contact mb50">
				<div class="container">
				
					<div class="row col-p30">
						<div class="col-sm-12">

							<?php 
								endwhile;
								wp_reset_postdata();

								$customerSupport = get_posts($customerArgs);
																
							?>
							        
							<h3>
							<?php
								$customerCat = get_term_by('id', 15, 'division-type');
							 	echo $customerCat->name; 
							 ?>							 	
							 </h3>

						</div>

					</div>

		<div class="row col-p30">
			<div class="col-sm-3">
			<div class="box-services-c">
					<i class="fa fa-sitemap fa-style3 circle shadow-b"></i>
					<h3 class="title-small br-bottom-center">Division</h3>
			</div>
			</div>
			<div class="col-sm-3">
			<div class="box-services-c">
					<i class="fa fa-phone fa-style3 circle shadow-b"></i>
					<h3 class="title-small br-bottom-center">Phone</h3>
			</div>
			</div>
			<div class="col-sm-3">
			<div class="box-services-c">
					<i class="fa fa-building fa-style3 circle shadow-b"></i>
					<h3 class="title-small br-bottom-center">Address</h3>
			</div>
			</div>
			<div class="col-sm-3">
			<div class="box-services-c">
					<i class="fa fa-envelope fa-style3 circle shadow-b"></i>
					<h3 class="title-small br-bottom-center">Email</h3>
			</div>
			</div>
		</div>
		<?php

		foreach($customerSupport as $post) : setup_postdata($post);

		$output = get_post_custom($post->ID);
		$phone = nl2br($output["phone"][0]);
		$address = nl2br($output["address"][0]);
		$email = $output["email"][0];

		?>

		<div class="row col-p30">
		<div class="col-sm-3">
		<p class="text-center"><strong><?php the_title(); ?></strong></p>
		</div>

		<div class="col-sm-3">
		<p class="text-center"><?php echo $phone; ?></p>
		</div>
		<div class="col-sm-3">
		<p><?php echo $address; ?></p>

		</div>

		<div class="col-sm-3">
		<p class="text-center"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
		</div>
		</div>
		
		<?php endforeach; wp_reset_postdata(); 

			$intOffices = get_posts($intOfficeArgs);

		?>

		<div class="row col-p30">
		<div class="col-sm-12">
		<h3>
		<?php 
			$intOfficeCat = get_term_by('id', 16, 'division-type');
			echo $intOfficeCat->name; 
		?>	
		</h3>
		</div></div>

		<div class="row col-p30">
		<div class="col-sm-3">
		<div class="box-services-c">
				<i class="fa fa-sitemap fa-style3 circle shadow-b"></i>
				<h3 class="title-small br-bottom-center">Division</h3>
		</div>
		</div>
		<div class="col-sm-3">
		<div class="box-services-c">
				<i class="fa fa-phone fa-style3 circle shadow-b"></i>
				<h3 class="title-small br-bottom-center">Phone</h3>
		</div>
		</div>
		<div class="col-sm-3">
		<div class="box-services-c">
				<i class="fa fa-building fa-style3 circle shadow-b"></i>
				<h3 class="title-small br-bottom-center">Address</h3>
		</div>
		</div>
		<div class="col-sm-3">
		<div class="box-services-c">
				<i class="fa fa-envelope fa-style3 circle shadow-b"></i>
				<h3 class="title-small br-bottom-center">Email</h3>
		</div>
		</div>
		</div>

		<?php

		foreach($intOffices as $post) : setup_postdata($post);

		$output = get_post_custom($post->ID);
		$phone = nl2br($output["phone"][0]);
		$address = nl2br($output["address"][0]);
		$email = $output["email"][0];

		?>

		<div class="row col-p30">
		<div class="col-sm-3">
		<p class="text-center"><strong><?php the_title(); ?></strong></p>
		</div>
		<div class="col-sm-3">
		<p class="text-center"><?php echo $phone; ?></p>
		</div>
		<div class="col-sm-3">
		<p><?php echo $address; ?></p>

		</div>
		<div class="col-sm-3">
		<p class="text-center"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
		</div>
		</div>
		<?php endforeach; wp_reset_postdata(); ?>	


	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>