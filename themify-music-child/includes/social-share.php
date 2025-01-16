<?php
/**
 * Template to display social share buttons.
 * @since 1.0.0
 */

if ( Themify_Social_Share::is_enabled( 'single' ) || Themify_Social_Share::is_enabled( 'archive' ) ) :
?>
<?php $networks = Themify_Social_Share::get_active_networks();?>
<?php if(!empty($networks)):?>

<div class="post-share clearfix">

<div class="share share-icon"><button>Share</button></div>

	<div class="<?php echo esc_attr( 'social-share msss' . get_the_ID() ); ?>">
		<ul>
				<?php foreach($networks as $k=>$n):?>
						<li>
							<div class="<?php echo strtolower($k)?>-share">
								<a title="<?php esc_attr_e($n)?>" rel="nofollow" href="<?php echo Themify_Social_Share::get_network_url($k)?>" class="share"></a>
							</div>
						</li>
				<?php endforeach;?>
				
		</ul>			
	</div>	
</div>

<?php endif;?>

<!-- .post-share -->

<?php endif; // social share enabled in archive or single ?>