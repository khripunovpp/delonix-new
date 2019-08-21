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
    },
    translit: function(str) {

        var ru = {
                'а': 'a',
                'б': 'b',
                'в': 'v',
                'г': 'g',
                'д': 'd',
                'е': 'e',
                'ё': 'e',
                'ж': 'j',
                'з': 'z',
                'и': 'i',
                'к': 'k',
                'л': 'l',
                'м': 'm',
                'н': 'n',
                'о': 'o',
                'п': 'p',
                'р': 'r',
                'с': 's',
                'т': 't',
                'у': 'u',
                'ф': 'f',
                'х': 'h',
                'ц': 'c',
                'ч': 'ch',
                'ш': 'sh',
                'щ': 'shch',
                'ы': 'y',
                'э': 'e',
                'ю': 'u',
                'я': 'ya'
            },
            n_str = [];

        str = str.replace(/[ъь]+/g, '').replace(/й/g, 'i');

        for (var i = 0; i < str.length; ++i) {
            n_str.push(
                ru[str[i]] ||
                ru[str[i].toLowerCase()] == undefined && str[i] ||
                ru[str[i].toLowerCase()].replace(/^(.)/, function(match) { return match.toUpperCase() })
            );
        }

        return n_str.join('');
    },
    slugify: function(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-') // Replace spaces with -
            .replace(/\-\-+/g, '-') // Replace multiple - with single -
            .replace(/^-+/, '') // Trim - from start of text
            .replace(/-+$/, ''); // Trim - from end of text
    }
}

var msnr;

var servicesMenu = function() {

    msnr = $('.header .services, .servicesMain .services, .servicesPage .services').masonry({
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
        console.log(cords)
        return {
            top: $('.header').outerHeight(),
            left: cords.left - searchComponent.outerWidth() + $(target).outerWidth()
        };
    }

    function _getCords(elem) {
        var box = elem.getBoundingClientRect();

        return {
            top: box.top,
            left: box.left
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
var fixedMenu = function() {

    var headerEl = $('.header'),
        main = $('.main');

    $(window).on('scroll', function() {
        $(this).scrollTop() > 0 ? headerEl.addClass('collapsed') : headerEl.removeClass('collapsed')
        msnr.masonry('layout')
    });
}

var closedForms = function() {
    $('.js-openeform').on('click', function(event) {
        event.preventDefault();
        $(this).closest('.form').find('.form__inner').slideToggle()
        $(this).removeClass('js-openeform').addClass('js-submit')
    });
}

var reviews = function() {
    var reviewsList = $('.reviews__list'),
        hiddens;

    $('.reviews__more').on('click', function(event) {
        event.preventDefault();
        hiddens = $('.reviews__hidden').children()
        reviewsList.append(hiddens.last())
        if (hiddens.length == 1) $(this).remove()
    });
}

$(window).on('load', function() {
    $('.loader').fadeOut();
});

$(function() {
    fixedMenu()
    servicesMenu()
    search()
    mobileMenu()
    popups()
    closedForms()
    reviews()

    $("[name=phone]").mask("+7 (999) 999-99-99");
});