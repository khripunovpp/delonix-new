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

    $('.services').masonry({
  // options
  itemSelector: '.services ul'
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

$(function() {
    $('#mainstyle').attr('href', $('#mainstyle').attr('href') + "?" + Util.randomInteger(0, 150)+Util.randomInteger(0, 150)+Util.randomInteger(0, 150))
    servicesMenu()
    search()
    mobileMenu()
    popups()
});