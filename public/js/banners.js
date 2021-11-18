'use strict';

bannerCarousel = (() => {

    class BannerCarousel {

        constructor() {
            this.holder = null;
            this.holderRect = {};
            this.band = null;
            this.bandRect = {};
            this.leftScroll = null;
            this.rightScroll = null;
            this.carouselOn = false;
            this.zIndex = -1;
            this.delta = 1;
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
                this.checkInvalidState();
                this.reCalcCoordRects();
            }

            return (state ^ this.carouselOn) | this.carouselOn;
        }

        redrawControls() {
            if (this.carouselOn) {
                this.band.style.position = 'relative';
                this.toggleControl(this.leftScroll, this.band.offsetLeft < this.holder.offsetLeft);
                this.toggleControl(this.rightScroll, this.holder.offsetLeft + this.holder.offsetWidth < this.band.offsetLeft + this.band.offsetWidth);
            } else {
                this.band.style.position = 'inherit';
                this.toggleControl(this.leftScroll, false);
                this.toggleControl(this.rightScroll, false);
            }
        }

        scrollLeft() {
            let shift = this.band.offsetLeft - this.holder.offsetLeft + this.delta;
            if (shift > 0) {
                shift = 0;
            } else {
                let ss = shift % this.delta;
                shift -= ss;
            }

            this.band.style.left = shift + 'px';
        }

        scrollRight() {
            let shift = this.band.offsetLeft - this.holder.offsetLeft - this.delta;
            if (shift + this.band.offsetWidth < this.holder.offsetWidth) {
                shift = this.holder.offsetWidth - this.band.offsetWidth;
            } else {
                let ss = (this.holder.offsetWidth - this.band.offsetWidth) % this.delta;
                shift += ss;
            }

            this.band.style.left = shift + 'px';
        }

        toggleControl(ctrl, showUp) {
            if (showUp) {
                ctrl.style.zIndex = this.zIndex;
                ctrl.style.visibility = 'visible';
            } else {
                ctrl.style.visibility = 'hidden';
                ctrl.style.zIndex = -1;
            }
        }

        checkInvalidState() {
            if (this.band.offsetLeft + this.band.offsetWidth < this.holder.offsetLeft + this.holder.offsetWidth) {
                this.band.style.left = this.holder.offsetWidth - this.band.offsetWidth + 'px';
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
        },
        scrollLeft: () => {
            self.scrollLeft();
        },
        scrollRight: () => {
            self.scrollRight();
        },
        listen: (e) => {
            self.redrawControls();
        }
    }

})();

function initBannerCarousel() {
    let params = {
        holder: document.body.querySelector('div.banner__band__pad'),
        band: document.body.querySelector('div.banner__band'),
        leftScroll: document.body.querySelector('div.banner__ctrls.scroll__left'),
        rightScroll: document.body.querySelector('div.banner__ctrls.scroll__right'),
        delta: 132,
        zIndex: 5,
    };

    bannerCarousel.init(params);
    document.body.addEventListener('transitionend', bannerCarousel.listen);
}

__tasks.push(initBannerCarousel);
