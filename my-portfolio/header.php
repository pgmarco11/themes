<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="<?php the_title(); ?>">
    <meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
   
    <meta property="og:url" content="<?php echo esc_url( network_home_url('/' ) ); ?>">
    <meta property="og:type" content="website">
    <?php 
    /* 
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/social-share.jpg">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon.png"> 
    */ 
    ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
    <?php get_template_part( 'src/templates/header-section' ); ?>
</header>
