'use strict';

bannerCarousel = (() => {

    class BannerCarousel {

        constructor() {
            this.holder = null;
            this.holderRect = {};
            this.band = null;
            this.bandRect = {};
            this.carouselOn = false;
        }

        init(params) {
            for (let [pmName, pmValue] of Object.entries(params)) {
                this[pmName] = pmValue;
            }
        }

        reCalcCoordRects() {
            this.holderRect = getCoordsRect(this.holder);
            this.bandRect = getCoordsRect(this.band);
        }

        needCarouselOn() {
            let state = this.carouselOn;
            this.carouselOn = this.holder.offsetWidth < this.band.offsetWidth;
            if (this.carouselOn) {
                this.reCalcCoordRects();
            }

            return state ^ this.carouselOn;
        }

        redrawControls() {
            if (this.carouselOn) {
                this.band.style.position = 'relative';
//console.log('show controls');
            } else {
                this.band.style.position = 'inherit';
//console.log('hide controls');
            }
        }

    }

    let self = new BannerCarousel();

    return {
        init: (params = {}) => {
            self.init(params);
            self.needCarouselOn();
            self.redrawControls();
        },
        pointerMove: (src, e) => {

        },
        resize: () => {
            if (self.needCarouselOn()) {
                self.redrawControls();
            }
        }
    }

})();

function initBannerCarousel() {
    let params = {
        holder: document.getElementById('banners'),
        band: document.body.querySelector('div.banner__band'),
    };

    bannerCarousel.init(params);
}

__tasks.push(initBannerCarousel);

/*
function bannerCarousel(src, e) {
    let holder = src.closest('section#banners');
    let band = holder.querySelector('div.banner__band');

    //console.log(holder.offsetWidth < band.offsetWidth);
    //console.log(getCoordsRect(holder));
    //console.log(e.clientX, e.clientY + window.scrollY);
}
*/