'use strict';

newsBand = (() => {

    class NewsBand {

        constructor() {
            this.holder = null;
            this.band = null;
            this.items = {};
            this.bandCapacity = 0;
            this.visibleItems = 0;
            this.newsId = 0;
            this.lastNewsid = 0;
            this.firstNewsId = 0;
            this.leftScroll = null;
            this.rightScroll = null;
            this.controlsOn = true;
            this.zIndex = -1;
//            this.delta = 1;
            this.invalid = true;
        }

        init(params) {
            for (let [pmName, pmValue] of Object.entries(params)) {
                this[pmName] = pmValue;
            }

            this.invalid = (this.holder == null || this.band == null);
        }

        needControlsOn() {
            if (this.invalid) {
                this.controlsOn = false;
                return this.controlsOn;
            }

            let state = this.controlsOn;
            this.controlsOn = (this.holder.offsetWidth < this.band.offsetWidth) || (this.bandCapacity > this.visibleItems);

            return (state ^ this.controlsOn) | this.controlsOn;
        }

        redrawControls() {
            if (this.controlsOn) {
  //              this.toggleControl(this.leftScroll, this.band.offsetLeft < this.holder.offsetLeft);
 //               this.toggleControl(this.rightScroll, this.holder.offsetLeft + this.holder.offsetWidth < this.band.offsetLeft + this.band.offsetWidth);
            } else {
  //              this.toggleControl(this.leftScroll, false);
 //               this.toggleControl(this.rightScroll, false);
            }
        }
/*
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
*/
        toggleControl(ctrl, showUp) {
            if (showUp) {
                ctrl.style.zIndex = this.zIndex;
                ctrl.style.visibility = 'visible';
            } else {
                ctrl.style.visibility = 'hidden';
                ctrl.style.zIndex = -1;
            }
        }

    }

    let self = new NewsBand();

    return {
        init: (params = {}) => {
            self.init(params);
            self.needControlsOn();
            self.redrawControls();
        },
        resize: () => {
            if (self.needControlsOn()) {
                self.redrawControls();
            }
        },
        scrollLeft: () => {
//            self.scrollLeft();
        },
        scrollRight: () => {
//            self.scrollRight();
        },
//        listen: (e) => {
//            if (e.target == self.band) {
//                self.redrawControls();
//            }
//        }
    }

})();

function initNewsBand() {
    let items = {};
    let holder = document.body.querySelector('div.news__preview__pad');
    let band = document.body.querySelector('nav.news__preview__band');

    if (band !== null) {
        Array.from(band.querySelectorAll('.news__band__cell')).forEach((item) => {
            items[item.getAttribute('data-stamp')] = {
                id: +item.getAttribute('data-newsId'),
                item
            }
        });
    }

    let params = (band === null) ? {} : {
        holder,
        band,
        items,
        bandCapacity: +holder.getAttribute('data-capacity'),
        visibleItems: +holder.getAttribute('data-visible'),
        newsId: +holder.getAttribute('data-current'),
        lastNewsId: +holder.getAttribute('data-last'),
        firstNewsId: +holder.getAttribute('data-first'),
        leftScroll: document.body.querySelector('div.news__band__ctrls.scroll__left'),
        rightScroll: document.body.querySelector('div.news__band__ctrls.scroll__right'),
//        delta: 132,
        zIndex: 5,
    };
//console.log(params);
    newsBand.init(params);
//    document.body.addEventListener('transitionend', newsBand.listen);
}

__tasks.push(initNewsBand);
