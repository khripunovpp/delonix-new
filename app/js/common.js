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

        if(!$(target).hasClass('show')) return false

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

$(function() {
    servicesMenu()
    search()
});