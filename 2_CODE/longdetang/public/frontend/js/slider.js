/******************

   スライダーオプション

******************/


// アイテム詳細 スライダー
  $('.item_slider').slick({
    asNavFor: '.item_slider-nav', lazyLoad: 'ondemand', speed: 300, arrows: false, dots: false, fade: true,
    responsive: [{
      breakpoint: 767, settings: {lazyLoad: 'ondemand', speed: 300, arrows: false, dots: true, fade: true}
    }]
  });


  $('.item_slider-nav').slick({
    asNavFor: '.item_slider', arrows: true, dots: false, centerMode: false, focusOnSelect: true, slidesToShow: 5, slidesToScroll: 1,
	   responsive: [{
      breakpoint: 767, settings: {arrows: false}
    }]
  });

