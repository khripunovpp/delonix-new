
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
