<?php
/**
 * Template for site footer
 * @package themify
 * @since 1.0.0
 */
?>
<?php
/** Themify Default Variables
 *  @var object */
	global $themify; ?>

				<?php themify_layout_after(); // hook ?>
			</div>
			<!-- /body -->

			<?php if(is_front_page() == false){ ?>

			<div id="footerwrap" class="clearfix">
			
			<?php } else { } ?>

				<?php themify_footer_before(); // hook ?>

				<?php if(is_front_page() == false){ ?>

				<footer id="footer" class="pagewidth clearfix" itemscope="itemscope" itemtype="https://schema.org/WPFooter">

				<?php } else { ?>

				<footer id="footer" class="pagewidth clearfix ontop" itemscope="itemscope" itemtype="https://schema.org/WPFooter">

				<?php } ?>

					<?php themify_footer_start(); // hook ?>

					<?php if (function_exists('wp_nav_menu')) {
						wp_nav_menu(array('theme_location' => 'footer-nav' , 'fallback_cb' => '' , 'container'  => '' , 'menu_id' => 'footer-nav' , 'menu_class' => 'footer-nav')); 
					} ?>

					<?php get_template_part( 'includes/footer-widgets'); ?>

					<?php if(is_front_page() == false){ ?>
					
					<div class="footer-text clearfix">

					<?php } else  { ?>

					<div class="footer-text clearfix">

					<?php } ?>

						<?php themify_the_footer_text(); echo " - "; themify_the_footer_text( 'right' ); 

						wp_nav_menu( array( 'theme_location' => 'copyright', 'container_class' => 'three' ) );

						?>

					</div>
					<!-- /footer-text -->

					<?php themify_footer_end(); // hook ?>

				</footer>
				<!-- /#footer -->

				<?php themify_footer_after(); // hook ?>

				
			<?php if(is_front_page() == false){ ?>

			</div>

			<?php } else { ?>

			<div id="footerback"></div>

			

			<!-- #footerwra
					removed audio player, back to theme player 12/3/2020
			 -->

				<?php //echo '<div id="home-player">' . do_shortcode('[audio src="https://www.kaeordic.com/wp-content/uploads/2018/08/Kaeordic-all-songs-montage.mp3" autoplay=0 loop=no]') . '</div>'; ?>

		<?php } ?>

		</div>
		<!-- /#pagewrap -->



		<?php
		/**
		 * Stylesheets and Javascript files are enqueued in theme-functions.php
		 */
		?>

		<!-- wp_footer -->
		<?php themify_body_end(); // hook ?>
		<?php wp_footer(); ?>
	</body>
</html>