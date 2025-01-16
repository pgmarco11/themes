jQuery(document).ready(function($){

			 var custom_uploader;

			 $('#my_upl_button').click(function(e) {

			 e.preventDefault();
			 var currentfiles = document.getElementById('image_url_header_option').value;
			 var currentIDs = document.getElementById('image_id_header_option').value;
			

					 //If the uploader object has already been created, reopen the dialog
					 if (custom_uploader) {
							 custom_uploader.open();
							 return;
					 } 

					 //Extend the wp.media object
					 custom_uploader = wp.media.frames.file_frame = wp.media({
							 title: 'Choose File',
							 button: {
									 text: 'Choose File'
							 },
							 multiple: false
					 });

					  //When a file is selected, grab the URL and set it as the text field's value
					  custom_uploader.on('select', function() {

						//assign current values to the hidden fields
						if(currentIDs != ''){
							$('#image_id_header_option').val(currentIDs);									
					 	}
						
						if(currentfiles != ''){											 
							$( '#image_url_header_option' ).val(currentfiles);
					 	}

						var selection = custom_uploader.state().get('selection').toJSON();

						
						selection.map( function(attachment){			


							//update id's field
							$('#image_id_header_option').val(attachment.id);

							//update urls's field
							$( '#image_url_header_option' ).val(attachment.url);
							

						});



						custom_uploader = null;
						});


					 //Open the uploader dialog
					 custom_uploader.open();

			 });

});
jQuery(document).ready(function($){

				$('#my_clear_button').click(function(e) {

				$( '#image_id_header_option').val("");
				$( '#image_url_header_option' ).val("");

				return;
					 
			});

});