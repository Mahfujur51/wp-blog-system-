 
;(function($) {
 
    'use strict'
 
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };
 
    var testimonialCarousel = function(){
        if ( $().owlCarousel ) {
            $(".roll-testimonials").owlCarousel({
                navigation : false,
                pagination: true,
                responsive: true,
                items: 1,
                itemsDesktop: [3000,1],
                itemsDesktopSmall: [1400,1],
                itemsTablet:[970,1],
                itemsTabletSmall: [600,1],
                itemsMobile: [360,1],
                touchDrag: true,
                mouseDrag: true,
                autoHeight: true,
                autoPlay: false
            });
        }
    };
 
    var parallax = function() {
        var iOS = navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false;
        if ( !iOS ) {
            $('.parallax').css({backgroundAttachment:'fixed'});
        } else {
            $('.parallax').css({backgroundAttachment:'scroll'});
        }
       
        if ( $().parallax && isMobile.any() == null ) {
            $('.parallax').parallax("50%", 0.3);
 
        }
    };
 
    var panels = function() {
        $(".panel-row-style").each( function() {
            if ($(this).data('hascolor')) {
                $(this).find('h1,h2,h3,h4,h5,h6,a,.fa, div, span').css('color','inherit');
            }
            if ($(this).data('hasbg')) {
                $(this).append( '<div class="row-overlay"></div>' );
            }           
        });
    };  
 
    var smoothScroll = function() {
        $(function() {
          $('a[href*="#"]:not([href="#"],.wc-tabs a,.activity-content a)').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
              var target = $(this.hash);
              target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
              if (target.length) {
                $('html,body').animate({
                  scrollTop: target.offset().top - 70
                }, 1000);
                return false;
              }
            }
          });
        });
    };        
 
    var goTop = function() {
        $(window).scroll(function() {
            if ( $(this).scrollTop() > 800 ) {
                $('.go-top').addClass('show');
            } else {
                $('.go-top').removeClass('show');
            }
        });
 
        $('.go-top').on('click', function() {
            $("html, body").animate({ scrollTop: 0 }, 1000);
            return false;
        });
    };
 
    var responsiveMenu = function() {
        var menuType = 'desktop';
 
        $(window).on('load resize', function() {
            var currMenuType = 'desktop';
 
            if ( matchMedia( 'only screen and (max-width: 1024px)' ).matches ) {
                currMenuType = 'mobile';
            }
 
            if ( currMenuType !== menuType ) {
                menuType = currMenuType;
 
                if ( currMenuType === 'mobile' ) {
                    var $mobileMenu = $('#mainnav').attr('id', 'mainnav-mobi').hide();
                    var hasChildMenu = $('#mainnav-mobi').find('li:has(ul)');
 
                    $('#header').find('.header-wrap').after($mobileMenu);
                    hasChildMenu.children('ul').hide();
                    hasChildMenu.children('a').after('<span class="btn-submenu"></span>');
                    $('.btn-menu').removeClass('active');
                } else {
                    var $desktopMenu = $('#mainnav-mobi').attr('id', 'mainnav').removeAttr('style');
 
                    $desktopMenu.find('.submenu').removeAttr('style');
                    $('#header').find('.menu-wrapper').append($desktopMenu);
                    $('.btn-submenu').remove();
                }
            }
        });
 
        $('.btn-menu').on('click', function() {
            $('#mainnav-mobi').slideToggle(300);
            $(this).toggleClass('active');
        });
 
        $(document).on('click', '#mainnav-mobi li .btn-submenu', function(e) {
            $(this).toggleClass('active').next('ul').slideToggle(300);
            e.stopImmediatePropagation()
        });
    }
 
    var responsiveVideo= function(){
        if ( $().fitVids ) {
            $('body').fitVids();
        }
    };
 
    var progressBars = function() {
        $('.roll-progress').each(function(){
            $(this).find('.bar').on('on-appear', function() {
                $(this).each(function() {
                    var percent = $(this).data('percent');
 
                    $(this).find('.animate').animate({
                        "width": percent + '%'
                    },3000);
 
                    $(this).parent('.roll-progress').find('.perc').addClass('show').animate({
                        "width": percent + '%'
                    },3000);
                });
            });
        })
    };
 
    var toggles = function() {
        var args = {duration: 300};
        $('.rocked-toggle .toggle-title.active').siblings('.toggle-content').show();
 
        $('.rocked-toggle.enable .toggle-title').on('click', function() {
            $(this).closest('.roll-toggle').find('.toggle-content').slideToggle(args);
            $(this).toggleClass('active');
        }); // toggle
 
        $('.rocked-accordion .toggle-title').on('click', function () {
            if( !$(this).is('.active') ) {
                $(this).closest('.rocked-accordion').find('.toggle-title.active').toggleClass('active').next().slideToggle(args);
                $(this).toggleClass('active');
                $(this).next().slideToggle(args);
            } else {
                $(this).toggleClass('active');
                $(this).next().slideToggle(args);
            }    
        }); // accordion
    };
 
    var postCarousel = function() {
        $('.roll-works').each(function(){
            var $this = $(this);
            if ( $().owlCarousel ) {
                $this.find(".work-wrap").owlCarousel({
                    autoPlay: 4000,
                    slideSpeed: 1000,
                    navigation: true,
                    pagination: true,
                    itemsCustom: [[0, 1], [480, 2], [768, 2], [992, 3], [1200, 4]]
                });
            }
        });
    };
 
    var counter = function() {
        $('.roll-counter').on('on-appear', function() {
            $(this).find('.numb-count').each(function() {
                var to = parseInt($(this).attr('data-to')), speed = parseInt($(this).attr('data-speed'));
                $(this).countTo({
                    to: to,
                    speen: speed
                });
            });
        }); //counter
    };
 
    var headerFixed = function() {
        if ( $('body').hasClass('header-fixed') ) {
            var nav = $('#header');
 
            if ( nav.size() != 0 ) {
                var offsetTop = $('#header').offset().top,
                    headerHeight = $('#header').height(),
                    injectSpace = $('<div class="clone-nav" />', { height: headerHeight }).insertAfter(nav);
 
                $(window).on('load scroll', function(){
                    if ( $(window).scrollTop() > offsetTop + 100 ) {
                        $('#header').addClass('downscrolled');
                         injectSpace.show();
                    } else {
                        $('#header').removeClass('small downscrolled');
                        injectSpace.hide();
                    }
 
                    if ( $(window).scrollTop() > 650 ) {
                        $('#header').addClass('small upscrolled');
                    } else {
                        $('#header').removeClass('upscrolled');
 
                    }
                })
            }
        }    
    }
 
    var removePreloader = function() {
        $('.preloader').css('opacity', 0);
        setTimeout(function() {
            $('.preloader').hide();}, 600
        );  
    };
 
    var socials = function() {
        $( '.social-navigation li a' ).attr( 'target','_blank' );
    };    
 
    var detectViewport = function() {
        $('[data-waypoint-active="yes"]').waypoint(function() {
            $(this).trigger('on-appear');
        }, { offset: '90%', triggerOnce: true });
 
        $(window).on('load', function() {
            setTimeout(function() {
                $.waypoints('refresh');
            }, 100);
        });
    };
    // Dom Ready
    $(function() {
        responsiveMenu();
        headerFixed();
        testimonialCarousel();
        responsiveVideo();
        progressBars();
        toggles();
        postCarousel();
        counter();
        goTop();
        parallax();
        panels();
        socials();
        smoothScroll();
        detectViewport();
        removePreloader();
    });
 
})(jQuery);