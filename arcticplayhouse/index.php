<?php get_header(); ?>

<section id="featured-show" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <?php
            $args = array(
                'post_type' => 'shows',
                'posts_per_page' => 1,
                'orderby' => 'date',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'show-type',
                        'field' => 'slug',
                        'terms' => 'now-playing'
                    )
                )
            );
            $featured_show = new WP_Query($args);
            ?>
            <?php if ($featured_show->have_posts()) : while ($featured_show->have_posts()) : $featured_show->the_post(); ?>
                <div class="featured-show-content">
                    <h2><?php the_title(); ?></h2>
                    <div class="show-meta">
                        <?php $writer = get_post_meta(get_the_ID(), 'writer', true);
                        if (!empty($writer)) : ?>
                            <p>Written by <?php echo $writer; ?></p>
                        <?php endif; ?>
                        <?php $director = get_post_meta(get_the_ID(), 'director', true);
                        if (!empty($director)) : ?>
                            <p>Directed by <?php echo $director; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="show-info">
                        <?php the_content(); ?>
                    </div>
                    <?php $ticket = get_post_meta(get_the_ID(), 'ticket', true);
                    if (!empty($ticket)) : ?>
                        <a class="btn btn-secondary" href="<?php echo esc_url($ticket); ?>" target="_blank" title="Buy Tickets">Buy Tickets</a>
                    <?php endif; ?>
                </div>
            <?php endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>

<section id="upcoming-events" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2>Upcoming Events</h2>
            <?php get_template_part('inner/upcoming-events-home'); ?>
        </div>
    </div>
</section>

<?php if ( is_active_sidebar( 'supporters-widget' ) ) : ?>
    <section id="supporters" class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>Supporters</h2>
                <?php get_template_part('widgets/supporters-widget'); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>