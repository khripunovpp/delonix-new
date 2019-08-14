var Util = {
    randomInteger: function(min, max) {
        var rand = min + Math.random() * (max - min)
        rand = Math.round(rand);
        return rand;
    },
    scrollToEl: function(el, offset) {
        $("html,body").animate({ scrollTop: el.offset().top + (offset || 0) }, 500);
    },
    trimString: function(string) {
        return string.split(' ').join('');
    }
}

var servicesMenu = function() {

    $('.header .services, .servicesMain .services').masonry({
        itemSelector: '.services ul',
        columnWidth: '.services ul'
    });

    var trigger = $('.services-trigger'),
        servicesNav = $('.header__services'),
        timer;

    trigger.on('mouseenter', function() {
        $(servicesNav).addClass('show');
    })

    trigger.add(servicesNav).on('mouseenter', function() {
        clearTimeout(timer)
    })

    trigger.add(servicesNav).on('mouseleave', function() {
        timer = setTimeout(_close, 500)
    })

    function _close() {
        $(servicesNav).removeClass('show');
    }

    $('body').on('click', function(event) {
        if ($(event.target).closest('.header__services')) _close()
    });
}

var search = function() {
    var trigger = document.querySelector('.header__search'),
        $triggers = $('.header__search, .mobileNav__search'),
        searchComponent = $('.search'),
        closeSearchEl = $('.search__close'),
        target,
        cords;

    $triggers.on('click', function(event) {
        event.preventDefault();

        target = event.target

        if ($(window).width() > 991) {
            cords = _fixCords(_getCords(target))
        } else {
            cords = { top: 0, left: 0 }
        }

        $(target).hasClass('show') ? _hide() : _show()
    });

    closeSearchEl.on('click', _hide);

    $(window).on('resize', function(event) {
        event.preventDefault();

        if (!$(target).hasClass('show')) return false

        var newCords = _fixCords(_getCords(target))

        _moveAndShow(newCords)

        if ($(window).width() < 991) {
            searchComponent.css({
                top: 0,
                left: 0
            })
        }
    });

    $(window).on('scroll', function(event) {
        _hide()
    });

    function _show() {
        $(target).addClass('show')
        _moveAndShow(cords)
    }

    function _hide() {
        $(target).removeClass('show')
        searchComponent.hide().removeClass('show')
    }

    function _moveAndShow(cords) {
        searchComponent.css({
            top: cords.top,
            left: cords.left
        }).show().addClass('show');
    }

    function _fixCords(cords) {
        return {
            top: cords.top + $(target).outerHeight() + 14,
            left: cords.left - searchComponent.outerWidth() + $(target).outerWidth()
        };
    }

    function _getCords(elem) {
        var box = elem.getBoundingClientRect();

        return {
            top: box.top + pageYOffset,
            left: box.left + pageXOffset
        };
    }
}

var mobileMenu = function() {
    var trigger = $('.mobileNav__burger'),
        menu = $('.mobileNav__menu'),
        cloaseMenuEl = $('.mobileMenu__close');

    trigger.on('click', function(event) {
        event.preventDefault();
        menu.addClass('show')
    });

    cloaseMenuEl.on('click', function(event) {
        event.preventDefault();
        menu.removeClass('show')
    });
}

var popups = function() {
    var trigger = $('.js-openpopup'),
        closePopupEl = $('.popup__close');

    trigger.on('click', function(event) {
        event.preventDefault();
        $('.popup#' + $(event.target).attr('data-popup-id')).fadeIn(300);
    });

    closePopupEl.on('click', function(event) {
        event.preventDefault();
        $(event.target).closest('.popup').fadeOut(100)
    });
}

var setImgRatio = function(el) {
    $(el).each(function() {
        var fillClass = ($(this).height() > $(this).width()) ?
            'fillheight' :
            'fillwidth';
        $(this).addClass(fillClass);
    });
}

var fixedMenu = function() {

    var headerEl = $('.header'),
        main = $('.main'),
        lastScrollTop = 0,
        scrollDirection = '';
    _setTopOffset()
    $(window).on('resize', _setTopOffset);
    $(window).on('scroll', function() {
        _getScrollDirection()
        scrollDirection == 'down' ? headerEl.addClass('collapsed') : headerEl.removeClass('collapsed')
        msnr.masonry('reloadItems')
    });


    function _setTopOffset() {
        if ($(window).width() > 991) {
            main.css("margin-top", headerEl.height())
        } else {
            main.removeAttr('style')
        }
    }

    function _getScrollDirection() {
        var st = $(this).scrollTop();
        if (st > lastScrollTop) {
            scrollDirection = "down"
        } else {
            scrollDirection = "up"
        }
        lastScrollTop = st;
    }
}

var closedForms = function() {
    $('.js-openeform').on('click', function(event) {
        event.preventDefault();
        $(this).closest('.form').find('.form__inner').slideToggle()
        $(this).removeClass('js-openeform').addClass('js-submit')
    });
}


$(function() {
    servicesMenu()

    ////
    $('#mainstyle').attr('href', $('#mainstyle').attr('href') + "?" + Util.randomInteger(0, 150) + Util.randomInteger(0, 150) + Util.randomInteger(0, 150))
    ////

    search()
    mobileMenu()
    popups()

    $('.slider').slick({
        dots: true
    })

    $('.portfolioMain__list').lightGallery({ selector: '.portfolioMain__item' })

    $('.portfolioMain__list').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }]
    })

    $('.clientsMain__list').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    })

    $('.opinionMain__list').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    })

    setImgRatio('.portfolioMain__item img')

    $("[name=phone]").mask("+7 (999) 999-99-99");

    $('.miniGallery').lightGallery()

    $('.miniGallery').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        adaptiveHeight: true,
        arrows: false,
        dots: true,
        infinite: false,
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    })

    $('.slideShow').slick({
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false
    })

    $('.hero__slider').slick({
        autoplay: true,
        autoplaySpeed: 5000,
        arrows: false,
        fade: true,
        cssEase: 'linear'
    })

    closedForms()

    // fixedMenu()
});