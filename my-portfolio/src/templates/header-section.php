
<div class="my-header container-fluid">
<div class="row pt-2">
	<div class="col-lg-4 col-sm-4">
		<div class="logo text-center">
			<a href="/" title="<?php echo get_bloginfo('description'); ?>">
				<img src="<?php echo get_header_image(); ?>" alt="Peter Giammarco's Web Portfolio" style="max-width: 380px;width: 50%;"/>
			</a>
		</div>
	</div>
	<div class="col-lg-8 col-sm-8">
		<nav class="navbar navbar-expand-lg navbar-light">
				<button class="navbar-toggler" type="button" data-toggle="collapse" 
				data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
						<?php
						$main_menu = array(
									'theme_location' => 'main',
									'container' => false,
									'menu_id' => 'menu-main',
									'container_class' => 'navbar-nav ml-auto',
									'menu_class' => 'navbar-nav w-100 d-flex justify-content-start align-items-center',
									'depth' => 2,
									'fallback_cb' => '__return_false'
						);

						wp_nav_menu($main_menu);
						?>
				</div>
		</nav>
	</div>
</div>
</div>
<div class="my-header-triangle"></div>