ymaps.ready(function() {
    var myMap = new ymaps.Map('map', {
            center: [55.8606459, 37.481077],
            zoom: 17,
            controls: ['zoomControl']
        }, {
            searchControlProvider: 'yandex#search'
        }),

        myPlacemark = new ymaps.Placemark([55.86123, 37.480959]);

    myMap.geoObjects.add(myPlacemark);

})