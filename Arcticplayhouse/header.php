<!DOCTYPE HTML>
<html>

<head>
	<title>
		<?php wp_title(); ?>
	</title>
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="apple-touch-icon" href="images/apple-icon.png">
	<link rel="icon" type="image/x-icon" href="images/favicon.ico" />
	<?php 
	    wp_head(); 
	?>
</head>

<body <?php body_class(); ?>>
	<div class="wrap widthfull">
		<header id="header" class="w-100">
		
			<div class="topheader">
				<div class="container-fluid m5left m5right">
					<div class="row align-items-center mt-3">
							<ul class="phone col-md-6 order-md-1 order-1 d-flex align-items-center justify-content-start">
								<li>
									<p>Box Office: (401) 573-3443</p>
								</li>
							</ul>
							<ul class="address col-md-6 order-md-2 order-2 d-flex align-items-center justify-content-end">
								<li>
									<p>1249 Main St. West Warwick, RI 02893</p>
								</li>							
							</ul>
					</div>
				</div>
			</div>

			<div class="mainheader">
				<div class="container-fluid m5left m5right">
					<div class="row align-items-center">

						<div class="col-md-6 order-md-1 order-1 d-flex align-items-center justify-content-start">
							<a href="/" title="<?php echo get_bloginfo('description'); ?>">
								<img src="<?php echo get_header_image(); ?>" alt="Arctic Playhouse Theatre" class="logo" />
							</a>
						</div>

						<div class="col-md-6 order-md-2 order-2 d-flex align-items-center justify-content-end">
							<div class="text-center mt-4 mb-3">
							<?php include( get_template_directory() . '/inner/social-links-header.html'); ?>
							</div>
						</div>

					</div>
				</div>
			</div>


			<div class="w-100 clearfix bottomheader">
				<nav class="navbar navbar-expand-lg navbar-light">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-nav"
						aria-controls="header-nav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-end" id="header-nav">
						<?php
						$main_menu = array(
							'theme_location' => 'main',
							'container' => 'ul',
							'container_id' => 'header-nav-bar',
							'container_class' => 'navbar-nav ml-auto',
							'menu_class' => 'navbar-nav w-100',
							'depth' => 0,
							'fallback_cb' => true
						);

						wp_nav_menu($main_menu);
						?>
					</div>
				</nav>

			</div>

		</header>

		<div id="content" class="clearfix  mb-4">

			<div id="featured" class="w-100 clearfix">