<?php
/** 
 *  Main Template File
 *
**/

get_header();

?>
  
    <!-- Page Content -->
    <div class="innerbanner">           
          <?php

          $image_header_id = get_option('image_id_header_option');

          if( has_post_thumbnail($post->ID)) {
              echo get_the_post_thumbnail($post->ID);
          } else if( !empty($image_header_id) ){
             echo wp_get_attachment_image($image_header_id, 'large'); 
          } else {
            _e('<div id="noimage"></div>');
          }

          ?>
    </div>
    <div class="container content">
        <div class="middle-align content_sidebar">
            <div class="site-main" id="sitemain">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                          <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>

                    <div class="entry-content">

                        <?php while ( have_posts() ): the_post();

                                the_content();

                              endwhile;   
                        ?>

                    </div>

                </article>  

              </div>            
    
              <?php 

              get_sidebar('default'); ?>  
      
              <div class="clear"></div>
   
        </div>       

    </div>
    <!-- /.container -->

<?php

	get_footer();
	 
?>