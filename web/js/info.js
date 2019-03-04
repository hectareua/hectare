$(document).ready(function () {
  //sliders
  var windowHeight = window.innerHeight;
  var widthQuery820 = window.matchMedia("(max-width: 820px)");
  var widthQuery700 = window.matchMedia("(max-width: 700px)");
  var sliderSmallHeight = 500;

  if ($("div").is(".topHeader")) {
    delta = 0;
  } else {
    delta = 135;
  }

  var projectHeight = windowHeight - delta;
  var sliderHeight = windowHeight - delta;
  if ($("div").is(".advanced-slider.big") && (widthQuery700.matches)) {
    sliderHeight = sliderSmallHeight;
  }
  if (widthQuery820.matches) {
    projectHeight = windowHeight - 70;
  }
  if ($("div").is(".advanced-slider.big")) {
      $('.advanced-slider.big').advancedSlider({
          width: '100%',
          height: sliderHeight,
          opacity: .8,
          responsive: true,
          alignType: 'centerCenter',
          skin: 'glossy-square-gray',
          shadow: false,
          effectType: 'slide',
          slideshow: true,
          slideshowDelay: 15000,
          timerAnimationControls: false,
          pauseSlideshowOnHover: true,
          swipeThreshold: 30,
          slideButtons: true,
          keyboardNavigation: true
      });
  }
  if ($("div").is(".shop-slider")) {
    if ($.trim($('.shop-slider').find('.slides').html()) != '') {
      $('.shop-slider').advancedSlider({
          width: '100%',
          height: 300,
          opacity: .8,
          responsive: true,
          skin: 'glossy-square-gray',
          shadow: false,
          effectType: 'swipe',
          slideshow: false,
          timerAnimationControls: false,
          pauseSlideshowOnHover: true,
          swipeThreshold: 30,
          slideButtons: true,
          keyboardNavigation: true
      });
    }
  }
  if ($("div").is(".article-slider")) {
    slideButtons = true;
    if ($(window).width() < 480) slideButtons = false;
      $('.article-slider').advancedSlider({
          width: 900,
          height: 600,
          opacity: .8,
          responsive: true,
          skin: 'glossy-square-gray',
          shadow: false,
          effectType: 'swipe',
          slideshow: true,
          slideshowDelay: 1500000,
          slideButtons:slideButtons,
          timerAnimationControls: false,
          pauseSlideshowOnHover: true,
          swipeThreshold: 30,
          keyboardNavigation: true,
      });
  }

  function shopPopupShow() {
    if ($("div").is(".shop-popup-slider")) {
        $('.shop-popup-slider').advancedSlider({
            width: 380,
            height: 700,
            opacity: .8,
            responsive: true,
            skin: 'glossy-square-gray',
            shadow: false,
            effectType: 'swipe',
            slideshow: false,
            timerAnimationControls: false,
            pauseSlideshowOnHover: true,
            swipeThreshold: 30,
            thumbnailType: 'scroller',
            thumbnailWidth: 115,
            thumbnailHeight: 111,
            thumbnailButtons: false,
            thumbnailSwipe: true,
            thumbnailScrollerResponsive: true,
            minimumVisibleThumbnails: 1,
            maximumVisibleThumbnails: 3,
            slideButtons: false,
            keyboardNavigation: true
        });
    }
  }

  //projects
  if ($("div").is("#specProjects")) {
    $("#specProjects .project").css({"height": projectHeight});
  }

  //top news
  if ($("div:not(.article-video)").is("#top_news")) {
    var top_newsHE = document.getElementById('top_news');
    top_newsHE.style.height = projectHeight + 'px';
    window.addEventListener('scroll', onScroll);
  }

  //fullScreenPhoto
  if ($("div").is("#fullScreenPhoto")) {
    var fullScreenPhotoHE = document.getElementById('fullScreenPhoto');
    fullScreenPhotoHE.style.height = projectHeight + 'px';
    window.addEventListener('scroll', onScroll);
  }

  //rubric_list
  if ($("section").is("#rubric_list")) {
    var rubric_listHE = document.getElementById('rubric_list');
    window.addEventListener('scroll', onScroll);
    //console.log(true);
  }

  //paralax
  function onScroll() {
    //top news
    if ($("div").is("#top_news")) {
      var topPositionTopNews = ((window.scrollY * 0.3)+ 'px');
      top_newsHE.style.backgroundPosition = "center " + topPositionTopNews;
    }

    //rubric_list
    if ($("section").is("#rubric_list")) {
      var topPositionRubric = ((window.scrollY * 0.3)+ 'px');
      rubric_listHE.style.backgroundPosition = "center " + topPositionRubric;
    }

    //fullScreenPhoto
    if ($("div").is("#fullScreenPhoto")) {
      var fullScreenPhotoBox = fullScreenPhotoHE.getBoundingClientRect();
      var fullScreenPhotoPosition = fullScreenPhotoBox.top;
      if (fullScreenPhotoPosition < projectHeight) {
        var topPositionFullScreenPhoto = (-(fullScreenPhotoPosition * 0.3)+ 'px');
        fullScreenPhotoHE.style.backgroundPosition = "center " + topPositionFullScreenPhoto;
        fullScreenPhotoHE.style.minHeight = 0;
        // console.log(fullScreenPhotoPosition);
        // console.log(topPositionFullScreenPhoto);
      }
    }
  }

  /*mobile menu*/
  $('.hide_show_menu').click(function () {
      $("body").toggleClass("mobile-menu-active");
  });
  $('.mobile_nav .btnClose').click(function () {
    $("body").toggleClass("mobile-menu-active");
  });
  $('.mobileMenu-bg').click(function (event) {
    event.stopPropagation();
    $("body").removeClass("mobile-menu-active");
  });

  /*Search*/
  $('.b_search .search_icon').click(function () {
    $('.search-modal').toggleClass("open");
    $('.search-modal input').focus();
    $('.search-modal-bg').toggleClass("open");
  });
  $('#search-modal .btnClose, #search-modal .modalClose').click(function () {
    $('.search-modal').toggleClass("open");
    $('.search-modal-bg').toggleClass("open");
  });

/*Search*/
  $('.b_search.search_icon').click(function () {
    $('.search-modal').toggleClass("open");
    $('.search-modal input').focus();
    $('.search-modal-bg').toggleClass("open");
  });

  /*show/hide order popup*/
  var productModalBg = $(".product-modal-bg");
  var productModal = $("#product-modal");
  var contributionModal = $("#contribution-modal");
  var productModalTop = $(window).scrollTop();
  $(window).scroll(function () {
    productModalTop = $(window).scrollTop();
  });

  $('body').on('click', '.shop-list .orderBtn', function(){
    product_id = $(this).attr('id');
    $.post(function_object.ajax_url, {
          action: 'load_product_info',
          product_id: product_id
      }, function(data) {
          var $response   =   $(data);
          var productdata    =   $response.filter('#productdata').html();
          productModal.html(productdata);
          $('.shop-slider').advancedSlider({
            width: '100%',
            height: 300,
            opacity: .8,
            responsive: true,
            skin: 'glossy-square-gray',
            shadow: false,
            effectType: 'swipe',
            slideshow: false,
            timerAnimationControls: false,
            pauseSlideshowOnHover: true,
            swipeThreshold: 30,
            slideButtons: true,
            keyboardNavigation: true
        });
        $('input[value=""].productControl').addClass('empty');
        $('input').keyup(function(){
            if( $(this).val() == ""){
                $(this).addClass("empty");
            }else{
                $(this).removeClass("empty");
            }
        });
        $("body").addClass("order-popup-active");
        productModal.fadeIn(300);
        productModalBg.fadeIn(300);
        productModal.css('top', productModalTop + 50 + 'px');
        shopPopupShow();
      });
  });

  $('body').on('change', '#product_quantity', function () {
    price = $('#my_product_price').text();
    quantity = $(this).val();
    total = parseInt(price * quantity);
    $('#my_product_total').text(total);
  })

  $('#contributionBtn').click(function () {
      $("body").addClass("order-popup-active");
      productModalBg.fadeIn(300);
      contributionModal.fadeIn(300);
      contributionModal.css('top', productModalTop + 50 + 'px');
  });
  if ($('#contribution-modal').is(':visible')) {
      $("body").addClass("order-popup-active");
  };

  $('.product-modal .btnClose, .product-modal-bg').click(function () {
      $("body").removeClass("order-popup-active");
      productModalBg.fadeOut(300);
      productModal.fadeOut(300);
      contributionModal.fadeOut(300);
  });

  $('body').on('click', '.product-modal .btnClose', function () {
      $("body").removeClass("order-popup-active");
      productModalBg.fadeOut(300);
      productModal.fadeOut(300);
      contributionModal.fadeOut(300);
  })

  function smallHeader() {
    var e = $(window).scrollTop();
    if ($('div').is('.topHeader')) {
      $('.mobileMenu-bg').css('opacity','0');
      if (e > 1) {
        $('.fixedTopPanel').css('background-color','rgba(30, 40, 45, 0.94)');
        $('.mobile_nav').css('top','50px');
      } else {
        $('.fixedTopPanel').css('background','0');
        $('.mobile_nav').css('top','0');
      }
      e = 2;
    }
    if (e > 1) {
      $("body").addClass("smallHeader");
    } else {
      $("body").removeClass("smallHeader");
    }
  }
  smallHeader();

  $(window).scroll(function () {
    smallHeader();
  });

  $('.mobile_nav_inner').jScrollPane();
  $(window).resize(function () {
    $('.mobile_nav_inner').jScrollPane();
  });

  videoHeight = $('video').innerHeight();
  articleVideoHeight = (videoHeight > projectHeight) ? projectHeight : videoHeight;
  $('.article-video').height(articleVideoHeight);
  setTimeout(function () {$('#video-overlay').trigger('click');},4000);
});
//END OF DOCUMENT LOAD

