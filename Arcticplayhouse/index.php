<?php get_header(); ?>

<section id="wrapper" class="m5left m5right">

	<div id="index-row1" class="widthfull">

			<div class="slider-wrapper alignleft">
				<div id="slider" class="nivoslider">
					<a href="" ></a>
				</div>
			</div>
						
			<?php get_sidebar( 'frontpage-widgets' ); ?>			
			
	</div>

	<article>
				<div id="index-cols" class="width100">
					
					<?php get_sidebar( 'front-widgets' ); ?>

				</div>
	</article>


</section>

<?php get_footer(); ?>