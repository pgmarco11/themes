<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<title><?php wp_title(); ?></title>
	<meta charset="<?php bloginfo('charset'); ?>" >
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

	<!-- Top Bar -->
	<div class="topbar">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">

					<?php $left_header_menu = array( 'theme_location' => 'top_left_header' , 'menu_class' => 'top-menu');	wp_nav_menu( $left_header_menu ); ?>

				</div>
				<div class="col-sm-6">
					
					<?php get_sidebar('top-right-header'); ?>
					
				</div>
			</div>
		</div>
	</div>

	<!-- Header -->
	<header class="header-wrapper">
		<div class="main-header">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-2">
						<?php 

							if( !has_custom_logo() ){ 

						?>
								<h1><?php bloginfo('name'); ?></h1>

						<?php 	} else { 

									$custom_logo_id = get_theme_mod( 'custom_logo' );
									$image = wp_get_attachment_image_src( $custom_logo_id , 'company-logo-medium' ); 

						?>			
									<a href="<?php echo esc_url( home_url('/') ); ?>" class="logo" rel="home" itemprop="url">
									<img src="<?php echo $image[0]; ?>" class="custom-logo" alt="Arpin Group" itemprop="logo" sizes="(max-width: 576px) 100vw, 576px" >
									</a>
							
									<a href="<?php echo esc_url( home_url('/') ); ?>" class="m-logo" rel="home" itemprop="url">
									<img src="<?php echo get_theme_mod('mobile_logo'); ?>" class="mobile-logo" alt="Arpin Group" itemprop="logo" ></a> 									

						<?php
									
								} 

						?>
					</div>
					<div class="col-sm-12 col-md-10">
						<nav class="navbar-right">

						<?php $main_menu = array( 'theme_location' => 'main' );	wp_nav_menu( $main_menu);	?>

						</nav>
					</div>
				</div>
			</div> <!-- END Container -->
		</div> <!-- END Main-Header -->
	</header> <!-- END Header -->

<?php 
if (function_exists('tribe_is_event_query')): 
	if( tribe_is_event_query() == false): ?>
		<div class="site-content-contain">
		<?php elseif( tribe_is_event_query() == true && is_singular() == false): ?>
		<div class="site-content-contain-event">
		<?php 
	endif; 
else:
?>
	<div id="content" class="site-content-contain">
<?php 
endif; 
?>   