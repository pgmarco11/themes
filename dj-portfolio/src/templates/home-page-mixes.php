<h2>Mixes</h2>
<div class="container">
    <div class="row" id="mixes-list">
        <?php
            $displayed_posts = []; 

            $args = array(
                'post_type'      => 'mixes',
                'posts_per_page' => 4,
                'orderby'        => 'date',
                'order'          => 'ASC'
            );

            $mixes_query = new WP_Query($args);

            if ($mixes_query->have_posts()):

                $genres = [];

                // Collect all the genres first
                while ($mixes_query->have_posts()): $mixes_query->the_post();
                    $displayed_posts[] = get_the_ID(); // Store post ID

                    $genre_terms = get_the_terms(get_the_ID(), 'mix_genre');
                    if ($genre_terms) {
                        foreach ($genre_terms as $genre) {
                            if ($genre->parent == 0) {
                                // Save parent genres with corresponding mixes
                                $genres[$genre->name][] = get_the_ID();
                            }
                        }
                    }
                endwhile;

                wp_reset_postdata();
                
                // Encode displayed posts to pass to JavaScript
                $displayed_posts_json = json_encode($displayed_posts);

                // Now display each parent genre with its mixes
                foreach ($genres as $parent_genre => $mix_ids):
        ?>
                    <div class="col-12">
                        <h3 class="text-center"><?php echo esc_html($parent_genre); ?></h3>
                        <div class="row">
                            <?php foreach ($mix_ids as $mix_id): 
                                $post = get_post($mix_id);
                                setup_postdata($post);
                                $soundcloud_url = get_field('soundcloud_url');
                                $sub_genre = '';
                                $mix_type = get_the_terms(get_the_ID(), 'mix_type');

                                // Get sub-genres
                                $sub_genre_terms = get_the_terms(get_the_ID(), 'mix_genre');
                                foreach ($sub_genre_terms as $genre) {
                                    if ($genre->parent != 0) {
                                        $sub_genre = $genre->name;
                                    }
                                }

                                if ($mix_type) {
                                    $mix_type_names = array_map(function($type) {
                                        return esc_html($type->name);
                                    }, $mix_type);
                                }
                            ?>
                            <div class="w-100 mix-item" data-post-id="<?php echo get_the_ID(); ?>">
                                <div class="mix-card">
                                    <div class="row" style="width: 100%; display: flex; align-items: center;"> 
                                        <div class="col-4">
                                            <?php if (has_post_thumbnail()): ?>
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('medium', ['class' => 'img-fluid']); ?>
                                                </a>
                                            <?php endif; ?>  
                                        </div>                                                    
                                        <div class="col-8">
                                            <div class="mix-content text-left mb-1">
                                                <h4><?php the_title(); ?></h4>
                                                <div class="d-inline position-relative w-100">
                                                    <?php if ($sub_genre): ?>
                                                        <strong>Genre:</strong> <?php echo esc_html($sub_genre) . '&nbsp;&nbsp;'; ?>
                                                    <?php endif; ?>
                                                    <?php if ($mix_type): ?>
                                                        <strong>Mix Type:</strong> <?php echo implode(' + ', $mix_type_names); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php if ($soundcloud_url): ?>
                                                <div class="mix-player">
                                                    <iframe id="soundcloud-widget" width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" show_related=false
                                                        src="https://w.soundcloud.com/player/?url=<?php echo urlencode($soundcloud_url); ?>&auto_play=false&show_artwork=false"></iframe>
                                                </div>
                                            <?php endif; ?>
                                        </div>                                                    
                                    </div>
                                </div>   
                            </div>
                            <?php endforeach; ?>
                        </div> 
                    </div> 
        <?php endforeach; ?>
        <?php else: ?>
            <p>No mixes found.</p>
        <?php endif; ?>
    </div>

    <button id="load-more" class="btn btn-primary mt-4" data-posts='<?php echo esc_attr($displayed_posts_json); ?>'>Load More</button>
</div>
