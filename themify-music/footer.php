<?php
/**
 * Template for site footer
 * @package themify
 * @since 1.0.0
 */
?>
<?php if (themify_load_content_only()): ?>
    <?php
    /** Themify Default Variables
     *  @var object */
    global $themify;
    ?>

    <?php themify_layout_after(); // hook  ?>
    </div>
    <!-- /body -->

    <div id="footerwrap">

        <?php themify_footer_before(); // hook  ?>

        <footer id="footer" class="pagewidth clearfix" itemscope="itemscope" itemtype="https://schema.org/WPFooter">

            <?php themify_footer_start(); // hook  ?>

            <?php get_template_part('includes/footer-widgets'); ?>

            <?php
            if (function_exists('wp_nav_menu')) {
                wp_nav_menu(array('theme_location' => 'footer-nav', 'fallback_cb' => '', 'container' => '', 'menu_id' => 'footer-nav', 'menu_class' => 'footer-nav'));
            }
            ?>

            <div class="footer-text clearfix">

                <?php themify_the_footer_text(); ?>

                <?php themify_the_footer_text('right'); ?>

            </div>
            <!-- /footer-text -->

            <?php themify_footer_end(); // hook  ?>

        </footer>
        <!-- /#footer -->

        <?php themify_footer_after(); // hook  ?>

    </div>
    <!-- /#footerwrap -->
    </div>
    <div class="body-overlay"></div>
    <?php if (!themify_check('setting-disable_ajax')): ?>
        <div id="themify-progress"></div>
    <?php endif; ?>
    <!-- /#pagewrap -->

    <?php
    /**
     * Stylesheets and Javascript files are enqueued in theme-functions.php
     */
    ?>

    <!-- wp_footer -->
    <?php themify_body_end(); // hook ?>
    <?php wp_footer(); ?>
    <div id="wpfooter"><?php do_action('themify_footer_data'); // hook   ?></div>
<?php endif; ?>
</body>
</html>
