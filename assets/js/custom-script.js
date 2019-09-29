(function($){

	'use strict';

	var npl_window = $(window);
	var npl_document = $(document);
	var is_rtl = false;
	var TCY_NPL = {

		Snipits: {

			AppendHTML: function(){

				// Navigation Menu sub menu toggle html
				$('#site-navigation .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');

				//column block wrap js
				var divs = $('section.newspaper_lite_block_column');
				for (var i = 0; i < divs.length;) {
					i += divs.eq(i).nextUntil(':not(.newspaper_lite_block_column').andSelf().wrapAll('<div class="newspaper_lite_block_column-wrap"> </div>').length;
				}

				if($('body').hasClass('rtl') ){
					is_rtl = true;
				}

			},

			Sliders: function(){

				// Ticker
				if ($('#mgs-newsTicker').length > 0) {
					$('#mgs-newsTicker').bxSlider({
						minSlides: 1,
						maxSlides: 1,
						speed: 3000,
						mode: 'vertical',
						auto: true,
						controls: false,
						pager: false,
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
				$('.newspaper-liteSlider').each(function(evt){
					$(this).bxSlider({
						pager: false,
						controls: true,
						prevText: '<i class="fa fa-arrow-left"> </i>',
						nextText: '<i class="fa fa-arrow-right"> </i>'
					});
				});

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
					rtl: is_rtl,
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
						newspaper_lite_carousel_args.rtl = is_rtl;
						$(this).owlCarousel(newspaper_lite_carousel_args);
					});
				}
			},

			SearchMain: function(evt){
				$('.search-form-main').toggleClass('active-search');
				$('.search-form-main .search-field').focus();
			},

			MenuToggle: function(evt){
				$('.bottom-header-wrapper #site-navigation').slideToggle('slow');
			},

			SubMenuToggle: function(evt){
				$(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
				$(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
			},

			ScrollTopVisibility: function(scrollObj){

				if($(scrollObj).scrollTop() > 700){
					$('#mgs-scrollup').fadeIn('slow');
				}else{
					$('#mgs-scrollup').fadeOut('slow');
				}

			},

			ScrollOnTop: function(evt){
				$('html, body').animate({scrollTop: 0}, 600);
				return false;
			},


		},

		Events: function(){
			var __this = TCY_NPL;
			var snipits = __this.Snipits;
			
			//Search toggle
			var search_main = snipits.SearchMain;
			npl_document.on('click', '.header-search-wrapper .search-main', search_main);

			//Menu toggle
			var menu_toggle = snipits.MenuToggle;
			npl_document.on('click', '.bottom-header-wrapper .menu-toggle', menu_toggle);

			//Sub Menu toggle
			var sub_menu_toggle = snipits.SubMenuToggle;
			npl_document.on('click', '#site-navigation .sub-toggle', sub_menu_toggle);

			var scroll_on_top = snipits.ScrollOnTop;
			npl_document.on( 'click', '#mgs-scrollup', scroll_on_top );
		},

		Ready: function(){

			var __this = TCY_NPL;
			var snipits = __this.Snipits;
			snipits.AppendHTML();
			snipits.Sliders();
			__this.Events();	

		},

		Load: function(){

		},

		Resize: function(){

		},

		Scroll: function(evt){

			var __this = TCY_NPL;
			var snipits = __this.Snipits;
			snipits.ScrollTopVisibility(this);

		},

		Init: function(){
			
			var __this = TCY_NPL;
			var ready = __this.Ready;
			var load = __this.Load;
			var resize = __this.Resize;
			var scroll = __this.Scroll;

			npl_document.ready(ready);
			npl_window.load(load);
			npl_window.resize(resize);
			npl_window.scroll(scroll);

		}

	};

	TCY_NPL.Init();

})(jQuery);