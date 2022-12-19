let navBarContainer = $('.nav_bar');
let sideNav = $('#side-nav');
let menuBtn = $('.menu-btn');
let containerContent = $('#container-content');
let companyName = $('.page_nav');



$(document).ready(function(){
    menuBtn.click(function(){
        if($(this).hasClass('open')){
            $(this).removeClass('open');
            navBarContainer.removeClass('active');
            containerContent.removeClass('active');
            companyName.removeClass('active');
        } else {
            $(this).addClass('open');
            navBarContainer.addClass('active');
            containerContent.addClass('active');
            sideNav.addClass('active');
            companyName.addClass('active');
        }
    });

    $('#sampleH1').click(function(){
        location.href = './';
    });
});


$('.nav_list').each(function(){
	$(this).click(function(){
		if($(this).next().hasClass('show')){
			$(this).next().removeClass('show');
		} else {
			$(this).next().addClass('show');
		}
	});
});

