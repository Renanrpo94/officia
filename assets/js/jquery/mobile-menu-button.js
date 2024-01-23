$(function () {
    
    $("header .mobile-menu-button").click(function(){
        $(".mobile-menu-box").slideDown();
    });
    
    $("body").click(function(){
        $(".mobile-menu-box").slideUp();
    });

    $(".mobile-menu, .mobile-menu-button").click(function(e){
        e.stopPropagation();
    });
});