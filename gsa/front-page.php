<?php
/** 
 *  Main Template File
 *
**/

get_header();

if( is_front_page() ):

?>
  <!-- Header -->
  <header class="bg-white mb-5">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <?php

        echo do_shortcode("[qcld_hero id=2]");

       ?>
      </div>
    </div>
  </header>

  <!-- Home Page Content -->
  <div class="container">

  <section id="welcome-home" class="text-center">

      <div class="row">     

        <div class="content">

           <div class="welcome mb-5">
                
                <h1 class="text-center"><?php the_title(); ?></h1>
                <?php 
                while ( have_posts() ): the_post();

                          the_content();

                endwhile;         

                $button_text = get_post_meta($post->ID, 'buttonText', true);
                $page = get_post_meta( $post->ID, 'link_button', true ); 

                if(!empty($button_text)):
                ?>

                <a class="pagemore text-center rounded-lg" href="<?php echo get_permalink($page); ?>"><?php echo esc_attr_e($button_text); ?></a>

              <?php endif; ?>
        
          </div>
        
        </div>

      </div>

    </section>
    <!-- /.row -->
    <section id="pages-home">
      <div class="row"> 

        <?php 

        $sidebar_title = get_post_meta($post->ID, 'sidebarTitle', true);

        ?>   

        <h2><?php echo esc_attr_e($sidebar_title); ?></h2>

        <?php

        for($boxes=1;$boxes<4;$boxes++){  

      $title = "title_" . $boxes;
      $image = "image_" . $boxes;
      $link_text = "link_text_" . $boxes;
      $page_id = "page_id_" . $boxes;
      $description = "description_" . $boxes;
      $image_id = "image_id_" . $boxes;
      $file = "file_" . $boxes;
      $file_id = "file_id_" . $boxes;

      $title_[$boxes] = get_post_meta($post->ID, $title, true);
      $image_[$boxes] = get_post_meta($post->ID, $image, true);
      $link_text_[$boxes] = get_post_meta($post->ID, $link_text, true);
      $page_id_[$boxes] = get_post_meta($post->ID, $page_id, true);
      $description_[$boxes] = get_post_meta($post->ID, $description, true);
      $image_id_[$boxes] = get_post_meta($post->ID, $image_id, true);
      $file_[$boxes] = get_post_meta($post->ID, $file, true);
      $file_id_[$boxes] = get_post_meta($post->ID, $file_id, true);

        ?>
        <div id="front_box_<?php $boxes ?>" class="col-md-4 mb-5 widget home-widget">
          <div class="card h-100">
            <div class="box-widget">

                <div class="thumbbx">

                <a href="<?php 

                if( !empty( $page_id_[$boxes] ) ) { 

                  echo get_permalink($page_id_[$boxes]); 

                } else if( !empty( $file_[$boxes] ) )  {

                  echo esc_attr_e($file_[$boxes]);

                } else {

                  _e('#');

                }

                ?>">

                <?php 
                echo wp_get_attachment_image($image_id_[$boxes], 'widget-image'); 

                ?>
                  
                </a>
                </div>

                  <div class="col-sm-12 widget-content">

                    <h3 class="title-medium title-shadow-a mb10">
                    <a href="<?php 

                    if( !empty( $page_id_[$boxes] ) ) { 

                        echo get_permalink($page_id_[$boxes]); 

                      } else if( !empty( $file_[$boxes] ) )  {

                        echo esc_attr_e($file_[$boxes]);

                      } else {

                        _e('#');

                    }

                    ?>">
                    <?php if( !empty( $title_[$boxes] ) ) { echo esc_attr_e($title_[$boxes]); } else { echo $title_[$boxes]; }  ?>                          
                    </a>
                    </h3>

                    <p>
                    <?php 
                    if( !empty( $description_[$boxes] ) ):
                          echo esc_attr_e( $description_[$boxes] ); 
                    elseif(empty( $description_[$boxes] ) && !empty($file_id_[$boxes])):
                          $attachment = get_post( $file_id_[$boxes] );
                          $description = $attachment->post_content;
                          echo $description;
                    elseif(empty( $description_[$boxes] ) && !empty($page_id_[$boxes])):
                        echo get_the_excerpt($page_id_[$boxes]);
                    else:
                       echo "";
                    endif;


                     ?>
                    </p>

                    <?php 

                    if( !empty( $link_text_[$boxes] ) ) { ?>

                    <a class="pagemore rounded-lg" target="_blank" href="<?php

                    if( !empty( $page_id_[$boxes] ) ) { 

                        echo get_permalink($page_id_[$boxes]); 

                      } else if( !empty( $file_[$boxes] ) )  {

                        echo esc_attr_e($file_[$boxes]);

                      } else {

                        _e('#');

                    }
                    
                    ?>"><?php
                    
                    echo esc_attr_e($link_text_[$boxes]);

                    ?></a>

                    <?php } ?>

                  </div>

              </div>

          </div>

        </div>

       <?php } ?>

        <!--get_sidebar('home-main'); -->      

      </div>
      <!-- /.row -->
    </section>

    
  </div>
  <!-- /.container -->

  <?php endif; ?>

<?php

	get_footer();
	 
?>