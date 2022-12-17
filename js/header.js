let navBarContainer = $('.nav_bar');
let sideNav = $('#side-nav');
let menuBtn = $('#menu-btn');
let containerContent = $('#container-content');



$(document).ready(function(){
    menuBtn.click(function(){
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            navBarContainer.removeClass('active');
            containerContent.removeClass('active');
            $(this).html(' arrow_forward_ios');
        } else {
            $(this).addClass('active');
            navBarContainer.addClass('active');
            $(this).html(' arrow_back_ios');
            containerContent.addClass('active');
            sideNav.addClass('active');
        }
    });

    $('#sampleH1').click(function(){
        location.href = './';
    });
});


