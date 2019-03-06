var $ = jQuery;
$(document).ready(function () {
	'use strict';
	// Ticker
	if ($('#mgs-newsTicker').length > 0) {
		$('#mgs-newsTicker').bxSlider({
			minSlides: 1,
			maxSlides: 1,
			speed: 3000,
			mode: 'vertical',
			auto: true,
			controls: false,
			pager: false
		});
	}

	var breaking_news_args = {
        auto: true,
        pager: false,
        minSlides: 3,
        maxSlides: 3,
        speed: 3000,
        moveSlides:1,
        controls: true,
    };
    $('.breaking-news-slider').each(function () {
        var duration, direction;
        direction = $(this).data('direction');
        duration = $(this).data('duration');
        breaking_news_args.speed = duration;
        breaking_news_args.mode = direction;
        $(this).bxSlider(breaking_news_args);
    });

	// Slider
	if ($('.newspaper-liteSlider').length > 0) {
		$('.newspaper-liteSlider').bxSlider({
			pager: false,
			controls: true,
			prevText: '<i class="fa fa-arrow-left"> </i>',
			nextText: '<i class="fa fa-arrow-right"> </i>'
		});
	}
	//$('.mgs-carousel-section').removeClass('mgs-before-carousel-js-load');
	var newspaper_lite_carousel = $('.newspaper-lite-carousel');
	var newspaper_lite_carousel_args = {
		navigation: true, // Show next and prev buttons
		slideSpeed: 300,
		paginationSpeed: 400,
		singleItem: true,
		mouseDrag: false,
		touchDrag: true,
		margin: 10,
		controls: true,
		loop: true,
		nav: false,
		autoplayTimeout: 2200,
		autoplay: true,
		navText: ['<i class="fa fa-arrow-left"> </i>', '<i class="fa fa-arrow-right"> </i>']
	};
	if (newspaper_lite_carousel.length > 0) {
		newspaper_lite_carousel.each(function () {
			var items = $(this).parent().width() / 300;
			newspaper_lite_carousel_args.items = (items > 3) ? 3 : (items < 1) ? 1 : Math.floor(items);
			var data_timer = undefined !== $(this).attr('data-timer') ? $(this).attr('data-timer') : 2200;
			newspaper_lite_carousel_args.autoplayTimeout = data_timer;
			$(this).owlCarousel(newspaper_lite_carousel_args);
		});
	}
	//Search toggle
	$('.header-search-wrapper .search-main').click(function () {
		$('.search-form-main').toggleClass('active-search');
		$('.search-form-main .search-field').focus();
	});

	//responsive menu toggle
	$('.bottom-header-wrapper .menu-toggle').click(function () {
		$('.bottom-header-wrapper #site-navigation').slideToggle('slow');
	});
	//responsive sub menu toggle
	$('#site-navigation .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');
	$('#site-navigation .sub-toggle').click(function () {
		$(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
		$(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
	});
	// Scroll To Top
	$(window).scroll(function () {
		if ($(this).scrollTop() > 700) {
			$('#mgs-scrollup').fadeIn('slow');
		} else {
			$('#mgs-scrollup').fadeOut('slow');
		}
	});
	$('#mgs-scrollup').click(function () {
		$('html, body').animate({scrollTop: 0}, 600);
		return false;
	});
	//column block wrap js
	var divs = $('section.newspaper_lite_block_column');
	for (var i = 0; i < divs.length;) {
		i += divs.eq(i).nextUntil(':not(.newspaper_lite_block_column').andSelf().wrapAll('<div class="newspaper_lite_block_column-wrap"> </div>').length;
	}
});
