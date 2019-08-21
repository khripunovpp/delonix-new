ymaps.ready(function() {
    var myMap = new ymaps.Map('map', {
            center: [55.860288, 37.483318],
            zoom: 17,
            controls: ['zoomControl']
        }, {
            searchControlProvider: 'yandex#search'
        }),

        myPlacemark = new ymaps.Placemark([55.860288, 37.483318]);

    myMap.geoObjects.add(myPlacemark);

})