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

$(function() {
    servicesMenu()
});