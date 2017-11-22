/******************

   swich

******************/


$(function(){
        $("li.sw01").on("click", function() {
		$('ul.itemlistBlock').removeClass('c_layout');	
		$(this).addClass('active');	
		$("li.sw02").removeClass('active');
        });
});

$(function(){
        $("li.sw02").on("click", function() {
		$('ul.itemlistBlock').addClass('c_layout');
			$(this).addClass('active');	
		$("li.sw01").removeClass('active');
        });
});


$('.itemSerchBtn').click(function() {
	$('body').css('position','fixed');
	$('.listWrapper .serchBlock').css({display:'block'}).animate({ opacity: '1'}, 500, "swing",function(){
		$('.listWrapper .serchBlock form').animate({ opacity: '1'}, 500, "swing");
	});
	
});

$('.listWrapper .serchBlock .cls').click(function() {
	
	$('.listWrapper .serchBlock').animate({ opacity: '0'}, 500, "swing",function(){
		$('.listWrapper .serchBlock').css({display:'none'});
		$('.listWrapper .serchBlock form').css({opacity: '0'});
		$('body').css('position',' static');
		});
});

