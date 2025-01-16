<?php 
get_header(); 

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<style>
#shows-col1 .menu-item-type-custom { height: 33px !important; margin-bottom: 0 !important; }
@media (max-width: 630px) { #shows-col1 .menu-item-type-custom { background-color: #6b8e23 !important; } }
</style>

<section id="shows-wrapper" class="m5left m5right">

		<header>
			<nav class="breadcrumb">
				<?php if( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
			</nav>
		</header>

	<div id="shows-row1" class="widthfull d-flex justify-content-start">

			<h1>Events</h1>

					<?php
			
					 $main_menu = array(
					'theme_location' => 'shows',
					'container' => 'nav',
					'container_class' => 'd-flex justify-content-start w-100',
					'menu_id' => 'shows-col1',
					'depth' => 0
					); 

					wp_nav_menu( $main_menu ); ?>


		<div id="shows-col2">


			<?php do_action( 'tribe_events_before_template' ); ?>

				<!-- Tribe Bar -->
			<?php tribe_get_template_part( 'modules/bar' ); ?>

				<!-- Main Events Content -->
			<?php tribe_get_template_part( 'list/content' ); ?>

				<div class="tribe-clear"></div>

			<?php do_action( 'tribe_events_after_template' ); ?>						


			</div>

		</div>

	</div>

	</div>


</section>
<?php get_footer(); ?>

