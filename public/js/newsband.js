'use strict';

newsBand = (() => {

    class NewsBand {

        constructor() {
            this.holder = null;
            this.band = null;
            this.items = {};
            this.map = { after: [], visible: [], before: [] };
            this.bandCapacity = 0;
            this.visibleItems = 0;
            this.newsId = 0;
            this.lastNewsId = 0;
            this.firstNewsId = 0;
            this.leftScroll = null;
            this.rightScroll = null;
            this.controlsOn = true;
            this.zIndex = -1;
            this.delta = 1;
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
                this.reMap();
                this.toggleControl(this.leftScroll, this.checkLeftScrollShowConditions());
                this.toggleControl(this.rightScroll, this.checkRightScrollShowConditions());
            } else {
                this.toggleControl(this.leftScroll, false);
                this.toggleControl(this.rightScroll, false);
            }
        }

        scrollLeft() {
            let shift = this.band.offsetLeft - this.holder.offsetLeft + this.delta;

//            if (shift > 0) {
//                shift = 0;
//            } else {
//                let ss = shift % this.delta;
//                shift -= ss;
//            }
//console.log(shift);
//            this.band.style.left = shift + 'px';
        }

        scrollRight() {
            let shift = this.band.offsetLeft - this.holder.offsetLeft - this.delta;
            let id = this.map['visible'][this.visibleItems - 1];
            let item = this.band.querySelector(`.news__band__cell[data-newsId="${id}"]`);
            let neighbours = JSON.parse(atob(item.getAttribute('data-neighbours')));
            neighbours['before'].forEach((item) => {
                for (let [ts, newsId] of Object.entries(item)) {
//                    console.log(this.band.querySelector(`.news__band__cell[data-stamp="${ts}"]`));
                }
            });

//            if (shift + this.band.offsetWidth < this.holder.offsetWidth) {
//                shift = this.holder.offsetWidth - this.band.offsetWidth;
//            } else {
//                let ss = (this.holder.offsetWidth - this.band.offsetWidth) % this.delta;
//                shift += ss;
//            }
//console.log(neighbours['before']);
//            this.band.style.left = shift + 'px';
        }

        checkLeftScrollShowConditions() {
            let c1 = this.band.offsetLeft < this.holder.offsetLeft;
            let c2 = this.map['after'].length > 0;
            let c3 = this.lastNewsId != this.map['visible'][0];

            return c1 || c2 || c3;
        }

        checkRightScrollShowConditions() {
            let c1 = this.holder.offsetLeft + this.holder.offsetWidth < this.band.offsetLeft + this.band.offsetWidth;
            let c2 = this.map['before'].length > 0;
            let c3 = this.firstNewsId != this.map['visible'][this.visibleItems - 1];

            return c1 || c2 || c3;
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

        reMap() {
            let rect;
            let lastState = false, state;
            let pointer = 0;
            let section = ['after', 'visible', 'before'];
            this.cleanMap();
            for (let item of Object.values(this.items)) {
                rect = getCoordsRect(item.item);
                state = rect.left >= this.holder.offsetLeft && Math.floor(rect.left + rect.width) <= Math.ceil(this.holder.offsetLeft + this.holder.offsetWidth) + 2;
                if (state ^ lastState) {
                    pointer++;
                    lastState = state;
                }

                this.map[section[pointer]].push(item.id);
            }
        }

        cleanMap() {
            this.map = null;
            this.map = { after: [], visible: [], before: [] };
        }

        reCalcDelta() {
            let cnt = this.map['after'].length + this.map['visible'].length + this.map['before'].length;
            let step = this.band.offsetWidth / cnt;
            this.delta = step * (this.visibleItems - 1);
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
            self.reCalcDelta();
            self.scrollLeft();
        },
        scrollRight: () => {
            self.reCalcDelta();
            self.scrollRight();
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
                //neighbours: JSON.parse(atob(item.getAttribute('data-neighbours'))),
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
        zIndex: 5,
    };

    newsBand.init(params);
//    document.body.addEventListener('transitionend', newsBand.listen);
}

__tasks.push(initNewsBand);
