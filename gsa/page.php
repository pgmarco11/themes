<?php
/** 
 *  Main Template File
 *
**/

get_header();

$gsaStaffargs = array(
          'post_type' => 'contacts',
          'posts_per_page' => -1,
          'orderby' => array('menu_order', 'title'),
          'order' => 'ASC',
          'post_status' => 'publish'
);

$gsaStaff = get_posts($gsaStaffargs);


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

                    if( is_page( 99, 'gsa-staff') ):                        

                          foreach($gsaStaff as $post) : setup_postdata($post);

                          $output = get_post_custom($post->ID);
                          $imageid = $output["image_id"][0];
                          $worktitle = $output["work-title"][0];
                          $workphone = $output["work-phone"][0];
                          $mobilephone = $output["mobile-phone"][0];
                          $email = $output["email"][0];
                          $description = nl2br($output["description"][0]);

                          ?>
                          <div class="staff-entry">                          
                          
                          <?php 
                          if( !empty($imageid) ):
                              echo wp_get_attachment_image($imageid, 'thumbnail'); 
                          else:
                          ?>
                              <div class="noimage"></div>
                          <?php
                          endif;
                          ?>
                            <div class="staff-entry-content">
                                <h4><?php the_title(); ?></h4>
                                <h6><?php echo esc_attr_e($worktitle); ?></h6>
                                <ul>
                                <?php if ( !empty($workphone) ): ?>
                                <li><span class="font-weight-bold">Work Phone: </span><?php echo esc_attr_e($workphone); ?></li>
                                <?php endif; ?>
                                <?php if ( !empty($mobilephone) ): ?>
                                <li><span class="font-weight-bold">Mobile Phone: </span><?php echo esc_attr_e($mobilephone); ?></li>
                                <?php endif; ?>
                                <?php if ( !empty($email) ): ?>
                                <li><span class="font-weight-bold">Email: </span><a href="mailto:<?php echo esc_attr_e($email); ?>" title="<?php the_title(); ?>"><?php echo esc_attr_e($email); ?></a></li>
                                <?php endif; ?>
                                </ul> 
                                <?php edit_post_link(); ?>
                            </div>
                            <?php if ( !empty($description) ): ?>
                                <p><?php echo esc_attr_e($description); ?></p>
                            <?php endif; ?>
                          
                          </div>
                    <?php

                          endforeach; 
                          wp_reset_postdata(); 

                    endif; 

                    ?>

                    </div>

                </article>  

              </div>

              <?php 

              if( is_page( 12, 'contact-us') ):

                get_sidebar('contact');

              elseif( is_page( 49, 'file-claim') ):
    
                get_sidebar('claim'); 

              else:
    
                get_sidebar('default'); 

              endif;

              ?>  
      
              <div class="clear"></div>
   
        </div>       

    </div>
    <!-- /.container -->

<?php

	get_footer();
	 
?>