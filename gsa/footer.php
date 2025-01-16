  <!-- Footer -->
  <footer id="footer">
		   <div class="footer-top">
		   		<div class="container">
				   <div class="row">
				  	<?php get_sidebar('footer'); ?>
				    <!-- /.container -->
				   </div>
			  	</div>
		   </div>

		    <div class="footer-bottom">
		    	<div class="container">
				<?php 
		            $footer_menu = array( 
		              'theme_location' => 'footer-menu',
		              'container'       => 'div',
		              'menu_class'      => 'navbar-nav ml-auto',
		              'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
		              'walker'          => new WP_Bootstrap_Navwalker(),
		              ); 
		            if(has_nav_menu('footer-menu')){
		              wp_nav_menu( $footer_menu );
		            } 
		        ?>

		        <?php $footer_copyright = get_option('footer_copyright_option');

		        if( !empty($footer_copyright) ):
		        ?>				
				<p class="copyright text-center"><?php echo "©" . "" . date('Y') . " " . sprintf($footer_copyright) ?></p>
				<?php endif; ?>
        		</div>
		    </div>
  </footer>

<?php wp_footer(); ?>
</body>

</html>