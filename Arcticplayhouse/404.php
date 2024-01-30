<?php get_header(); ?>

<section id="single-wrapper" class="m5left m5right">
		<header>
			<nav class="breadcrumb">
				<?php if( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
			</nav>
		</header>

	<div id="single-row1" class="widthfull alignleft">

		<div id="heading">
			<h1>404 Error - Lost?</h1>
		</div>

		<div id="single-col1">
			<article>
											
				<div class="content alignleft width55">
				    <p>Sorry, maybe it was our fault. Click an item in the main menu above. Thank You</p><br />
			
					<form role="search" method="get" id="search404" action="<?php bloginfo('url'); ?>" class="searchform" >
						<input type="text" placeholder="Search" name="s" id="s" class="opacity25" />
						<input type="submit" id="submit" value="" name="submit" class="alignleft" />
					</form>							
				</div>


			</article>
						
		</div>


	</div>


</section>

<?php get_footer(); ?>