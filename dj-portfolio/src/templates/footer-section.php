
<div class="my-footer container-fluid mt-0">
<div class="row pt-4">
	<div class="col-lg-6">
			<div class="text-center text-lg-left ml-lg-5">
	                <p>&copy; <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?></p>
			</div>
	</div>
    <div class="col-lg-6">
			<div class="text-center text-lg-right mr-lg-5">
			    <?php
                    $email_address = get_option('email_address');
                    $facebook_url = get_option('facebook_url');
                    $x_url = get_option('x_url');
                    $instagram_url = get_option('instagram_url');
                    $youtube_url = get_option('youtube_url');
                ?>
				<!-- Social Links Section -->
				<div class="social-links mb-4">
                    <?php if ($email_address): ?>
                        <a href="mailto:<?php echo esc_attr($email_address); ?>" class="btn btn-outline-secondary mx-2" aria-label="Email">
                            <i class="fas fa-envelope"></i>
                        </a>
                    <?php endif; ?>
                    <?php if ($youtube_url): ?>
                        
                        <a href="<?php echo esc_url($youtube_url); ?>" target="_blank" class="btn btn-outline-secondary mx-2" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    <?php endif; ?>
                    <?php if ($x_url): ?>
                    <a href="<?php echo esc_url($x_url); ?>" target="_blank" class="btn btn-outline-secondary mx-2" aria-label="X (Twitter)">
                        <i class="fab fa-twitter"></i> 
                    </a>
                <?php endif; ?>
                <?php if ($instagram_url): ?>
                    <a href="<?php echo esc_url($instagram_url); ?>" target="_blank" class="btn btn-outline-secondary mx-2" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                <?php endif; ?>
                    <?php if ($facebook_url): ?>
                        <a href="<?php echo esc_url($facebook_url); ?>" target="_blank" class="btn btn-outline-secondary mx-2" aria-label="Facebook">
                            <i class="fab fa-facebook"></i>
                        </a>
                    <?php endif; ?>
                </div>
			</div>
	</div>
</div>
</div>
