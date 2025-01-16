<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OnePress
 */
?>
    <footer id="colophon" class="site-footer" role="contentinfo">
        <?php
        $onepress_btt_disable = get_theme_mod('onepress_btt_disable');
        $onepress_social_footer_title = get_theme_mod('onepress_social_footer_title', esc_html__('Keep Updated', 'onepress'));

        $onepress_newsletter_disable = get_theme_mod('onepress_newsletter_disable', '1');
        $onepress_social_disable = get_theme_mod('onepress_social_disable', '1');
        $onepress_newsletter_title = get_theme_mod('onepress_newsletter_title', esc_html__('Join our Newsletter', 'onepress'));
        $onepress_newsletter_mailchimp = get_theme_mod('onepress_newsletter_mailchimp');

        if ($onepress_newsletter_disable != '1' || $onepress_social_disable != '1') : ?>
            <div class="footer-connect">
                <div class="container">
                    <div class="row">
                         <?php if ( is_active_sidebar( 'left-footer-widgets' ) == false && is_active_sidebar( 'right-footer-widgets' ) == true && $onepress_newsletter_disable != '1' && $onepress_social_disable != '1') { ?>
                        <?php } else if ( is_active_sidebar( 'left-footer-widgets' ) == false && is_active_sidebar( 'right-footer-widgets' ) == true && ($onepress_newsletter_disable != '1' || $onepress_social_disable != '1') ) { ?> 
                            <div class="col-sm-2"> 
                             </div>
                        <?php } else if (is_active_sidebar( 'left-footer-widgets' ) == true && is_active_sidebar( 'right-footer-widgets' ) == false && $onepress_newsletter_disable == '1') { ?>
                             <div class="col-sm-2"> 
                             </div>
                             <div class="col-sm-4">                
                             <?php get_sidebar( 'left-footer-widgets' ); ?>
                             </div>
                          <?php } else if (is_active_sidebar( 'left-footer-widgets' ) == true & is_active_sidebar( 'right-footer-widgets' ) == true && $onepress_newsletter_disable == '1') { ?>
                             <div class="col-sm-4">                
                             <?php get_sidebar( 'left-footer-widgets' ); ?>
                             </div>
                         <?php } else if ( is_active_sidebar( 'left-footer-widgets' ) == false && is_active_sidebar( 'right-footer-widgets' ) == true && $onepress_newsletter_disable == '1' ) { ?> 
                             <div class="col-sm-2"> 
                             </div>
                         <?php } else if ( is_active_sidebar( 'left-footer-widgets' ) == true && is_active_sidebar( 'right-footer-widgets' ) == false && $onepress_newsletter_disable != '1' && $onepress_social_disable != '1' ) { ?> 
                             <div class="col-sm-4"> 
                                <?php get_sidebar( 'left-footer-widgets' ); ?>
                             </div>
                          <?php } else if ( is_active_sidebar( 'left-footer-widgets' ) == true && is_active_sidebar( 'right-footer-widgets' ) == false && $onepress_newsletter_disable != '1' && $onepress_social_disable == '1' ) { ?> 
                             <div class="col-sm-2"> 
                             </div>
                             <div class="col-sm-4"> 
                                <?php get_sidebar( 'left-footer-widgets' ); ?>
                             </div>
                         <?php } else { ?>
                            <div class="col-sm-2">                
                            <?php get_sidebar( 'left-footer-widgets' ); ?>
                            </div>
                        <?php } ?>

                        <?php if ($onepress_newsletter_disable != '1' && is_active_sidebar( 'left-footer-widgets' ) == true) { ?>
                            <div class="col-sm-4">
                                <div class="footer-subscribe">
                                    <?php if ($onepress_newsletter_title != '') echo '<h5 class="follow-heading">' . $onepress_newsletter_title . '</h5>'; ?>
                                    <form novalidate="" target="_blank" class="" name="mc-embedded-subscribe-form" id="mc-embedded-subscribe-form" method="post"
                                          action="<?php if ($onepress_newsletter_mailchimp != '') echo $onepress_newsletter_mailchimp; ?>">
                                        <input type="text" placeholder="<?php esc_attr_e('Enter your e-mail address', 'onepress'); ?>" id="mce-EMAIL" class="subs_input" name="EMAIL" value="">
                                        <input type="submit" class="subs-button" value="<?php esc_attr_e('Subscribe', 'onepress'); ?>" name="subscribe">
                                    </form>
                                </div>
                            </div>
                        <?php } else if ($onepress_newsletter_disable != '1' && is_active_sidebar( 'left-footer-widgets' ) == false && is_active_sidebar( 'right-footer-widgets' ) == false  ) {  ?>
                            <div class="col-sm-2"> 
                            </div>
                            <div class="col-sm-4">
                                <div class="footer-subscribe">
                                    <?php if ($onepress_newsletter_title != '') echo '<h5 class="follow-heading">' . $onepress_newsletter_title . '</h5>'; ?>
                                    <form novalidate="" target="_blank" class="" name="mc-embedded-subscribe-form" id="mc-embedded-subscribe-form" method="post"
                                          action="<?php if ($onepress_newsletter_mailchimp != '') echo $onepress_newsletter_mailchimp; ?>">
                                        <input type="text" placeholder="<?php esc_attr_e('Enter your e-mail address', 'onepress'); ?>" id="mce-EMAIL" class="subs_input" name="EMAIL" value="">
                                        <input type="submit" class="subs-button" value="<?php esc_attr_e('Subscribe', 'onepress'); ?>" name="subscribe">
                                    </form>
                                </div>
                            </div>
                        <?php } else if ($onepress_newsletter_disable != '1' && is_active_sidebar( 'left-footer-widgets' ) == false && is_active_sidebar( 'right-footer-widgets' ) == true ) {  ?>
                            <div class="col-sm-4">
                                <div class="footer-subscribe">
                                    <?php if ($onepress_newsletter_title != '') echo '<h5 class="follow-heading">' . $onepress_newsletter_title . '</h5>'; ?>
                                    <form novalidate="" target="_blank" class="" name="mc-embedded-subscribe-form" id="mc-embedded-subscribe-form" method="post"
                                          action="<?php if ($onepress_newsletter_mailchimp != '') echo $onepress_newsletter_mailchimp; ?>">
                                        <input type="text" placeholder="<?php esc_attr_e('Enter your e-mail address', 'onepress'); ?>" id="mce-EMAIL" class="subs_input" name="EMAIL" value="">
                                        <input type="submit" class="subs-button" value="<?php esc_attr_e('Subscribe', 'onepress'); ?>" name="subscribe">
                                    </form>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if ($onepress_social_disable != '1') { ?>

                        <div class="<?php if ($onepress_newsletter_disable == '1' && is_active_sidebar( 'left-footer-widgets' ) == false &&  is_active_sidebar( 'right-footer-widgets' ) == false )  {
                            echo 'col-sm-8';
                        } else {
                            echo 'col-sm-4';
                        } ?>">
                            <?php
                            if ($onepress_social_disable != '1') {
                                ?>
                                <div class="footer-social">
                                    <?php
                                    if ($onepress_social_footer_title != '') echo '<h5 class="follow-heading">' . $onepress_social_footer_title . '</h5>';

                                    $socials = onepress_get_social_profiles();
                                    /**
                                     * New Socials profiles
                                     *
                                     * @since 1.1.4
                                     */                                    
                                    if ( $socials ) {
                                        echo $socials;
                                    } else {
                                        /**
                                         * Deprecated
                                         * @since 1.1.4
                                         */
                                        $twitter = get_theme_mod('onepress_social_twitter');
                                        $facebook = get_theme_mod('onepress_social_facebook');
                                        $google = get_theme_mod('onepress_social_google');
                                        $instagram = get_theme_mod('onepress_social_instagram');
                                        $rss = get_theme_mod('onepress_social_rss');

                                        if ($twitter != '') echo '<a target="_blank" href="' . $twitter . '" title="Twitter"><i class="fa fa-twitter"></i></a>';
                                        if ($facebook != '') echo '<a target="_blank" href="' . $facebook . '" title="Facebook"><i class="fa fa-facebook"></i></a>';
                                        if ($google != '') echo '<a target="_blank" href="' . $google . '" title="Google Plus"><i class="fa fa-google-plus"></i></a>';
                                        if ($instagram != '') echo '<a target="_blank" href="' . $instagram . '" title="Instagram"><i class="fa fa-instagram"></i></a>';
                                        if ($rss != '') echo '<a target="_blank" href="' . $rss . '"><i class="fa fa-rss"></i></a>';
                                    }
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                        <?php } else { ?>

                        <?php } ?>

                       
                        <?php if ( is_active_sidebar( 'left-footer-widgets' ) == false && is_active_sidebar( 'right-footer-widgets' ) == false) { ?>                      
                            <style>.site-footer .footer-connect { text-align: center; } .site-footer .footer-connect .follow-heading {text-align: center; }
                            .site-footer .footer-social { text-align: center; }
                            </style>
                         <?php } else if ( is_active_sidebar( 'left-footer-widgets' ) == true && is_active_sidebar( 'right-footer-widgets' ) == false && ( $onepress_social_disable != '1' && $onepress_newsletter_disable != '1' ) ) { ?> 
                             <style>.site-footer .footer-connect { text-align: center; } .site-footer .footer-connect .follow-heading {text-align: center; }
                             .site-footer .footer-social { text-align: center; }
                            </style> 
                        <?php } else if ( is_active_sidebar( 'left-footer-widgets' ) == true && is_active_sidebar( 'right-footer-widgets' ) == false && ( $onepress_social_disable != '1' || $onepress_newsletter_disable != '1' ) ) { ?> 
                             <div class="col-sm-2">
                             </div>
                             <style>.site-footer .footer-connect { text-align: center; } .site-footer .footer-connect .follow-heading {text-align: center; }
                             .site-footer .footer-social { text-align: center; }
                            </style> 
                        <?php } else if ( is_active_sidebar( 'left-footer-widgets' ) == true && is_active_sidebar( 'right-footer-widgets' ) == false && $onepress_newsletter_disable != '1' && $onepress_social_disable == '1') { ?> 
                             <div class="col-sm-2">
                             </div>
                             <style>.site-footer .footer-connect { text-align: center; } .site-footer .footer-connect .follow-heading {text-align: center; }
                             .site-footer .footer-social { text-align: center; }
                            </style> 
                        <?php } else if ( is_active_sidebar( 'left-footer-widgets' ) == false && is_active_sidebar( 'right-footer-widgets' ) == true && $onepress_newsletter_disable != '1' && $onepress_social_disable == '1') { ?> 
                             <div class="col-sm-4">
                                <?php get_sidebar( 'right-footer-widgets' ); ?>
                             </div>
                             <div class="col-sm-2">
                             </div>
                             <style>.site-footer .footer-connect { text-align: center; } .site-footer .footer-connect .follow-heading {text-align: center; }
                             .site-footer .footer-social { text-align: center; }
                            </style> 
                         <?php } else if ( is_active_sidebar( 'right-footer-widgets' ) == true && is_active_sidebar( 'left-footer-widgets' ) == false && $onepress_newsletter_disable != '1' && $onepress_social_disable != '1') { ?> 
                            <div class="col-sm-4">
                            <?php get_sidebar( 'right-footer-widgets' ); ?>
                            </div>
                             <style>.site-footer .footer-connect { text-align: center; } .site-footer .footer-connect .follow-heading {text-align: center; } 
                             .site-footer .footer-social { text-align: center; }
                            </style>

                         <?php } else if ( is_active_sidebar( 'right-footer-widgets' ) == true && is_active_sidebar( 'left-footer-widgets' ) == false && $onepress_social_disable != '1' && $onepress_newsletter_disable == '1'  ) { ?> 
                            <div class="col-sm-4">
                            <?php get_sidebar( 'right-footer-widgets' ); ?>
                            </div>
                             <div class="col-sm-2">
                             </div>
                             <style>.site-footer .footer-connect { text-align: center; } .site-footer .footer-connect .follow-heading {text-align: center; } 
                             .site-footer .footer-social { text-align: center; }
                            </style> 
                         <?php } else if ( is_active_sidebar( 'left-footer-widgets' ) == false && is_active_sidebar( 'right-footer-widgets' ) == true && $onepress_social_disable == '1') { ?> 
                            <div class="col-sm-4">
                            <?php get_sidebar( 'right-footer-widgets' ); ?>
                            </div>
                             <style>.site-footer .footer-connect { text-align: center; } .site-footer .footer-connect .follow-heading {text-align: center; } 
                             .site-footer .footer-social { text-align: center; }
                            </style>
                         <?php } else if ( is_active_sidebar( 'left-footer-widgets' ) == true && is_active_sidebar( 'right-footer-widgets' ) == true && $onepress_social_disable != '1'  && $onepress_newsletter_disable == '1') { ?> 
                            <div class="col-sm-4">
                            <?php get_sidebar( 'right-footer-widgets' ); ?>
                            </div>
                             <style>.site-footer .footer-connect { text-align: center; } .site-footer .footer-connect .follow-heading {text-align: center; } 
                             .site-footer .footer-social { text-align: center; }
                            </style>                        

                        <?php } else { ?>
                            <div class="col-sm-2">
                            <?php get_sidebar( 'right-footer-widgets' ); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="site-info">
            <div class="container alignleft">
                <?php if ($onepress_btt_disable != '1') : ?>
                    <div class="btt">
                        <a class="back-top-top" href="#page" title="<?php echo esc_html__('Back To Top', 'onepress') ?>"><i class="fa fa-angle-double-up wow flash" data-wow-duration="2s"></i></a>
                    </div>
                <?php endif; ?>
                <?php
                /**
                 * hooked onepress_footer_site_info
                 * @see onepress_footer_site_info
                 */
                do_action('onepress_footer_site_info');
                ?>
            </div>

                <?php
            
                     $main_menu = array(
                        'theme_location' => 'footer',
                        'container' => 'nav',
                        'container_class' => 'clearfix',
                        'menu_class' => 'alignright footer-navigation',
                        'menu_id' => 'footer-nav',
                        'link_after' => '<span class="slash">  / </span>',
                        'depth' => 0
                    ); 

                wp_nav_menu( $main_menu ); ?>
        </div>
        <!-- .site-info -->

    </footer><!-- #colophon -->
<?php
/**
 * Hooked: onepress_site_footer
 *
 * @see onepress_site_footer
 */
do_action( 'onepress_site_end' );


?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
