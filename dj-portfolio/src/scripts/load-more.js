jQuery(function($) {
    var button = $('#load-more');
    var excludedPosts = JSON.parse(button.attr('data-posts') || '[]'); // Get initial posts

    button.on('click', function() {
        button.text('Loading...');
 
        $.ajax({
            type: 'POST',
            url: load_more_params.ajax_url,
            data: {
                action: 'load_more_posts',
                excluded_posts: excludedPosts, // Send displayed post IDs
                nonce: load_more_params.nonce
            },
            dataType: 'json',
            success: function(response) {
      
                if (response.success) {
                    if (response.data.html) {
                        $('#mixes-list').append(response.data.html);
                        excludedPosts = response.data.excluded_posts; // Update list
                        button.text('Load More');
                    } else if (response.data.no_more_posts) {
                        button.text('No more mixes').prop('disabled', true);
                    }
                } else {
                    console.error('AJAX Error: Unexpected response', response);
                    button.text('Load More');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Request Failed:', xhr.status, error);
                console.log('Response Text:', xhr.responseText);
                button.text('Load More');
            }
        });
    });
});
