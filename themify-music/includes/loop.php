<?php
/**
 * Template for generic post display.
 * @package themify
 * @since 1.0.0
 */
?>
<?php if(!is_single()){ global $more; $more = 0; } //enable more link ?>

<?php
/** Themify Default Variables
 *  @var object */
global $themify; ?>

<?php themify_post_before(); // hook ?>
<article id="post-<?php the_id(); ?>" <?php post_class( 'post clearfix' ); ?>>
	<?php themify_post_start(); // hook ?>

	<?php if( 'below' != $themify->media_position ) get_template_part( 'includes/post-media', 'loop'); ?>

	<?php if ( $themify->hide_meta != 'yes' || $themify->hide_date != 'yes' ) : ?>
		<div class="post-meta entry-meta clearfix">
			<?php if ( $themify->hide_date != 'yes' ): ?>
				<time class="post-date entry-date updated" datetime="<?php the_time( 'o-m-d' ) ?>">
					<span class="day"><?php the_time( 'j' ); ?></span>
					<span class="month"><?php the_time( 'M' ); ?></span>
					<span class="year"><?php the_time( 'Y' ); ?></span>
				</time>
			<?php endif; //post date ?>

			<?php if ( $themify->hide_meta != 'yes' ): ?>
				<?php if ( $themify->hide_meta_category != 'yes' ): ?>
					<?php the_terms( get_the_id(), 'category', ' <span class="post-category">', ', ', '</span>' ); ?>
				<?php endif; // meta category ?>

				<?php if ( $themify->hide_meta_tag != 'yes' ): ?>
					<?php the_terms( get_the_id(),'post_tag', ' <span class="post-tag">', ', ', '</span>' ); ?>
				<?php endif; // meta tag ?>

				<?php if ( ! themify_get( 'setting-comments_posts' ) && comments_open() && $themify->hide_meta_comment != 'yes' ) : ?>
					<span class="post-comment"><?php comments_popup_link( '0', '1', '%' ); ?></span>
				<?php endif; // meta comments ?>
			<?php endif; //post meta ?>

			<?php get_template_part( 'includes/social-share' ); ?>
		</div>
		<!-- /post-meta -->
	<?php endif; //post meta ?>

	<div class="post-content">
		<?php if($themify->hide_title != 'yes'): ?>
			<?php themify_post_title(); ?>
		<?php endif; //post title ?>

		<?php if ( $themify->hide_meta != 'yes' && $themify->hide_meta_author != 'yes' ): ?>
			<div class="post-author-wrapper">
				<span class="author-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), $themify->avatar_size_loop, '' ); ?></span>
				<span class="post-author"><?php echo themify_get_author_link() ?></span>
			</div><!-- /.post-author-wrapper -->
		<?php endif; ?>

		<?php if( 'below' == $themify->media_position ) get_template_part( 'includes/post-media', 'loop'); ?>

		<div class="entry-content">

			<?php if ( 'excerpt' == $themify->display_content && ! is_attachment() ) : ?>

				<?php the_excerpt(); ?>

				<?php if( themify_check('setting-excerpt_more') ) : ?>

					<p><a href="<?php the_permalink(); ?>" class="more-link"><?php echo themify_check('setting-default_more_text')? themify_get('setting-default_more_text') : __('More &rarr;', 'themify') ?></a></p>

				<?php endif; ?>

			<?php elseif($themify->display_content == 'none'): ?>

			<?php else: ?>

				<?php the_content(themify_check('setting-default_more_text')? themify_get('setting-default_more_text') : __('More &rarr;', 'themify')); ?>

			<?php endif; //display content ?>

		</div><!-- /.entry-content -->

		<?php edit_post_link(__('Edit', 'themify'), '<span class="edit-button">[', ']</span>'); ?>

	</div>
	<!-- /.post-content -->
	<?php themify_post_end(); // hook ?>

</article>
<!-- /.post -->
<?php themify_post_after(); // hook ?>
