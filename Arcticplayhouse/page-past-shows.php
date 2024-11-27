<?php 
/* Template Name: Past Shows */
get_header(); 
?>
<section id="shows-wrapper" class="container">
		<header class="row mx-2">
			<nav class="breadcrumb">
				<?php if( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
			</nav>
		</header>
		<div class="shows-wrap widthfull mx-2">		
			<h1 class="mx-auto">
				<?php the_title(); ?>
			</h1>
			<div class="row">
				<div class="w-100">
					<?php
					$main_menu = array(
						'theme_location' => 'shows',
						'container' => 'nav',
						'menu_id' => 'shows-menu',
						'container_class' => 'menu-shows-container navbar navbar-expand-lg navbar-dark',
						'menu_class' => 'navbar-nav w-100',
						'depth' => 0
					);
					wp_nav_menu($main_menu);
				?>
				</div>
			</div>
				<div class="row mx-auto">
					<div class="w-100 pastshows">
						<div class="d-flex w-100 align-items-center justify-content-center mt-4 mb-5">	
								<img src="<?php echo get_template_directory_uri() ?>/images/left-new.svg" title="Arctic playhouse upcoming shows"
								class="mr-2 left-img" />
									<h2 class="my-4 text-center">Past Shows</h2>
								<img src="<?php echo get_template_directory_uri() ?>/images/right-new.svg" title="Arctic playhouse upcoming shows"
								class="ml-2 right-img" />
						</div>						

						<?php get_template_part('/inner/past-shows-page'); ?>	

					</div>
				</div>
		</div>
</section>
<?php get_footer(); ?>