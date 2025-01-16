<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

  <title><?php wp_title(); ?></title>
  <meta charset="<?php bloginfo('charset'); ?>" >
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container">

      <?php 

            if( !has_custom_logo() ){ 
      ?>
                  <h1><?php bloginfo('name'); ?></h1>

      <?php } else {                  
                  
                  $custom_logo_id = get_theme_mod( 'custom_logo' );
                  $image = wp_get_attachment_image_src( $custom_logo_id , 'logo-small' );                 
      ?>                    
                  <a class="navbar-brand" href="<?php echo esc_url( home_url('/') ); ?>" class="logo" rel="home" itemprop="url">
                  <img src="<?php echo $image[0]; ?>" class="custom-logo" alt="GSA University" itemprop="logo"  >
                  </a>
              
      <?php
                  
            } 

      ?>
      <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>-->
        <?php 
            $primary_menu = array( 
              'theme_location' => 'primary-menu',
              'container'       => 'div',
              'container_class' => 'collapse navbar-collapse',
              'container_id'    => 'navbarResponsive',
              'menu_class'      => 'navbar-nav ml-auto',
              'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
              'walker'          => new WP_Bootstrap_Navwalker(),
              ); 
            if(has_nav_menu('primary-menu')){
              wp_nav_menu( $primary_menu );
            } 
        ?>
    </div>
  </nav>