<?php
/** 
 *  Template Name: Full Width No Sidebar
 *
**/

get_header();

?>

    <!-- Page Content -->
    <div class="innerbanner">           
          <?php

          $image_header_id = get_option('image_id_header_option');

		if( !empty($image_header_id) ){
             echo wp_get_attachment_image($image_header_id, 'large'); 
          } else {
            _e('<div id="noimage"></div>');
          }

          ?>
    </div>
    <div class="container content">
        <div class="middle-align content_sidebar">
            <div id="sitemain">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                          <h1 class="entry-title">404 Page Not Found</h1>
                    </header>

                    <div class="entry-content">
                    	<div class="row">					
							<div class="col-sm-12 col-md-12 ">
								<div class="row">
									<div class="col-sm-12">
							 
									<h4>We're Sorry. The page you are looking for cannot be found or has moved, please update your bookmarks.</h4>

									</div>
								</div>
							</div>
						</div>
                    </div>

                </article>  

              </div>

              <div class="clear"></div>
   
        </div>       

    </div>
    <!-- /.container -->

<?php

	get_footer();
	 
?>