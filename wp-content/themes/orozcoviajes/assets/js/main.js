/* --------------------------------------
=========================================
Quality Construction
Version: 0.0.7
Designed By: Canyon Themes
=========================================
*/


(function ($) {
	"use strict";

    jQuery(document).ready(function($){


			/*-----------------------------------------------------------------------------------*/
			/*	12. LAZY LOAD GOOGLE MAPS
			/*-----------------------------------------------------------------------------------*/
			/*
				lazyLoadGoogleMaps v1.0.2, updated 2016-11-22
				By Osvaldas Valutis, www.osvaldas.info
				Available for use under the MIT License
			*/

			window.googleMapsScriptLoaded=function(){$(window).trigger("googleMapsScriptLoaded")},function(i,a){"use strict";var e=i(a),n=i("body"),o=e.height(),t=0,r=function(i,a){var e=null;return function(){var n=this,o=arguments;clearTimeout(e),e=setTimeout(function(){a.apply(n,o)},i)}},s=function(i,a){var e,n;return function(){var o=this,t=arguments,r=+new Date;e&&e+i>r?(clearTimeout(n),n=setTimeout(function(){e=r,a.apply(o,t)},i)):(e=r,a.apply(o,t))}},c=!1,l=!1,p=i([]),g=function(){t=e.scrollTop(),p.each(function(){var a=i(this),e=a.data("options");if(a.offset().top-t>1*o)return!0;if(!c&&!l){var r={callback:"googleMapsScriptLoaded",signed_in:e.signed_in};e.key&&(r.key=e.key),e.libraries&&(r.libraries=e.libraries),e.language&&(r.language=e.language),e.region&&(r.region=e.region),n.append('<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&'+i.param(r)+'"></script>'),l=!0}if(!c)return!0;var s=new google.maps.Map(this,{zoom:15});e.callback!==!1&&e.callback(this,s),p=p.not(a)})};e.on("googleMapsScriptLoaded",function(){c=!0,g()}).on("scroll",s(500,g)).on("resize",r(1e3,function(){o=e.height(),g()})),i.fn.lazyLoadGoogleMaps=function(a){return a=i.extend({key:!1,libraries:!1,signed_in:!1,language:!1,region:!1,callback:!1},a),this.each(function(){var e=i(this);e.data("options",a),p=p.add(e)}),g(),this.debounce=r,this.throttle=s,this}}(jQuery,window,document);


    /*-----------------------------------------------------------------------------------*/
    /*	DATA REL
    /*-----------------------------------------------------------------------------------*/
    $('a[data-rel]').each(function() {
        $(this).attr('rel', $(this).data('rel'));
    });
    /*-----------------------------------------------------------------------------------*/
    /*	TOOLTIP
    /*-----------------------------------------------------------------------------------*/
    if ($("[rel=tooltip]").length) {
        $("[rel=tooltip]").tooltip();
    }
    /*-----------------------------------------------------------------------------------*/
    /*	PRETTIFY
    /*-----------------------------------------------------------------------------------*/
    window.prettyPrint && prettyPrint();
    /*-----------------------------------------------------------------------------------*/
    /*	LAZY LOAD GOOGLE MAPS
    /*-----------------------------------------------------------------------------------*/
    ;
    (function($, window, document, undefined) {
        var $window = $(window),
            mapInstances = [],
            $pluginInstance = $('.google-map').lazyLoadGoogleMaps({
                key: 'AIzaSyAKDuuX8Ffk85c5PJ4Hf87yr0xSx5NP59M',
                callback: function(container, map) {
                    var $container = $(container),
                        center = new google.maps.LatLng($container.attr('data-lat'), $container.attr('data-lng'));

                    map.setOptions({
                        center: center,
                        zoom: $container.attr('data-zoom'),
                        zoomControl: true,
                        zoomControlOptions: {
                            style: google.maps.ZoomControlStyle.DEFAULT,
                        },
                        disableDoubleClickZoom: false,
                        mapTypeControl: true,
                        mapTypeControlOptions: {
                            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                        },
                        scaleControl: true,
                        scrollwheel: false,
                        streetViewControl: true,
                        draggable: true,
                        overviewMapControl: false,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });
                    new google.maps.Marker({
                        position: center,
                        map: map
                    });

                    $.data(map, 'center', center);
                    mapInstances.push(map);

                    var updateCenter = function() {
                        $.data(map, 'center', map.getCenter());
                    };
                    google.maps.event.addListener(map, 'dragend', updateCenter);
                    google.maps.event.addListener(map, 'zoom_changed', updateCenter);
                    google.maps.event.addListenerOnce(map, 'idle', function() {
                        $container.addClass('is-loaded');
                    });
                }
            });

        $window.on('resize', $pluginInstance.debounce(1000, function() {
            $.each(mapInstances, function() {
                this.setCenter($.data(this, 'center'));
            });
        }));

    })(jQuery, window, document);







		//carousel active
        $(".carousel-inner .item:first-child").addClass("active");

		//Fixed nav on scroll
		$(document).scroll(function(e){
			var scrollTop = $(document).scrollTop();
			if(scrollTop > $('header nav').height()){
				//console.log(scrollTop);
				$('header nav').addClass('navbar-fixed-top');
			}
			else {
				$('header nav').removeClass('navbar-fixed-top');
			}
		});

			 //Portfolio Popup
    $('.magnific-popup').magnificPopup({type:'image'});

    });


	//Wow js
	new WOW().init();

}(jQuery));


 jQuery(window).load(function(){

    //Portfolio container
    var $container = jQuery('.portfolioContainer');
    $container.isotope({
      filter: '*',
      animationOptions: {
        duration: 750,
        easing: 'linear',
        queue: false
      }
    });

    jQuery('.portfolioFilter a').on('click', function(){
      jQuery('.portfolioFilter a').removeClass('current');
      jQuery(this).addClass('current');

      var selector = jQuery(this).attr('data-filter');
         $container.isotope({
        filter: selector,
        animationOptions: {
          duration: 750,
          easing: 'linear',
          queue: false
        }
       });
       return false;
    });

  });
