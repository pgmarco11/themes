<?php
/**
 * Post Media Template.
 * If there's a Video URL in Themify Custom Panel it will show it, otherwise shows the featured image.
 * @package themify
 * @since 1.0.0
 */

/** Themify Default Variables
 *  @var object */
global $themify; ?>

<?php if ( $themify->hide_image != 'yes' ) : ?>
	<?php themify_before_post_image(); // Hook ?>

	<?php
	if ( themify_has_post_video() ) : ?>

		<figure class="post-image clearfix">
			<?php echo themify_post_video(); ?>
		</figure>

	<?php else: ?>

		<?php if( $post_image = themify_get_image( $themify->auto_featured_image . $themify->image_setting . 'w=' . $themify->width . '&h=' . $themify->height ) ) : ?>

			<figure class="post-image <?php echo $themify->image_align; ?> clearfix">

				<?php 
				
				if($post_image){
					preg_match('/<img.*?src=["\'](.*?)["\'].*?>/i', $post_image, $matches);					
					$url = $matches[1];	
				}	

				$category_id = get_the_ID();	
				$catgeory = get_the_category($category_id);
				$category_name = $catgeory[0]->name;
				$image_url = get_the_post_thumbnail_url();
		
				?>

				<?php if( 'yes' == $themify->unlink_image): 					
				?>
					<?php echo $post_image; ?>
				<?php else: ?>
					<?php if( is_category() === false ) { 						
					?>						
						<a href="<?php echo themify_get_featured_image_link(); ?>">
							<div style="background-image:url('<?= $url ?>');
									width: <?= $themify->width ?>px;
									height: <?= $themify->height ?>px;
									background-position: center center;
									margin: 10px auto;">
								<?php themify_zoom_icon(); ?>
							</div>
						</a>
						<?php } else { 						
						?>					
							<a href="<?php echo themify_get_featured_image_link(); ?>">
							<img src="<?= $image_url ?>" alt="<?= the_title(); ?>" />	
							<?php themify_zoom_icon(); ?>
							</a>
						<?php
							}
				endif; // unlink image
				?>

			</figure>

		<?php endif; // if there's a featured image?>

	<?php endif; // video else image ?>

	<?php themify_after_post_image(); // Hook ?>
<?php endif; // hide image ?>
