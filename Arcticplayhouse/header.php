<!DOCTYPE HTML>
<html>

	<head>
		<title><?php wp_title(); ?></title>
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width" />

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,600italic,700,400italic,300italic,800' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<link rel="apple-touch-icon" href="images/apple-icon.png">
		<link rel="icon" type="image/x-icon" href="images/favicon.ico" />

	    <?php wp_enqueue_script( 'jquery' ); 
	    wp_head(); ?>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>

	</head>

	<body <?php body_class(); ?>>

	<div id="wrap" class="widthfull">
		<header id="header" class="width100">
			<div class="width100 clearfix topheader">
				<ul class="phone m5left">
           			 <li><p>Box Office: (401) 573-3443</p></li>
        		</ul> 

        		<ul class="search m5right">
           			 <li><?php get_Search_form(); ?></li>
        		</ul> 

			</div>
			<div class="width100 clearfix">

					<?php
			
					 $main_menu = array(
					'theme_location' => 'main',
					'container' => 'nav',
					'container_id' => 'header-nav-bar',
					'menu_class' => 'header-nav m5left m5right',
					'menu_id' => 'header-nav',
					'depth' => 0
					); 

					wp_nav_menu( $main_menu ); ?>

			</div>

			<div class="width100 clearfix p1bottom ">

				<div id="header_logo" class="alignleft clearfix m5left">
					<a href="/" title="<?php echo ( get_bloginfo('description') ); ?>">

					<img src="<?php echo ( get_header_image() ); ?>" alt="<?php 
					 if(is_search()){
					 	 echo "Arctic Playhouse Theatre";
					 } else {
						 $attachment = get_post($post->ID);	    				
	    				 $alt_text = trim(strip_tags( $attachment->post_title ));	    				 
	    				 if($alt_text != null){
	    				 echo $alt_text; 
	    				 } else {
	    				 echo "Arctic Playhouse Theatre";
	    				 } 
    				 }
    				 ?>" class="logo" />

    				</a>
				</div>


				<div class="alignright contact_social m5right">
					

					<nav>
						<ul class="alignright social">
							<li class="alignleft"><a href="https://www.facebook.com/thearcticplayhouse" title="Arctic Playhouse facebook" target="_blank"><img src="<?php  print IMAGES; ?>/fb.png" alt="Arctic Playhouse West Warwick" /></a></li>
							<li class="alignleft"><a href="https://twitter.com/arcticplayhouse" title="Arctic Playhouse Twitter" target="_blank" ><img src="<?php  print IMAGES; ?>/twitter.png" alt="Arctic Playhouse West Warwick" /></a></li>
							<li class="alignleft"><a href="https://www.instagram.com/thearcticplayhouse/"><img src="<?php  print IMAGES; ?>/instagram.png" alt="Arctic Playhouse West Warwick" /></a></li>
							<li class="alignleft"><a href="mailto:info@thearcticplayhouse.com"><img src="<?php  print IMAGES; ?>/email.png" alt="Arctic Playhouse West Warwick" /></a></li>
							<li class="alignleft"><a href="<?php the_permalink('2223') ?>" title="donate to Arctic Playhouse West Warwick" /><img src="<?php  print IMAGES; ?>/donate.png" alt="Donate to Arctic Playhouse" class="donate-header"/></a></li>
						</ul>
					</nav>

					<p>117 Washington St. West Warwick, RI 02893</p>
					

				</div>

				

			</div>


		</header>

		<div id="content" class="clearfix">
			
			<div id="featured" class="width100 clearfix">