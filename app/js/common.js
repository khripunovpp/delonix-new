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
    }
}

$.fn.isotopeImagesReveal = function($items) {
    var iso = this.data('isotope');
    var itemSelector = iso.options.itemSelector;
    $items.hide();
    this.append($items);
    $items.imagesLoaded().progress(function(imgLoad, image) {
        var $item = $(image.img).parent();
        $item.show();
        iso.appended($item);
    });

    $items.imagesLoaded().always(function(instance) {
        $(iso.element).parent().removeClass('portfolio--loading')
    });

    return this;
};

var Portfolio = {
    options: {
        portfolio: $('.portfolio'),
        gallery: $('.portfolio__list'),
        portfolioLinks: _.shuffle(JSON.parse($('.portfolio__list').attr('data-json'))),
        loadingItems: 12,
        loadingClass: 'portfolio--loading',
        infiniteScrollClass: 'portfolio--infiniteScroll',
        galleryOptions: {
            thumbnail: true,
            download: false,
            share: false,
            selector: '.portfolio__item'
        },
        lastFilter: '*',
        items: '',
        types: '',
        itemsSelector: '.portfolio__item',
        moreBtnClass: 'portfolio__more',
        filterBtnClass: 'filter__but'
    },
    init: function() {
        var _t = this,
            _o = _t.options;

        $('body').on('click', function(event) {
            var target = $(event.target)

            if (target.hasClass(_o.moreBtnClass)) {
                _t.loadMore.call(_t)
            } else if (target.hasClass(_o.filterBtnClass)) {
                var type = target.attr('data-filter')
                target.addClass('active').siblings().removeClass('active')
                _t.filterItems(type)
            } else return;
        });

        var uniqsByType = _.uniqBy(_o.portfolioLinks, 'type')

        _t._renderFilter(uniqsByType)

        _o['grid'] = _o.gallery.isotope({
            itemSelector: '.portfolio__item',
            layoutMode: 'fitRows'
        });

        _o.gallery.lightGallery(_o.galleryOptions)

        _t.loadMore('*')
    },
    loadMore: function(type) {
        var _t = this,
            _o = _t.options;

        _o.portfolio.addClass(_o.infiniteScrollClass);
        _o.portfolio.addClass(_o.loadingClass);

        var links = _t._getLinks(type);
        _o.items = _t._getItems(links);
        _o.grid.isotopeImagesReveal(_o.items);
        _o.portfolioLinks = _.compact(_o.portfolioLinks)
        if(_o.portfolioLinks.length == 0) $('.portfolio__more').hide()
        _t._updateGallery()
    },
    _getLinks: function(type) {
        var _t = this,
            _o = _t.options,
            links = [],
            deletes = _o.loadingItems;

        type = type || _o.lastFilter

        if (type != "*") {
            _o.lastFilter = type
            _o.portfolioLinks.forEach(function(el, i) {
                if ('.' + el.type == type && deletes > 0) {
                    links.push(el)
                    delete _o.portfolioLinks[i]
                    deletes--
                }
            })
        } else {
            links = _o.portfolioLinks
        }

        return links.splice(0, _o.loadingItems);
    },
    _getItems: function(linksArr) {
        var _t = this,
            _o = _t.options;
        var items = '';
        for (var i = 0; i < linksArr.length; i++) {
            items += _t._buildItem(linksArr[i]);
        }
        return $(items);
    },
    _buildItem: function(item) {
        return '<a href="' + item.link + '" class="portfolio__item ' + Util.translit(item.type) + '"><img src="' + item.link + '" /></a>';
    },
    filterItems: function(type) {
        var _t = this,
            _o = _t.options;

        var hasElements = $(_o.gallery).find(type).length;

        _o.lastFilter = type;

        !hasElements && _t.loadMore(_o.lastFilter);
        _o.grid.isotope({ filter: _o.lastFilter });
        _t._updateGallery()
    },
    _updateGallery: function() {
        var _t = this,
            _o = _t.options;

        _o.gallery.data('lightGallery').destroy(true)
        _o.galleryOptions.selector = _o.lastFilter != '*' ? _o.lastFilter : _o.itemsSelector
        _o.gallery.lightGallery(_o.galleryOptions)
    },
    _renderFilter: function(uniqs) {
        var _t = this,
            _o = _t.options;

        var filterContainer = $('.filter'),
            filtersButtons = document.createDocumentFragment();

        filtersButtons.append(_createButton())
        uniqs.forEach(function(el) {
            filtersButtons.append(_createButton(el.type))
        })

        function _createButton(type) {
            var filterBut = document.createElement('button'),
                label = type || 'Все';

            type = type ? '.' + type : '*';
            $(filterBut).addClass('filter__but').attr('data-filter', Util.translit(type)).text(label)
            return filterBut
        }

        filterContainer.append(filtersButtons)
        filterContainer.children().first().addClass('active')
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

    reviews()
});