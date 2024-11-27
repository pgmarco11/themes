<?php 
$upcoming_events_query = array(
    'post_type'      => 'shows',
    'posts_per_page' => 8,
    'orderby'        => 'date',
    'order'          => 'ASC',
    'tax_query'      => array(
        array(
            'taxonomy' => 'show-type',
            'field'    => 'slug',
            'terms'    => array('events')
        )
    )
);
$upcoming_events = get_posts($upcoming_events_query);

foreach ($upcoming_events as $post) : setup_postdata($post);

$custom = get_post_custom($post->ID);
$writer = isset($custom["writer"][0]) ? $custom["writer"][0] : '';
$director = isset($custom["director"][0]) ? $custom["director"][0] : '';
$address = isset($custom["address"][0]) ? $custom["address"][0] : '';
$city = isset($custom["city"][0]) ? $custom["city"][0] : '';
$state = isset($custom["state"][0]) ? $custom["state"][0] : '';
$dates = $custom["month"][0] . " " . $custom["dates"][0] . ", " . $custom["year"][0];
$dates2 = ($custom["month2"][0] && $custom["dates2"][0] && $custom["year2"][0]) ? $custom["month2"][0] . " " . $custom["dates2"][0] . ", " . $custom["year2"][0] : null;
$time = $custom["time"][0] . " " . $custom["ampm"][0];
$info = isset($custom["info"][0]) ? $custom["info"][0] : '';
$ticket = isset($custom["ticket"][0]) ? $custom["ticket"][0] : '';
$price = isset($custom["price"][0]) ? $custom["price"][0] : '';
?>

<article class="mb-5">
    <div class="show-info row">

        <div class="col-lg-4 pl-0">
            <?php print get_the_post_thumbnail($post->ID, 'shows-image', array('class' => 'd-flex justify-content-center mx-auto mb-4')); ?>       
        </div>


        <div class="col-lg-8 pl-5 pr-5">
                <h3 class="widgettitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php if($writer): ?>
                    <p class="pb-0 mb-0">Written by: <?php echo $writer; ?> </p>
                <?php endif; ?>
                <?php if($director): ?>
                    <p class="pb-0">Directed by: <?php echo $director; ?></p>
                <?php endif; ?>
                <p class="address">
                    <?php if($address): ?>
                        <?php echo $address; ?>
                    <?php endif; ?>
                    <?php if($city): ?>
                        <?php echo $city; ?>
                    <?php endif; ?>
                    <?php if($city && $state): ?>
                        <?php echo "," . $state . "<br><br>"; ?>
                    <?php endif; ?>
                    <?php echo $dates; ?>
                    <?php if($dates2): ?>
                        <?php echo '<br />' . $dates2; ?>
                    <?php endif; ?>
                    <br />
                    <?php echo $time; ?>
                    <br />										
                </p><br />	
                <?php if ($ticket): ?>
                    <p class="pb-0">Price: <?php echo $price ?></p>
                    <a class="btn tickets" href="<?php echo $ticket ?>" target="_blank" title="buy tickets">Buy Tickets</a>
                <?php endif; ?>									
                <?php if($info): ?>
                    <?php echo $info . "<br />"; ?>
                <?php endif; ?>
                <div class="textwidget mt-4"><?php the_excerpt(); ?></div>
        </div>
                        
    </div>
</article>
<?php 
endforeach; 
wp_reset_postdata(); 
if($upcoming_events == null) {
?>							
	<div id="event-post-none"  class="w-100 d-flex justify-content-center">
			<p>There are no upcoming events. Please check back soon.</p>
	</div>
<?php } ?>
