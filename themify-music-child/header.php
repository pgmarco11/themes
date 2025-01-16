<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php
/** Themify Default Variables
 *  @var object */
	global $themify; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">

<link rel="icon" href="<?php echo home_url(); ?>/favicon.ico">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo home_url(); ?>/favicon-16x16.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo home_url(); ?>/favicon-32x32.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo home_url(); ?>/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="192x192" href="<?php echo home_url(); ?>/android-chrome-192x192.png">
<link rel="icon" type="image/png" sizes="512x512" href="<?php echo home_url(); ?>/android-chrome-512x512.png">
<link rel="icon" type="image/svg+xml" href="<?php echo home_url(); ?>/icon.svg">
<link rel="manifest" href="<?php echo home_url(); ?>/manifest.json">

<meta property="og:description" content="kaeordic. musician. Solo Guitarist." />

<!-- wp_header -->
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php themify_body_start(); // hook ?>
<div id="pagewrap" class="hfeed site">

		<?php themify_header_before(); // hook ?>

		<div id="header-top-menu" class="clearfix">	

		<div class="topwidth clearfix">
					
				<div class="login" style="max-width:100%">

					<?php if(is_user_logged_in()){ ?>
						
						<a href="<?php echo wp_logout_url(home_url('/login')); ?>" title="Logout">LOGOUT</a>			

					<?php } else { ?>	
						
						<a href="<?php echo home_url(); ?>/login" title="Login">LOGIN</a>
						
						<?php 
						/* 
						<span>/</span>
				        <a href="<?php echo home_url(); ?>/register">REGISTER</a>
						*/ 
						?>
						
				    <?php } ?>
					</div> 

					<div class="social-widget">
							<?php dynamic_sidebar('social-widget'); ?>

							<?php if ( ! themify_check('setting-exclude_rss' ) ) : ?>
								<div class="rss"><a href="<?php themify_theme_feed_link(); ?>" class="hs-rss-link"></a></div>
							<?php endif; ?>
					</div>
						<!-- /.social-widget -->

			</div>

		</div>

		<?php themify_header_start(); // hook ?>

		<div id="headerwrap" class="clearfix">
							
		<!-- #header -->

		<header id="header" class="pagewidth clearfix" itemscope="itemscope" itemtype="https://schema.org/WPHeader">
			<div class="header-content">
				<?php echo themify_logo_image('site_logo'); ?>

				<a id="menu-icon" href="#"></a>

				<div id="mobile-menu" class="sidemenu sidemenu-off">
					<nav id="main-nav-wrap" class="clearfix" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
						<?php themify_theme_menu_nav(); ?>
						<!-- /#main-nav -->
					</nav>
					<a id="menu-icon-close" href="#sidr"></a>
				</div>
				
				<!-- Cart -->
				<div class="cart">
					<a href="<?php echo edd_get_checkout_uri(); ?>">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="header-cart edd-cart-quantity"><?php echo edd_get_cart_quantity(); ?></span>
					</a>
				</div>

			</div>

			
		</header>

		<?php themify_header_end(); // hook ?>

		<!-- /#header -->

        <?php themify_header_after(); // hook ?>

	</div>
	<!-- /#headerwrap -->

	<div id="body" class="clearfix">
    <?php themify_layout_before(); //hook ?>
