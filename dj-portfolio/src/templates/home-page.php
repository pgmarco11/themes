<?php
if ( function_exists( 'get_field' ) ) :

    // ACF Fields Hero
    $background_id  = get_field( 'background_image' );
    $background_url = wp_get_attachment_url( $background_id, 'full' );
    $background_content_id  = get_field( 'content_background_image' );
    $background_content_url = wp_get_attachment_url( $background_content_id, 'medium' );
    $tagline     = get_field( 'tagline' );
    $button_link = get_field( 'button_link' );
    $button_text = get_field( 'button_text' );

    //ACF Fields About
    $about_image_id  = get_field( 'about_image' );
    $about_image_url = wp_get_attachment_url( $about_image_id, 'medium' );
    $button_1_title  = get_field( 'button_1_text' );
    $button_1_link  = get_field( 'button_1_link' );
    $button_2_title  = get_field( 'button_2_text' );
    $button_2_link  = get_field( 'button_2_link' );

    //ACF Fields Contact
    $contact  = get_field( 'contact_area' );

        if($background_content_url): ?> 
            <style>
            .hero-content::before {
                background-image: url('<?php echo esc_url( $background_content_url ); ?>');
            }
            </style> 
        <?php endif; ?>
            <section id="hero" class="hero-section text-center"
                <?php if($background_url): ?> 
                    style="background-image: url('<?php echo esc_url( $background_url ); ?>');"
                <?php endif; ?>
            >
                <div class="container">
                    <div class="hero-content">
                    <?php if ( $tagline && $button_link && $button_text ) : ?>
                        <?php if (!empty($tagline)) : ?>
                            <h1 class="hero-tagline"><?php echo htmlspecialchars_decode($tagline); ?></h1>
                        <?php endif; ?>
                        <a href="<?php echo esc_url( $button_link ); ?>" class="btn btn-md btn-link hero-cta">
                            <?php echo esc_html( $button_text ); ?> <i class="fas fa-angles-right"></i>
                        </a>
                    <?php endif; ?>
                    </div>
                </div>
            </section>
            <section id="About" class="about-section text-center">
                <div class="container">
                    <div class="row">

                    <div class="col-lg-5">
                        <div class="about-content">    
                            <h2>About</h2>
                            <h3 class="about-tagline">Listen to my mixes</h3>                    
                            <?php the_content(); ?>
                            <div class="btn-group">
                            <?php if (!empty($button_1_title) && !empty($button_1_link)) : ?>
                                <a href="<?= esc_url($button_1_link); ?>" target="_blank"><?= htmlspecialchars_decode($button_1_title); ?></a>
                            <?php endif; ?>

                            <?php if (!empty($button_2_title) && !empty($button_2_link)) : ?>
                                <a href="<?= esc_url($button_2_link); ?>" target="_blank"><?= htmlspecialchars_decode($button_2_title); ?></a>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="image">
                            <img src="<?php echo esc_url( $about_image_url ); ?>" alt="DJ Pete G" class="img-fluid" />
                        </div>                            
                    </div>

                    </div>
                </div>
            </section>
            <section id="Mixes" class="mixes-section text-center">
                    <?php get_template_part( 'src/templates/home-page', 'mixes' );   ?>
            </section>
            <section id="Contact" class="contact-section text-center container-fluid">
                <div class="container pt-5">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-md-9 col-lg-9">
                            <h2 class="mb-4">Contact</h2>
                            <?php if (!empty($contact)) : ?>
                                <div class="text-center">
                                    <?php echo apply_filters('the_content', $contact); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>


    <?php
else :
    echo '<p>Advanced Custom Fields plugin is not active.</p>';
endif;
?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";
    let page = 2;

    // Load More Button - AJAX
    let loadMoreButton = document.getElementById("load-more");
    if (loadMoreButton) {
        loadMoreButton.addEventListener("click", function () {
            let button = this;
            button.innerText = "Loading...";

            let request = new XMLHttpRequest();
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.onreadystatechange = function () {
                if (request.readyState === 4 && request.status === 200) {
                    let response = request.responseText;
                    if (response.trim()) {
                        document.getElementById("mixes-list").insertAdjacentHTML("beforeend", response);
                        button.innerText = "Load More";
                        page++;
                    } else {
                        button.style.display = "none"; // Hide button if no more mixes
                    }
                }
            };
            request.send("action=load_more_mixes&page=" + page);
        });
    }
});

// Scroll Effect for Hero Section
document.addEventListener("scroll", function () {
    let scrollPosition = window.scrollY;
    let heroSection = document.querySelector(".hero-section");
    if (heroSection) {
        heroSection.style.backgroundPositionX = `${scrollPosition * 0.5}px`;
    }
});
</script>