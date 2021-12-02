'use strict';

class NewsbandItem {

    constructor(id, ts, ng) {
        this.newsId = id;
        this.timeStamp = ts;
        this.neighbours = ng;
        this.href = `/news?nid=${this.newsId}`;
        this.classList = ['news__band__cell'];
        this.nbItem = null;
    }

    createAnchorItem(cts = '') {
        this.nbItem = document.createElement('a');
        this.nbItem.setAttribute('href', this.href);
        this.nbItem.className = this.classList.join(' ');
        this.nbItem.setAttribute('data-newsId', `${this.newsId}`);
        this.nbItem.setAttribute('data-stamp', this.timeStamp);
        if (this.neighbours !== undefined && this.neighbours !== null) {
            this.nbItem.setAttribute('data-neighbours', this.neighbours);
        }

        this.nbItem.setAttribute('onclick', `return newsBand.loadNews(${this.newsId})`);

        if (cts) {
            this.nbItem.innerHTML = cts;
        }
    }

    createDIVItem(cts = '') {
        this.nbItem = document.createElement('div');
        this.nbItem.className = this.classList.join(' ');
        this.nbItem.setAttribute('data-newsId', `${this.newsId}`);
        this.nbItem.setAttribute('data-stamp', this.timeStamp);
        if (this.neighbours !== undefined && this.neighbours !== null) {
            this.nbItem.setAttribute('data-neighbours', this.neighbours);
        }

        if (cts) {
            this.nbItem.innerHTML = cts;
        }
    }

    getItem() {
        return this.nbItem;
    }
}

class NewsbandPreview extends NewsbandItem {

    constructor(id, ts, ng = null) {
        super(id, ts, ng);
        this.URL = '/asio/news';
        this.classList.push('await__preview__data');

        this.createAnchorItem();
    }

    requestData(respCBF) {
        let params = [
            `_token=${getToken()}`,
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
            document.body.dispatchEvent(new CustomEvent('gotPreview', {
                detail: {
                    nid: this.newsId
                }
            }));
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
            this.map = {before: 0, visible: [], after: 0};
            this.latestVisible = 0;
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
            this.scrollLocked = 0;
        }

        init(params) {
            for (let [pmName, pmValue] of Object.entries(params)) {
                this[pmName] = pmValue;
            }

            this.sortItems();

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
                this.reMap();
                this.toggleControl(this.leftScroll, this.checkLeftScrollShowConditions());
                this.toggleControl(this.rightScroll, this.checkRightScrollShowConditions());
            } else {
                this.toggleControl(this.leftScroll, false);
                this.toggleControl(this.rightScroll, false);
            }
        }

        scrollLeft() {
            if (!this.scrollLocked) {
                this.scrollLocked += 1000000;
                let id = this.items[this.map['visible'][this.map['visible'].length - 1]].id;
                let item = this.band.querySelector(`.news__band__cell[data-newsId="${id}"]`);
                let neighbours = JSON.parse(atob(item.getAttribute('data-neighbours')));
                this.reCalcDelta(neighbours['after'].length);
                this.latestVisible += neighbours['after'].length;
                if (this.latestVisible >= this.bandCapacity) {
                    this.latestVisible = this.bandCapacity - 1;
                }
                let shift = this.band.offsetLeft - this.holder.offsetLeft + this.delta;
                let siblings = {};

                neighbours['after'].forEach((siblingItem) => {
                    for (let [ts, newsId] of Object.entries(siblingItem)) {
                        siblings[ts] = this.band.querySelector(`.news__band__cell[data-stamp="${ts}"]`);
                        if (siblings[ts] == null) {
                            this.scrollLocked += newsId;
                            siblings[ts] = new NewsbandPreview(newsId, ts);
                            item.insertAdjacentElement('beforebegin', siblings[ts].getItem());
                            siblings[ts].requestData(siblings[ts].handleResponse.bind(siblings[ts]));
                            this.items[ts] = {id: newsId, item};
                            shift = 0;
                        }

                        item = this.band.querySelector(`.news__band__cell[data-newsId="${newsId}"]`);
                    }
                });

                this.sortItems();

                this.band.style.left = shift + 'px';
                siblings = null;

                if (this.scrollLocked > 1000000) {
                    this.scrollLocked -= 1000000;
                }
            }
        }

        scrollRight() {
            if (!this.scrollLocked) {
                this.scrollLocked += 1000000;
                let id = this.items[this.map['visible'][0]].id;
                let item = this.band.querySelector(`.news__band__cell[data-newsId="${id}"]`);
                let neighbours = JSON.parse(atob(item.getAttribute('data-neighbours')));
                this.reCalcDelta(neighbours['before'].length);
                this.latestVisible -= neighbours['before'].length;
                if (this.latestVisible < 0) {
                    this.latestVisible = 0;
                }
                let shift = this.band.offsetLeft - this.holder.offsetLeft - this.delta;
                let siblings = {};

                neighbours['before'].forEach((siblingItem) => {
                    for (let [ts, newsId] of Object.entries(siblingItem)) {
                        siblings[ts] = this.band.querySelector(`.news__band__cell[data-stamp="${ts}"]`);
                        if (siblings[ts] == null) {
                            this.scrollLocked += newsId;
                            siblings[ts] = new NewsbandPreview(newsId, ts);
                            item.insertAdjacentElement('afterend', siblings[ts].getItem());
                            siblings[ts].requestData(siblings[ts].handleResponse.bind(siblings[ts]));
                            this.items[ts] = {id: newsId, item};
                        }

                        item = this.band.querySelector(`.news__band__cell[data-newsId="${newsId}"]`);
                    }
                });

                this.sortItems();

                this.band.style.left = shift + 'px';
                siblings = null;
            }
        }

