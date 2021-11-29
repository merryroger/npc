'use strict';

class NewsbandItem {

    constructor(id, ts) {
        this.newsId = id;
        this.timeStamp = ts;
        this.URL = '/asio/news';

        this.createItem();
    }

    createItem() {
        this.nbItem = document.createElement('a');
        this.nbItem.setAttribute('href', `/news?nid=${this.newsId}`);
        this.nbItem.classList = 'news__band__cell await__preview__data';
        this.nbItem.setAttribute('data-newsId', `${this.newsId}`);
        this.nbItem.setAttribute('data-stamp', this.timeStamp);
    }

    getItem() {
        return this.nbItem;
    }

    requestData(respCBF) {
        let params = [
            `_token=${this.getToken()}`,
            'opcode=RQPW',
            `nid=${this.newsId}`
        ];

        AJAX.post(this.URL, params.join('&'), respCBF);
    }

    handleResponse(resp) {
        let rsp, contents;
        try {
            rsp = JSON.parse(resp);
            contents = JSON.parse(rsp.contents);
        } catch (e) {
            console.log(e);
        } finally {
            this.nbItem.setAttribute('data-neighbours', contents.neighbours);
            this.nbItem.innerHTML = contents.text;
            this.nbItem.classList.remove('await__preview__data');
        }
    }

    getToken() {
        let fm = document.getElementById('search');
        return fm._token.value;
    }

}

newsBand = (() => {

    class NewsBand {

        constructor() {
            this.holder = null;
            this.band = null;
            this.items = {};
            this.vmap = { before: 0, visible: [], after: 0, total: 0 };
            this.vMapPtr = 0;
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

            this.sortItems();
            this.reMap(0);

            this.invalid = (this.holder == null || this.band == null);
        }

        needControlsOn() {
            if (this.invalid) {
                this.controlsOn = false;
                return this.controlsOn;
            }

            let state = this.controlsOn;
            this.controlsOn = (this.holder.offsetWidth < this.band.offsetWidth) || (this.bandCapacity > this.visibleItems);

            if (this.controlsOn) {
                this.checkInvalidState();
            }

            return (state ^ this.controlsOn) | this.controlsOn;
        }

        redrawControls() {
            if (this.controlsOn) {
                this.toggleControl(this.leftScroll, this.checkLeftScrollShowConditions());
                this.toggleControl(this.rightScroll, this.checkRightScrollShowConditions());
            } else {
                this.toggleControl(this.leftScroll, false);
                this.toggleControl(this.rightScroll, false);
            }
        }

        scrollLeft() {
            let id = this.vmap['visible'][this.visibleItems - 1]['id'];
            let item = this.band.querySelector(`.news__band__cell[data-newsId="${id}"]`);
            let neighbours = JSON.parse(atob(item.getAttribute('data-neighbours')));
            this.reCalcDelta(neighbours['after'].length);
            let shift = this.band.offsetLeft - this.holder.offsetLeft + this.delta;
            let siblings = {};

            neighbours['after'].forEach((siblingItem) => {
                for (let [ts, newsId] of Object.entries(siblingItem)) {
                    siblings[ts] = this.band.querySelector(`.news__band__cell[data-stamp="${ts}"]`);
                    if (siblings[ts] == null) {
                        siblings[ts] = new NewsbandItem(newsId, ts);
                        item.insertAdjacentElement('beforebegin', siblings[ts].getItem());
                        siblings[ts].requestData(siblings[ts].handleResponse.bind(siblings[ts]));
                        this.items[ts] = {id: newsId, item};
                        shift = 0;
                    }

                    item = this.band.querySelector(`.news__band__cell[data-newsId="${newsId}"]`);
                }
            });

            this.sortItems();
//            if (shift > 0) {
//                shift = 0;
//            } else {
//                let ss = shift % this.delta;
//                shift -= ss;
//            }
//console.log(shift);
            this.band.style.left = shift + 'px';
        }

        scrollRight() {
            let id = this.vmap['visible'][0]['id'];
            let item = this.band.querySelector(`.news__band__cell[data-newsId="${id}"]`);
            let neighbours = JSON.parse(atob(item.getAttribute('data-neighbours')));
            this.reCalcDelta(neighbours['before'].length);
            let shift = this.band.offsetLeft - this.holder.offsetLeft - this.delta;
            let siblings = {};

            neighbours['before'].forEach((siblingItem) => {
                for (let [ts, newsId] of Object.entries(siblingItem)) {
                    siblings[ts] = this.band.querySelector(`.news__band__cell[data-stamp="${ts}"]`);
                    if (siblings[ts] == null) {
                        siblings[ts] = new NewsbandItem(newsId, ts);
                        item.insertAdjacentElement('afterend', siblings[ts].getItem());
                        siblings[ts].requestData(siblings[ts].handleResponse.bind(siblings[ts]));
                        this.items[ts] = {id: newsId, item};
                    }

                    item = this.band.querySelector(`.news__band__cell[data-newsId="${newsId}"]`);
                }
            });

            this.sortItems();
//            if (shift + this.band.offsetWidth < this.holder.offsetWidth) {
//                shift = this.holder.offsetWidth - this.band.offsetWidth;
//            } else {
//                let ss = (this.holder.offsetWidth - this.band.offsetWidth) % this.delta;
//                shift += ss;
//            }
//console.log(this.band);
            this.band.style.left = shift + 'px';
        }

        checkLeftScrollShowConditions() {
            let c1 = this.band.offsetLeft < this.holder.offsetLeft;
            let c2 = this.after > 0;
            let c3 = this.lastNewsId != this.vmap['visible'][this.visibleItems - 1];

            return c1 || c2 || c3;
        }

        checkRightScrollShowConditions() {
            let c1 = this.holder.offsetLeft + this.holder.offsetWidth < this.band.offsetLeft + this.band.offsetWidth;
            let c2 = this.before > 0;
            let c3 = this.firstNewsId != this.vmap['visible'][0];

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

        sortItems() {
            this.items = Object.keys(this.items).sort().reduce((acc, key) => {
                acc[key] = this.items[key];
                return acc;
            }, {});
        }

        reMap(shift) {
            let keys = Object.keys(this.items);
            this.cleanMap(keys);
            this.vMapPtr += shift;
            this.vmap.visible = keys.slice(this.vMapPtr, this.visibleItems).map((key) => { return this.items[key]; });
            this.vmap.before = this.vMapPtr;
            this.vmap.after = this.vmap.total - this.vmap.before - this.vmap.visible.length;
        }

        cleanMap(keys) {
            this.vmap = null;
            this.vmap = { before: 0, visible: [], after: 0, total: keys.length };
        }

        reCalcDelta(steps) {
            let cnt = this.vmap['after'] + this.vmap['visible'].length + this.vmap['before'];
            let step = this.band.offsetWidth / cnt;
            this.delta = step * steps;
        }

        checkInvalidState() {
            if (this.band.offsetLeft + this.band.offsetWidth < this.holder.offsetLeft + this.holder.offsetWidth) {
                this.band.style.left = this.holder.offsetWidth - this.band.offsetWidth + 'px';
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
            self.reMap(-2);
            self.scrollLeft();
        },
        scrollRight: () => {
            self.reMap(2);
            self.scrollRight();
        },
        listen: (e) => {
            if (e.target == self.band) {
                self.redrawControls();
            }
        }
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
        zIndex: 5,
    };

    newsBand.init(params);
    document.body.addEventListener('transitionend', newsBand.listen);
}

__tasks.push(initNewsBand);
