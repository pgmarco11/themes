jQuery(document).ready(function($){

    var image1_uploader;
    var image2_uploader;
    var image3_uploader;
    var file1_uploader;
    var file2_uploader;
    var file3_uploader;

    $('#select_img_1').on('click', function(event){
       
            event.preventDefault();

           //If the uploader object has already been created, reopen the dialog
            if (image1_uploader) {
                image1_uploader.open();
                return;
            } 

            //Extend the wp.media object
            image1_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });

            //When a file is selected, grab the URL and set it as the text field's value
            image1_uploader.on('select', function() {

                attachment1 = image1_uploader.state().get('selection').first().toJSON();

                $('#image_1').val(attachment1.url);
                $('#image_id_1').val(attachment1.id);
                $('#upload_img_preview_1.img').attr('src', attachment1.url);

            });
            //Open the uploader dialog
            image1_uploader.open();
            
    });

    $('#select_file_1').on('click', function(event){
       
            event.preventDefault();

           //If the uploader object has already been created, reopen the dialog
            if (file1_uploader) {
                file1_uploader.open();
                return;
            } 

            //Extend the wp.media object
            file1_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose File',
                button: {
                    text: 'Choose File'
                },
                multiple: false
            });

            //When a file is selected, grab the URL and set it as the text field's value
            file1_uploader.on('select', function() {
                
                file_attachment1 = file1_uploader.state().get('selection').first().toJSON();

                $('#file_1').val(file_attachment1.url);
                $('#file_id_1').val(file_attachment1.id);

            });

            //Open the uploader dialog
            file1_uploader.open();
     

        });

    $('#select_img_2').on('click', function(event){
       
            event.preventDefault();

           //If the uploader object has already been created, reopen the dialog
            if (image2_uploader) {
                image2_uploader.open();
                return;
            } 

            //Extend the wp.media object
            image2_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });

            //When a file is selected, grab the URL and set it as the text field's value
            image2_uploader.on('select', function() {

                attachment2 = image2_uploader.state().get('selection').first().toJSON();

                $('#image_2').val(attachment2.url);
                $('#image_id_2').val(attachment2.id);
                $('#upload_img_preview_2.img').attr('src', attachment2.url);

            });
            //Open the uploader dialog
            image2_uploader.open();
            
    });

    $('#select_file_2').on('click', function(event){
       
            event.preventDefault();

           //If the uploader object has already been created, reopen the dialog
            if (file2_uploader) {
                file2_uploader.open();
                return;
            } 

            //Extend the wp.media object
            file2_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose File',
                button: {
                    text: 'Choose File'
                },
                multiple: false
            });

            //When a file is selected, grab the URL and set it as the text field's value
            file2_uploader.on('select', function() {
                
                file_attachment2 = file_uploader2.state().get('selection').first().toJSON();

                $('#file_2').val(file_attachment2.url);
                $('#file_id_2').val(file_attachment2.id);

            });

            //Open the uploader dialog
            file2_uploader.open();
     

        });

    $('#select_img_3').on('click', function(event){
       
            event.preventDefault();

           //If the uploader object has already been created, reopen the dialog
            if (image3_uploader) {
                image3_uploader.open();
                return;
            } 

            //Extend the wp.media object
            image3_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });

            //When a file is selected, grab the URL and set it as the text field's value
            image3_uploader.on('select', function() {

                attachment3 = image3_uploader.state().get('selection').first().toJSON();

                $('#image_3').val(attachment3.url);
                $('#image_id_3').val(attachment3.id);
                $('#upload_img_preview_3.img').attr('src', attachment3.url);

            });
            //Open the uploader dialog
            image3_uploader.open();
            
    });

    $('#select_file_3').on('click', function(event){
       
            event.preventDefault();

           //If the uploader object has already been created, reopen the dialog
            if (file3_uploader) {
                file3_uploader.open();
                return;
            } 

            //Extend the wp.media object
            file3_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose File',
                button: {
                    text: 'Choose File'
                },
                multiple: false
            });

            //When a file is selected, grab the URL and set it as the text field's value
            file3_uploader.on('select', function() {
                
                file_attachment3 = file3_uploader.state().get('selection').first().toJSON();

                $('#file_3').val(file_attachment3.url);
                $('#file_id_3').val(file_attachment3.id);

            });

            //Open the uploader dialog
            file3_uploader.open();
     

        });

});