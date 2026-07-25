/***************************************************
==================== JS INDEX ======================
****************************************************
01. PreLoader Js
02. Nice Select Js
03. mobile menu Js
04. Sticky Header Js
05. offcanvas
06. Search Js
07. Common Js
08. Smooth Scroll Js
09. back-to-top
10. magnificPopup img view
11. Counter Js
12. Parallax Js	
13. Wow Js	
14. slider-range
15. tp_ecommerce
****************************************************/

(function ($) {
	"use strict";

	jQuery(document.body).on('added_to_cart', function () {
		jQuery.get(wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_refreshed_fragments'), function (data) {
			if (data && data.fragments) {
				jQuery.each(data.fragments, function (key, value) {
					jQuery(key).replaceWith(value);
				});
			}
		});
	});



	var windowOn = $(window);
	
	////////////////////////////////////////////////////
	// 01. PreLoader Js
	windowOn.on('load', function () {
		$(".preloader").fadeOut(500);
	});

	// 02. Nice Select Js
	$('.woocommerce-ordering select,.tp-widget-sidebar select,.tp-footer-widget select').niceSelect();

	////////////////////////////////////////////////////
	// 03. mobile menu Js
    let tpMenuHTML = $('.tp-mobile-menu-active > ul').clone();
    let tpOffcanvasMenu = $('.tp-offcanvas-menu > nav');

    tpOffcanvasMenu.append(tpMenuHTML);

    if($(tpOffcanvasMenu).find('.sub-menu').length != 0){
      $(tpOffcanvasMenu).find('.sub-menu').parent().append('<button class="tp-sidemenu-close"><i class="fas fa-chevron-right"></i></button>');
    }
    
    let tpSideMenuToggle = $('button.tp-sidemenu-close');

    $(tpSideMenuToggle).on('click',function(){
        $(this).siblings('.sub-menu').slideToggle();
        $(this).parent().toggleClass('active');
    });



	///////////////////////////////////////////////////
	// 04. Sticky Header Js
	$(window).on('scroll', function () {
		let scroll = $(window).scrollTop();
		if (scroll < 20) {
			$("#header-sticky").removeClass("header-sticky");
		} else {
			$("#header-sticky").addClass("header-sticky");
		}
	});

	if ($('.tp-header-height').length > 0) {
        var headerHeight = document.querySelector(".tp-header-height");
        var setHeaderHeight = headerHeight.offsetHeight;

        $(".tp-header-height").each(function () {
            $(this).css({
                'height': setHeaderHeight + 'px'
            });
        });
    }

	////////////////////////////////////////////////////
	// 05. offcanvas

    $(".tp-header-toogle").on('click',function(){
        $(".tp-offcanvas").addClass("tp-offcanvas-open");
        $(".tp-offcanvas-overlay").addClass("tp-offcanvas-overlay-open");
    });

    $(".tp-offcanvas-close-button,.tp-offcanvas-overlay").on('click',function(){
        $(".tp-offcanvas").removeClass("tp-offcanvas-open");
        $(".tp-offcanvas-overlay").removeClass("tp-offcanvas-overlay-open");
    });

	$(".cartmini-open-btn").on("click", function () {
		$(".cartmini__area").addClass("cartmini-opened");
		$(".tp-offcanvas-overlay").addClass("tp-offcanvas-overlay-open");
	});

	$(".cartmini-close-btn, .tp-offcanvas-overlay").on("click", function () {
		$(".cartmini__area").removeClass("cartmini-opened");
		$(".tp-offcanvas-overlay").removeClass("tp-offcanvas-overlay-open");
	});


	////////////////////////////////////////////////////
	// 06. Search Js

	$(".tp-search-click").on("click", function () {
		$(".tp-search-form-toggle").addClass("active");
		$(".tp-offcanvas-overlay").addClass("tp-offcanvas-overlay-open");
	});

	$(".tp-search-close,.tp-offcanvas-overlay").on("click", function () {
		$(".tp-search-form-toggle").removeClass("active");
		$(".tp-offcanvas-overlay").removeClass("tp-offcanvas-overlay-open");
	});


	////////////////////////////////////////////////////
	// 07. Common Js
	$("[data-img-bg").each(function () {
		$(this).css("background-image", "url( " + $(this).attr("data-img-bg") + "  )");
	});

	$("[data-width]").each(function () {
		$(this).css("width", $(this).attr("data-width"));
	});

	$("[data-bg-color]").each(function () {
		$(this).css("background-color", $(this).attr("data-bg-color"));
	});
    $("[data-color]").each(function () {
        $(this).css("color", $(this).attr("data-color"))
    })
    $('.tp-faq-button').on('click', function() {
        $('.tp-faq-item').removeClass('active');
        $(this).closest('.tp-faq-item').addClass('active');
    });

	////////////////////////////////////////////////////
	// 09. back-to-top
    function back_to_top() {
        var $btn = $('#back_to_top'),
            $btnWrapper = $('.back-to-top-wrapper'),
            $window = $(window);
        $window.on('scroll', function () {
            if ($window.scrollTop() > 300) {
                $btnWrapper.addClass('back-to-top-btn-show');
            } else {
                $btnWrapper.removeClass('back-to-top-btn-show');
            }
        });

        $btn.on('click', function (e) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: 0 }, 300);
        });
    }
    // Initialize
    back_to_top();

	////////////////////////////////////////////////////
	// 10. magnificPopup img view
	$('.popup-image').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true
		}
	});

	$(".popup-video").magnificPopup({
		type: "iframe",
	});

	////////////////////////////////////////////////////
	// 11. Counter Js
	new PureCounter();
	new PureCounter({
		filesizing: true,
		selector: ".filesizecount",
		pulse: 2,
	});


	////////////////////////////////////////////////////
	// 12. Parallax Js	  
	if ($('.scene').length > 0) {
		$('.scene').parallax({
			scalarX: 5.0,
			scalarY: 5.0,
		});
	};
	if ($('.scene-y').length > 0) {
		$('.scene-y').parallax({
			scalarY: 5.0,
			scalarX: 0,
		});
	};

	////////////////////////////////////////////////////
	// 13. Wow Js
	new WOW().init();

	////////////////////////////////////////////////////
	// 14. slider-range

	$("#slider-range").slider({
		range: true,
		min: 0,
		max: 500,
		values: [75, 300],
		slide: function (event, ui) {
			$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
		}
	});
	$("#amount").val("$" + $("#slider-range").slider("values", 0) +
		" - $" + $("#slider-range").slider("values", 1));

	$("#slider-range-offcanvas").slider({
		range: true,
		min: 0,
		max: 500,
		values: [75, 300],
		slide: function (event, ui) {
			$("#amount-offcanvas").val("$" + ui.values[0] + " - $" + ui.values[1]);
		}
	});
	$("#amount-offcanvas").val("$" + $("#slider-range-offcanvas").slider("values", 0) +
		" - $" + $("#slider-range-offcanvas").slider("values", 1));


	////////////////////////////////////////////////////
	// 15. tp_ecommerce
	function tp_ecommerce() {
		// PLUS
		$(document).on('click', '.tp-cart-plus', function () {
			let input = $(this).siblings('.tp-cart-input');
			let value = parseInt(input.val()) || 0;
			input.val(value + 1).trigger('change');
		});

		// MINUS
		$(document).on('click', '.tp-cart-minus', function () {
			let input = $(this).siblings('.tp-cart-input');
			let value = parseInt(input.val()) || 0;
			let min = parseInt(input.attr('min')) || 1;

			if (value > min) {
			input.val(value - 1).trigger('change');
			}
		});
		
	}
	tp_ecommerce();


})(jQuery);