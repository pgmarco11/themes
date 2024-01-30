			</div> <!--Featured-->
		</div> <!--Content-->

		<section id="footer" class="width100">


			<div id="row1" class="alignleft width100">

				<div id="footer-navbar" class="m5_5left">

					<div class="alignleft" id="footer-widgets">

						<div class="widget widget_menu">
							<?php
					
							 $main_menu = array(
							'theme_location' => 'footer',
							'container' => 'nav',
							'container_class' => 'clearfix',
							'menu_class' => 'alignleft',
							'menu_id' => 'footer-nav',
							'depth' => 0
							); 

							wp_nav_menu( $main_menu ); ?>

						</div>

						<?php get_sidebar( 'footer-widget' ); ?>	

						<div class="widget widget_social">
								<h3>Connect With Us</h3>
								<nav class="clearfix">
									<ul id="footer-social" class="alignleft">
										<li class="alignleft"><a href="https://www.facebook.com/thearcticplayhouse" title="Arctic Playhouse facebook" target="_blank"><img src="<?php  print IMAGES; ?>/fb-footer.png" alt="Arctic Playhouse West Warwick" /></a></li>
										<li class="alignleft"><a href="https://twitter.com/arcticplayhouse" title="Arctic Playhouse Twitter" target="_blank" ><img src="<?php  print IMAGES; ?>/tw-footer.png" alt="Arctic Playhouse West Warwick" /></a></li>
										<li class="alignleft"><a href="https://www.instagram.com/thearcticplayhouse/"><img src="<?php  print IMAGES; ?>/instagram-footer.png" alt="Arctic Playhouse West Warwick" /></a></li>
										<li class="alignleft"><a href="mailto:info@thearcticplayhouse.com"><img src="<?php  print IMAGES; ?>/email-footer.png" alt="Arctic Playhouse West Warwick" /></a></li>
										<li class="alignleft"><a href="<?php the_permalink('2223') ?>" title="donate to Arctic Playhouse West Warwick" /><img src="<?php  print IMAGES; ?>/donate-footer.png" alt="Donate to Arctic Playhouse"/></a></li>
									</ul>
								</nav>

						</div>


					</div>

					
					<?php get_sidebar( 'contactus-widget' ); ?>
							
								
				</div>


			</div>


			<div id="row3" class="alignleft width100pad">

					<div class="alignleft copyright">
						<ul><li><p>&#169; 2018 <?php bloginfo('name'); ?></p></li><li><p>&nbsp;<span class="black"> / </span><em>West Warwick Arctic Theatre</em><span class="black"> / </span></p></li><li><p><span class="shimmer"> Website by:</span>Shimmer Technologies</p></li></ul>
					</div>
				
				<nav class="alignright m5right width9">
                 <?php
                if( is_user_logged_in() ) {

                _e('<a href="'. wp_logout_url( home_url() ) . '" title="logout"><span class="black">/</span> logout <span class="black">/</span></a>');

                }

                else
                {

                _e('<a href="'. get_option('siteurl') . '/wp-login.php" title="login"><span class="black">/</span> login <span class="black">/</span></a>');

                }
                ?>
                </nav>

			</div>

			</section>
			<?php wp_footer(); ?>
		</div><!--Wrap-->
	</body>

</html>