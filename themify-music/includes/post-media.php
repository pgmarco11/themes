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

				<?php if( 'yes' == $themify->unlink_image): ?>
					<?php echo $post_image; ?>
				<?php else: ?>
					<a href="<?php echo themify_get_featured_image_link(); ?>"><?php echo $post_image; ?><?php themify_zoom_icon(); ?></a>
				<?php endif; // unlink image ?>

			</figure>

		<?php endif; // if there's a featured image?>

	<?php endif; // video else image ?>

	<?php themify_after_post_image(); // Hook ?>
<?php endif; // hide image ?>
