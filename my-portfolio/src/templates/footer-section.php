
<div class="my-footer-triangle"></div>
<div class="my-footer container-fluid mt-0">
<div class="row pt-4">
	<div class="col-lg-12">
			<div class="text-center mx-auto">
			<?php
                    $email_address = get_option('email_address');
                    $linkedin_url = get_option('linkedin_url');
                    $github_url = get_option('github_url');
                    $twitter_url = get_option('twitter_url');
                    $facebook_url = get_option('facebook_url');
                ?>

				<!-- Social Links Section -->
				<div class="social-links mb-4">
                <?php if ($email_address): ?>
                    <a href="mailto:<?php echo esc_attr($email_address); ?>" class="btn btn-outline-secondary mx-2" aria-label="Email">
                        <i class="fas fa-envelope"></i>
                    </a>
                <?php endif; ?>
                <?php if ($linkedin_url): ?>
                    <a href="<?php echo esc_url($linkedin_url); ?>" target="_blank" class="btn btn-outline-secondary mx-2" aria-label="LinkedIn">
                        <i class="fab fa-linkedin"></i>
                    </a>
                <?php endif; ?>
                <?php if ($github_url): ?>
                    <a href="<?php echo esc_url($github_url); ?>" target="_blank" class="btn btn-outline-secondary mx-2" aria-label="GitHub">
                        <i class="fab fa-github"></i>
                    </a>
                <?php endif; ?>
                <?php if ($twitter_url): ?>
                    <a href="<?php echo esc_url($twitter_url); ?>" target="_blank" class="btn btn-outline-secondary mx-2" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                <?php endif; ?>
                <?php if ($facebook_url): ?>
                    <a href="<?php echo esc_url($facebook_url); ?>" target="_blank" class="btn btn-outline-secondary mx-2" aria-label="Facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                <?php endif; ?>
            </div>

                <p>&copy; <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?></p>

			</div>
	</div>
</div>
</div>
