<?php 
$events= array(
        'post_type' => 'shows',
        'posts_per_page' => 2,
        'orderby' => 'date',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'show-type',
                'field' => 'slug',
                'terms' => array('events', 'arctic-monthly')
                )
            )
        );
    
$upcomingEvents= get_posts($events);

foreach ($upcomingEvents as $post) : setup_postdata($post); ?>

<?php	
                    $custom = get_post_custom($post->ID);
                    $ticket = $custom["ticket"][0];
                    $price = $custom["price"][0];
                    $time= $custom["time"][0] . " " . $custom["ampm"][0];
        ?>

            <article id="event-<?php the_ID(); ?>" <?php post_class('pb-4'); ?>>

                <div class="event-post w-100">

                    <div class="event-data row">

                        <div class="event-title order-1 col-lg-12 col-md-12 col-sm-12">
                            <h3 class="pb-2">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php the_title(); ?>
                                </a>
                            </h3>
                        </div>

                        <div class="thumbnail order-2 col-lg-2 col-md-3 col-sm-6">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('home-events-image'); ?>
                            </a>
                        </div>

                        <div class="event-date order-3 col-lg-2 col-md-3 col-sm-6">
                            <ul>
                                <li class="month">
                                    <?php echo $custom["month"][0]; ?>
                                </li>
                                <li class="day">
                                    <?php echo $custom["dates"][0]; ?>
                                </li>
                                <li class="year">
                                    <?php echo $custom["year"][0]; ?>
                                </li>
                                <li class="event-time">
                                    <?php echo "@ " . $time; ?>
                                </li>
                            </ul>
                        </div>

                        <div class="purchase order-4 col-lg-2 col-md-3 col-sm-6">
                            <div class="price" style="width: 140px;">
                                <?php 
                                $price = str_replace('/', '', $price);
                                    if ($price) { ?>
                                    <p>
                                        <?php echo $price; ?>
                                    </p>
                                <?php } ?>
                            </div>
                            <div class="ticket">
                                <?php if ($ticket) { ?>
                                    <?php echo '<a class="tickets btn" href="' . $ticket . '" target="_blank" title="buy tickets">Buy Tickets</a><br/>'; ?>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="info order-5 col-lg-6 col-md-12 col-sm-12">
                            <?php the_excerpt(); ?>
                            <a href="<?php the_permalink(); ?>" class="more">MORE INFO</a>
                        </div>
                    </div>                  

                </div>
            </article>


        <?php endforeach;
        wp_reset_postdata();
        if($upcomingEvents == null) {

        ?>

        <div id="event-post-none" class="col-12 justify-content-center">
            <div class="w-100">
                <div class="justify-content-center mx-auto">
                    <p>There are no upcoming events. Please check back soon.</p>
                </div>
            </div>
        </div>

        <?php 
        } 
                    $pageID = 1032;
                    $page = get_post($pageID);

                    $events_page = new WP_Query(array(
                        'post_type' => 'page',
                        'post_status' => 'publish',
                        'name' => 'shows-events'
                    ));
                    
                    if ($events_page->have_posts()) :
                        $events_page->the_post();
                        $events_page_url = get_permalink();
                    ?>
                    <a href="<?php echo esc_url($events_page_url); ?>#events" title="<?php echo esc_attr(get_the_title()); ?>" class="btn thecategory">
                    Go To Events</a>
<?php
                    wp_reset_postdata();

                    else :                        
                        echo 'Page not found';
                    endif;
?>