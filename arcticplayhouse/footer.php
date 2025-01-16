			</div> <!--Featured-->
		</div> <!--Content-->

		<section id="footer" class="w-100 border-slick">

			<div class="d-flex justify-content-start">
				<div class="pt-4 pb-5 w-100 m5left m5right">
					<div class="row row1">
								<div class="widget widget_menu">
									<!-- Your menu content here -->
									<?php								
										$main_menu = array(
										'theme_location' => 'footer',
										'container' => 'nav',
										'container_class' => 'clearfix',
										'menu_class' => 'd-flex justify-content-start',
										'menu_id' => 'footer-nav',
										'depth' => 0
										); 

										wp_nav_menu( $main_menu ); 
									?>
								</div>
						</div>
						<div class="row row2">						
							<div class="col-12 col-md-auto">
								<div class="widget widget_social">
									<?php get_template_part('inner/social-links-footer'); ?>
								</div>
								<div class="widget footer-widget mb-4">
									<?php get_search_form(); ?>
								</div>
							</div>
							<?php 
							if ( is_active_sidebar( 'footer-nav-widgets' ) ): ?>	
								<div class="col-12 col-md-auto ml-auto">
									<div class="widget footer-widget">
										<?php get_template_part('widgets/footer-nav-widgets' ); ?>	
									</div>
								</div>
							<?php endif; 
							if ( is_active_sidebar( 'contactus-widget' ) ): ?>	
								<div class="col-12 col-md-auto ml-auto">
									<div class="widget card contactus-widget">
										<?php get_template_part( 'widgets/contactus-widget' ); ?>
									</div>
								</div>
							<?php endif; ?>
						</div>
				</div>
			</div>

			<div class="row row3 d-flex justify-content-start copyright pt-3 pb-0">
				<div class="col-12">
					<ul class="list-inline text-center">						
						<li class="list-inline-item">
							&#169; <?php echo date("Y"); ?><?php echo "&nbsp;&nbsp;" . get_bloginfo('name') . "&nbsp;"; ?>
						</li>
					</ul>
				</div>
			</div>

		</section>


			<?php wp_footer(); ?>
		</div><!--Wrap-->
	</body>

</html>