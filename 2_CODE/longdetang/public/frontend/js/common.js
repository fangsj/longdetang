/******************
 
 serachボタン
 
 ******************/


$('header nav.memberNavi ul li span.search').click(function () {
  $('body').css('position', 'fixed');
  $('.itemSerchBlock').css({display: 'block'}).animate({opacity: '1'}, 500, "swing", function () {
    $('.itemSerchBlock .wrap').animate({opacity: '1'}, 500, "swing");
  });
});
$('.itemSerchBlock .cls').click(function () {
  $('.itemSerchBlock').animate({opacity: '0'}, 500, "swing", function () {
    $('.itemSerchBlock').css({display: 'none'});
    $('.itemSerchBlock .wrap').css({opacity: '0'});
    $('body').css('position', ' static');
  });
});
$(function () {
  $('.DSbtn').on("click", function () {
    if ($('.DSbtn').is('.action')) {
      $('.spNavi').slideToggle();
      $('.DSbtn').removeClass('action');
    } else {
      $('.spNavi').slideToggle();
      $('.DSbtn').addClass('action');
    }
  });
});

// チェックボックス情報整理
function beforeSubmit2 () {
  // Category
  str = "";
  for (i = 1; i < 7; i++) {
    if (document.getElementById("search_c_" + i)) {
      if (document.getElementById("search_c_" + i).checked) {
        if (str != "") str = str + ",";
        str = str + document.getElementById("search_c_" + i).value;
      }
    }
  }
  document.getElementById("search_c").value = str;
  // Tag
  str = "";
  for (i = 1; i < 15; i++) {
    if (document.getElementById("search_t_" + i)) {
      if (document.getElementById("search_t_" + i).checked) {
        if (str != "") str = str + ",";
        str = str + document.getElementById("search_t_" + i).value;
      }
    }
  }
  document.getElementById("search_t").value = str;
  // Size
  str = "";
  for (i = 1; i < 6; i++) {
    if (document.getElementById("search_size_" + i)) {
      if (document.getElementById("search_size_" + i).checked) {
        if (str != "") str = str + ",";
        str = str + document.getElementById("search_size_" + i).value;
      }
    }
  }
  document.getElementById("search_size").value = str;
  // Price
  str = "";
  for (i = 1; i < 6; i++) {
    if (document.getElementById("search_price_" + i)) {
      if (document.getElementById("search_price_" + i).checked) {
        if (str != "") str = str + ",";
        str = str + document.getElementById("search_price_" + i).value;
      }
    }
  }
  document.getElementById("search_price").value = str;
  return true;
}

window.onload = function () {
  setSize();
}
$(window).resize(function () {
  setSize();
});

function setSize () {
  var winH = $(window).height();
  var winW = $(window).width();
  if (winW < 768) {
    $('section.top').css({
      'padding-top': winH
    });
  } else {
    $('section.top').css({
      'padding-top': 0
    });
  }
}