        checkLeftScrollShowConditions() {
            let c1 = this.band.offsetLeft < this.holder.offsetLeft;
            let c2 = this.after > 0;
            let c3 = this.lastNewsId != this.items[this.map['visible'][this.map['visible'].length - 1]].id;

            return c1 || c2 || c3;
        }

        checkRightScrollShowConditions() {
            let c1 = this.holder.offsetLeft + this.holder.offsetWidth < this.band.offsetLeft + this.band.offsetWidth;
            let c2 = this.before > 0;
            let c3 = this.firstNewsId != this.items[this.map['visible'][0]].id;

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

        reMap() {
            let keys = Object.keys(this.items);
            this.cleanMap();

            if (keys.length <= this.visibleItems) {
                this.map['visible'] = keys;
            } else {
                this.map['visible'] = keys.slice(this.latestVisible, this.latestVisible + this.visibleItems);
                this.map.before = this.latestVisible;
                this.map.after = keys.length - this.map['visible'].length - this.map.before;
            }
        }

        cleanMap() {
            this.map = null;
            this.map = {before: 0, visible: [], after: 0};
        }

        reCalcDelta(steps) {
            this.reMap();

            let cnt = this.map['after'] + this.map['visible'].length + this.map['before'];
            let delta = Math.ceil(this.band.offsetWidth / cnt);
            this.delta = delta * steps;
        }

        checkInvalidState() {
            if (this.band.offsetLeft + this.band.offsetWidth < this.holder.offsetLeft + this.holder.offsetWidth) {
                this.band.style.left = this.holder.offsetWidth - this.band.offsetWidth + 'px';
            }
        }

        rqNewsReplace(nid, respCBF) {
            let params = [
                `_token=${getToken()}`,
                'opcode=RDNW',
                `nid=${nid}`
            ];

            AJAX.post(this.URL, params.join('&'), respCBF.bind(this));
        }

        newsReplaceCBF(rsp) {
            let resp, contents;
            try {
                resp = JSON.parse(rsp);
                contents = JSON.parse(resp.contents);
            } catch (e) {
                console.log(e);
            } finally {
                scrollTo(0, 0);
                this.nest.innerHTML = contents.message.trim();
            }
        }

        rePlaceSelectedPreview(nid) {
            let newItem = this.band.querySelector(`.news__band__cell[data-newsId="${nid}"]`);
            let oldItem = this.band.querySelector(`.news__band__cell[data-newsId="${this.newsId}"]`);
            let newSelected = new NewsbandItem(nid, newItem.getAttribute('data-stamp'), newItem.getAttribute('data-neighbours'));
            newSelected.createDIVItem(newItem.innerHTML);

            let oldSelected = new NewsbandItem(this.newsId, oldItem.getAttribute('data-stamp'), oldItem.getAttribute('data-neighbours'));
            oldSelected.createAnchorItem(oldItem.innerHTML);

            oldItem.insertAdjacentElement('afterend', oldSelected.getItem());
            this.band.removeChild(oldItem);
            oldItem = this.band.querySelector(`.news__band__cell[data-newsId="${this.newsId}"]`);
            this.items[oldItem.getAttribute('data-stamp')].item = oldItem;

            newItem.insertAdjacentElement('afterend', newSelected.getItem());
            this.band.removeChild(newItem);
            newItem = this.band.querySelector(`.news__band__cell[data-newsId="${nid}"]`);
            this.items[newItem.getAttribute('data-stamp')].item = newItem;

            this.newsId = nid;
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
        loadNews: (nid) => {
            self.rqNewsReplace(nid, self.newsReplaceCBF);
            self.rePlaceSelectedPreview(nid);
            return false;
        },
        scrollLeft: () => {
            self.scrollLeft();
        },
        scrollRight: () => {
            self.scrollRight();
        },
        listen: (e) => {
            if (e.target == self.band) {
                self.redrawControls();
                self.scrollLocked -= 1000000;
            } else if (e.type == 'gotPreview') {
                self.redrawControls();
                self.scrollLocked -= e.detail.nid;
            }

            if (self.scrollLocked < 0) {
                self.scrollLocked = 0;
            }
        }
    }

})();

function initNewsBand() {
    let items = {};
    let params = {};
    let holder = document.body.querySelector('div.news__preview__pad');
    let band = document.body.querySelector('nav.news__preview__band');

    if (band !== null) {
        Array.from(band.querySelectorAll('.news__band__cell')).forEach((item) => {
            items[item.getAttribute('data-stamp')] = {
                id: +item.getAttribute('data-newsId'),
                item
            }
        });

        params = {
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
            URL: '/asio/news',
            nest: document.body.querySelector('section.main__sheet.news__article>article'),
        };

        newsBand.init(params);
        document.body.addEventListener('transitionend', newsBand.listen);
        document.body.addEventListener('gotPreview', newsBand.listen, {capture: true});

    }
}

__tasks.push(initNewsBand);
