jQuery(document).ready(function($){

$(".video_control").mouseenter(function(){
    $(this).get(0).play();
});
$(".video_control").mouseleave(function(){
    $(this).get(0).pause();
});

$(".video_link").click(function(event) {
        // prevent the navigation from happening
        event.stopImmediatePropagation();
        event.preventDefault();

        var url = $(this).attr('href');
        window.location = url;
});

});