$('input[value=""].productControl').addClass('empty');
$('input').keyup(function(){
    if( $(this).val() == ""){
        $(this).addClass("empty");
    }else{
        $(this).removeClass("empty");
    }
});


$(function(){
// hide #back-top first
  $("#back-top").hide();
// fade in #back-top
  $(function () {
    $(window).scroll(function () {
      if ($(this).scrollTop() > 100) {
        $('#back-top').fadeIn(1000);
      } else {
        $('#back-top').fadeOut(1000);
      }
    });
// scroll body to 0px on click
    $('#back-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 1000);
        return false;
    });
  });
});

$('#video-overlay').on('click',function(){
  videoPlayer = $('#video').get(0);
    if (videoPlayer.paused) {} else {
        $('.play-icon').fadeOut(500);
    }
});

$('.play-icon').on('click',function(){
  videoPlayer = $('#video').get(0);
  videoPlayer.play();
  $('.play-icon').fadeOut(500);
});


$('.social-share').on('click',function(){
  var ajaxurl = 'http://'+window.location.host+'/wp-admin/admin-ajax.php';
  var network = $(this).attr('id');
    $.ajax({
      url: ajaxurl + "?action=update_social_counter",
      type: 'post',
      data: {network:network},
      success: function(data) {
      },
      error: function(data) {
      }
    });
  switch (network) {
    case 'facebook':
        var win = window.open('https://www.facebook.com/sharer/sharer.php?u=' + window.location.href + '?' + Math.floor((Math.random() * 1000000) + 1), network, 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=640, height=480');
        break;
    case 'twitter':
        var win = window.open('https://twitter.com/home?status=' + window.location.href, network, 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=640, height=480');
        break;
    case 'google':
        var win = window.open('https://plus.google.com/share?url=' + window.location.href + '?' + Math.floor((Math.random() * 1000000) + 1), network, 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=640, height=480');
        break;
    case 'vkontakte':
        var win = window.open('http://vk.com/share.php?url=' + window.location.href + '?' + Math.floor((Math.random() * 1000000) + 1), network, 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=640, height=480');
        break;
    case 'pocket':
        var win = window.open('https://getpocket.com/edit.php?url=' + window.location.href, network, 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=640, height=480');
        break;
    }
  if (win) win.focus();

});

$('a[href]').click(function(){
    $('html, body').animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top-60
    }, 1000, 'easeInOutSine');
    return false;
});

$('#sortBy').on('change',function(){
  var $this = $(this);
  var data = $this.data();
  data['taxonomyTerms'] = $this.val(); // Get data values of selected item
  //console.log(data);
  $.fn.almFilter('fade', '300', data);
});



// -Viktor- adding gradient flow on subscribe section START


var colors = new Array(
  [62,35,255],
  [60,255,60],
  [255,35,98],
  [45,175,230],
  [255,0,255],
  [255,128,0]);

var step = 0;
//color table indices for:
// current color left
// next color left
// current color right
// next color right
var colorIndices = [0,1,2,3];

//transition speed
var gradientSpeed = 0.002;

function updateGradient()
{

  if ( $===undefined ) return;

var c0_0 = colors[colorIndices[0]];
var c0_1 = colors[colorIndices[1]];
var c1_0 = colors[colorIndices[2]];
var c1_1 = colors[colorIndices[3]];

var istep = 1 - step;
var r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
var g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
var b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
var color1 = "rgb("+r1+","+g1+","+b1+")";

var r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
var g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
var b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
var color2 = "rgb("+r2+","+g2+","+b2+")";

 $('.subscribe').css({
   background: "-webkit-gradient(linear, left top, right top, from("+color1+"), to("+color2+"))"}).css({
    background: "-moz-linear-gradient(left, "+color1+" 0%, "+color2+" 100%)"});

  step += gradientSpeed;
  if ( step >= 1 )
  {
    step %= 1;
    colorIndices[0] = colorIndices[1];
    colorIndices[2] = colorIndices[3];

    //pick two new target color indices
    //do not pick the same as the current one
    colorIndices[1] = ( colorIndices[1] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
    colorIndices[3] = ( colorIndices[3] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;

  }
}

setInterval(updateGradient,10);

// -Viktor- adding gradient flow on subscribe section END
