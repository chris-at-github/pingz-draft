!function ($) {

	// prettyCheckboxes
	// ---------------------------------------------------------------------------
	// Developped By: Stephane Caron (http://www.no-margin-for-errors.com)
	// Inspired By: All the non user friendly custom checkboxes solutions ;)
	// Version: 1.1
	//
	// Copyright: Feel free to redistribute the script/modify it, as
	// long as you leave my infos at the top.
	$.fn.prettyCheckboxes = function(settings) {
		settings = $.extend({
			className : 'pretty-'
		}, settings);

		$(this).each(function(){

			// Find the label
			$label = $('label[for="' + $(this).attr('id') + '"]');

			// Add the checkbox holder to the label
			$label.prepend('<span class="pretty-' + $(this).attr('type') + '-placeholder"></span>');

			// If the checkbox is checked, display it as checked
			if($(this).is(':checked')) {
				$label.addClass('checked');
			}

			// Assign the class on the label
			$label.addClass(settings.className + $(this).attr('type'));

			// Associate the click event
			$label.bind('click',function(){
				$('input#' + $(this).attr('for')).triggerHandler('click');

				if($('input#' + $(this).attr('for')).is(':checkbox')){
					$(this).toggleClass('checked');
					$('input#' + $(this).attr('for')).checked = true;

				} else {

					$radio = $('input#' + $(this).attr('for'));

					// Uncheck all radio
					$('input[name="' + $radio.attr('name') + '"]').each(function(){
						$('label[for="' + $(this).attr('id') + '"]').removeClass('checked');
					});

					$(this).addClass('checked');
					$radio.checked = true;
				};
			});

			$('input#' + $label.attr('for')).bind('keypress',function(e){
				if(e.keyCode == 32){
					if($.browser.msie){
						$('label[for="' + $(this).attr('id') + '"]').toggleClass('checked');

					} else {
						$(this).trigger('click');
					}
					return false;
				};
			});
		});
	};

	// -------------------------------------------------------------------------------------
	// EqualHeight
	$.fn.equalheight = function() {
//		return this.height(Math.max.apply(this, $.map(this, function(e) {
//			return $(e).height();
//		})));
		return $(this).css('min-height', (Math.max.apply(this, $.map(this, function(e) {
			return $(e).height();
		}))));
	};

	// -------------------------------------------------------------------------------------
	// ArticleImageSelection
	// @todo eventuell border-width ausrechnen
	$.fn.articleImageSelection = function(options) {
		var defaults 	= {};
		var settings 	= $.extend({}, defaults, options);
		var enlarge		= $('#article-properties-image img');
		var active		= $(this)
			.first()
			.addClass('active');

		return this.each(function() {
			var image = $(this);

			image.bind('click', function() {
				active.removeClass('active');
				active = $(this);
				active.addClass('active');

				enlarge
					.attr('src', $(this).data('image-url'))
					.attr('data-large', $(this).data('large-url'));

				return false;
			});
		});
	};

	$(function() {
		// -------------------------------------------------------------------------------------
		// jCarousel
		$('[data-jcarousel]').each(function() {
				var el = $(this);
				el.jcarousel(el.data());
		});

		$('[data-jcarousel-control]').each(function() {
				var el = $(this);
				el.jcarouselControl(el.data());
		});

		// -------------------------------------------------------------------------------------
		// EqualHeight
		$(window).bind('load resize', function() {
			$('.equalheight-grid').each(function() {
				$(this).children('.grid').children('.grid-inner').equalheight();
			});
			$('.ie7 #newsletter-email').css({'height': '1%'});
		});

		// -------------------------------------------------------------------------------------
		// Lazy Load fuer Artikelbilder
		if(typeof($(window).lazyload) !== 'undefined') {
			$('.lazy-load').lazyload();
		}

		// -------------------------------------------------------------------------------------
		// ArticleHover
		//$('.article-grid .grid-inner').articleHover();

		// -------------------------------------------------------------------------------------
		// PrettyCheckboxes
		$('#article-filter input').prettyCheckboxes();
		$('#article-filter input').bind('change', function() {
			$(this).closest('form').trigger('submit');
		});

		// -------------------------------------------------------------------------------------
		// Dialog
		$('body').on('click', '.ui-widget-overlay', function() {
			$('.modal').dialog('close');
		});

		$('.modal-trigger').bind('click', function() {
			$($(this).attr('href')).dialog({
				width: 600,
				modal: true,
				closeText: 'Fenster schlieﬂen'
			});

			return false;
		});

		// -------------------------------------------------------------------------------------
		// BasketNewArticle
		$('#basket-new-article-notice').delay(2000).fadeOut(1000);

		// -------------------------------------------------------------------------------------
		// Magnifier
		if(typeof($(window).imagezoomsl) !== 'undefined') {
			$(window).bind('load', function() {
				$("#article-properties-image img").imagezoomsl({
					zoomstart: 1,
					magnifierborder: '10px solid #fff',
					cursorshadeborder: '5px solid #7b7b7b',
					magnifiereffectanimate: 'fadeIn'
				});

				// ---------------------------------------------------------------------------------
				// ArticleImageSelection
				$('#article-properties-image-selection li').articleImageSelection();
			});
		}

		// -------------------------------------------------------------------------------------
		// Share
		$('.container-share a').each(function() {

			var link	= $(this);
			var url		= link.prop('href');
			var title	= link.prop('title');

			var windowWidth		= 580;
			var windowHeight	= 470;

			// remove target=blank for JS-Browsers
			link.removeAttr('target');

			link.bind('click', function() {

				// Fixes dual-screen position                         Most browsers      Firefox
				var dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : screen.left;
				var dualScreenTop = window.screenTop !== undefined ? window.screenTop : screen.top;

				var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
				var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

				var left = ((width / 2) - (windowWidth / 2)) + dualScreenLeft;
				var top = ((height / 3) - (windowHeight / 3)) + dualScreenTop;

				var shareWindow = window.open(url, title, 'scrollbars=yes, width=' + windowWidth + ', height=' + windowHeight + ', top=' + top + ', left=' + left);

				// Puts focus on the newWindow
				if(window.focus) {
					shareWindow.focus();
				}

				return false;
			});
		});

		// -------------------------------------------------------------------------------------
		// Basket | UserAddresses
		$('#checkout-articles-checkall').bind('click', function() {
			$('#checkout-articles input[type=checkbox]').prop('checked', $(this).is(':checked'));
		});

		$('#user-billingaddress-properties-edit').bind('click', function() {
			$('#user-billingaddress-properties').hide();
			$('#user-billingaddress-form').show();
			return false;
		});

		$('#user-display-shippingaddress').bind('click', function() {
			if($(this).is(':checked') === true) {
				$('#user-shippingaddress-container').hide();
			} else {
				$('#user-shippingaddress-container').show();
			}
		});

		$('#user-shippingaddress-properties-edit').bind('click', function() {
			$('#user-shippingaddress-properties').hide();
			$('#user-shippingaddress-form').show();
			return false;
		});

		// neue Adresse | Wechsel auf andere Adresse
		$('#user-shippingaddress-select').bind('change', function() {

			// Neue Adresse
			if($(this).val() === '-1') {
				$('#user-shippingaddress-form input[type=text]').val('');
				$('#user-shippingaddress-properties').hide();
				$('#user-shippingaddress-form').show();

			} else {
				var form = $(this).closest('form');

				form.parsley('destroy');
				form.find('input[name=fnc]').val('');
				form.submit();
			}
		});

		// -------------------------------------------------------------------------------------
		// Parsley
		$('form').each(function(i, element) {
			$(element).parsley({
				focus: 'none',
				errorClass: 'form-field-error',
				errors: {
					container: function(element) {
						var $container = element.parent().find('.parsley-error-container');
						if($container.length === 0) {
							$container = $('<div class="parsley-error-container"><div class="arrow"></div></div>').insertBefore(element);
						}
						return $container;
					}
				},
				listeners: {
					onFieldValidate: function(element) {
						if($(element).is(':visible') === false) {
							return true;
						}

						return false;
					},
					onFieldSuccess: function(element) {
						var $container = element.parent().find('.parsley-error-container');

						if($container.length !== 0) {
							$container.remove();
						}
					},
					onFormSubmit: function(valid, e, form) {
						if(valid === false) {
							var $firstErrorField = form.$element.find('.form-field-error').first();

							$('html, body').animate({
								scrollTop: ($firstErrorField.offset().top - 35)
							}, 500);
						}
					}
				}
			});
		});
	});
}(window.jQuery);