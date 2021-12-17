'use strict';

const esl_1 = "https://api-maps.yandex.ru/2.1/?lang=ru_RU";

function loadForeignScript(fs) {
    let esl = document.createElement('script');
    esl.src = fs;
    esl.type = "text/javascript";
    document.getElementsByTagName('head')[0].appendChild(esl);
}

function init1() {
    let mainMap = new ymaps.Map("npc_office", {
        center: [55.435834921579354, 65.34707196056827],
        zoom: 18,
        controls: ['zoomControl', 'typeSelector', 'fullscreenControl']
    });

    let myPlacemark = new ymaps.Placemark([55.435834921579354, 65.34707196056827], {
        iconCaption: 'НПЦ, ул. Советская, 69',
        hintContent: 'Здание НПЦ, ул. Советская, 69',
        balloonContent: 'Здание НПЦ, ул. Советская, 69'
    }, {
        preset: 'islands#blueDotIcon'
    });

    mainMap.geoObjects.add(myPlacemark);
}

function initMaps() {
    ymaps.ready(init1);
}

loadForeignScript(esl_1);

__tasks.push(initMaps);
