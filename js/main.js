$( window ).scroll(function() {
    var scroll = $(window).scrollTop();
    var top_bar_sec = $('.top-bar-sec');
    var top_head = $('.top-head');

    if(scroll==0){
        top_bar_sec.removeClass('small');
        top_head.removeClass('small-text');
    }else{
        top_bar_sec.addClass('small');
        top_head.addClass('small-text');
    }
});