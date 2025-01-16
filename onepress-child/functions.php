<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles', 15 );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'onepress-child-style', get_stylesheet_directory_uri() . '/style.css' );

}

function wpb_add_google_fonts() {
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,800,600,700,300', false ); 
}
add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );

define( 'TEMPPATH', get_stylesheet_directory_uri());
define( 'IMAGES', TEMPPATH . "/images");
define( 'DOWNLOADS', TEMPPATH . "/downloads");

add_image_size( 'onepress-small', 340, 260, true );

function onepress_new_excerpt_more( $more ) {
    return sprintf( ' <br /><a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( 'Read More', 'onepress' )
    );
}
add_filter('excerpt_more', 'onepress_new_excerpt_more');


function services_widgets($params) {   
 
    global $services_widget_num; //Our widget counter variable
 
    //Check if we are displaying "Footer Sidebar"
    if(isset($params[0]['id']) && $params[0]['id'] == 'services-widgets'){

        $services_widget_num++;
        $divider = 4; //This is number of widgets that should fit in one row        
 
            //If it's third widget, add last class to it
            if($services_widget_num % $divider == 0){
                $class = 'class="last '; 
                $params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']);

            }
 
    }
 
    return $params;

}
add_filter('dynamic_sidebar_params','services_widgets');

function add_header_contact(){
    ?>
    <div class="topcontainer">
        <div class="container">
                <ul class="social">
                    <li><a href="https://facebook.com/SentinelSafeFloors" title="" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/stopslipandfall" title="" target="_blank" ><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://www.linkedin.com/in/bob-giammarco-a2b1b83" title="" target="_blank" ><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="mailto:info@sentinelsafefloors.com?Subject=Sentinel%20Safe%20Floors%20Web%20Inquiry" target="_top" title="" ><i class="fa fa-envelope ilast"></i></a></li>
                </ul> 

                <ul class="contact">
                    <li><img src="<?php print IMAGES; ?>/phone.png" alt="sentinel safety floors phone" />1 (877) 943-SAFE</li>
                    <li class="last"><img src="<?php print IMAGES; ?>/mail.png" alt="sentinel safety floors email" /><a href="mailto:info@sentinelsafefloors.com">info@sentinelsafefloors.com</a></li>
                </ul> 
        </div>
     </div>
    <?php
}
add_action( 'onepress_site_start', 'add_header_contact'  );

function onepress_footer_site_info()
    {
        ?>
        <?php printf(esc_html__('Copyright %1$s %2$s %3$s', 'onepress'), '&copy;', esc_attr(date('Y')), esc_attr(get_bloginfo())); ?>
        <span class="sep"> &ndash; </span>
        <?php echo 'Website By ' . '<a href="http://www.shimmertechno.com" target="_blank">Shimmer Technologies</a>'; ?>
        <?php
    }
add_action( 'onepress_footer_site_info', 'onepress_footer_site_info' );

if ( function_exists( 'register_sidebar' ) ) 
    { 
        register_sidebar( array (
            'name' => 'Left Footer',
            'id' => 'left-footer-widgets',
            'description' => 'Widgets place here will go to the left of the newsletter and social icons',
            'before_widget' => '<div id="footer-%1$s" class="footer-left">',
            'after_widget' => '</div>',
            'before_title' => '<h5 class="follow-heading">',
            'after_title' => '</h5>'
            ) );

        register_sidebar( array (
            'name' => 'Right Footer',
            'id' => 'right-footer-widgets',
            'description' => 'Widgets place here will go to the right of the newsletter and social icons',
            'before_widget' => '<div id="footer-%1$s" class="footer-right">',
            'after_widget' => '</div>',
            'before_title' => '<h5 class="follow-heading">',
            'after_title' => '</h5>'
            ) );

        register_sidebar( array (
            'name' => 'Services',
            'id' => 'services-widgets',
            'description' => 'Widgets placed here will be listed under the services page as Service',
            'before_widget' => '<div id="col-%1$s" class="col-services">',
            'after_widget' => '</div>',
            'before_title' => '<h2 style="display:none">',
            'after_title' => '</h2>'
            ) );

        register_sidebar( array (
            'name' => 'Safety Primary 1',
            'id' => 'safety-primary-1',
            'description' => 'Widgets placed here will be the first to show under the floor safety page',
            'before_widget' => '<div id="col-%1$s" class="col-safety-1">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>'
            ) );


        register_sidebar( array (
            'name' => 'Safety Primary 2',
            'id' => 'safety-primary-2',
            'description' => 'Widgets placed here will be the second to show under the floor safety page',
            'before_widget' => '<div id="col-%1$s" class="col-safety-2">',
            'after_widget' => '</div>',
            'before_title' => '<h2 style="display:none">',
            'after_title' => '</h2>'
            ) );

        register_sidebar( array (
            'name' => 'Safety Commercial',
            'id' => 'safety-pcommercial',
            'description' => 'Widgets placed here will be show under the floor commercial safety page',
            'before_widget' => '<div id="col-%1$s" class="col-comm">',
            'after_widget' => '</div>',
            'before_title' => '<h2 style="display:none">',
            'after_title' => '</h2>'
            ) );

        register_sidebar( array (
            'name' => 'Safety Residential',
            'id' => 'safety-residential',
            'description' => 'Widgets placed here will be show under the floor residential safety page',
            'before_widget' => '<div id="col-%1$s" class="col-resd">',
            'after_widget' => '</div>',
            'before_title' => '<h2 style="display:none">',
            'after_title' => '</h2>'
            ) );

    }

?>