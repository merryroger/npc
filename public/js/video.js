'use strict';

let videoProjector = (() => {

    class VideoProjector {

        constructor() {
            this.holder = null;
            this.vFrame = null;
            this.width = 560;
            this.height = 315;
            this.zIndex = -1;
            this.settings = {};
            this.vpOpen = false;
        }

        init(params) {
            for (let [pmName, pmValue] of Object.entries(params)) {
                this[pmName] = pmValue;
            }

            for (let [key, val] of Object.entries(this.settings.valuable)) {
                this.vFrame.setAttribute(key, val);
            }

            this.settings.single.forEach((item) => {
                this.vFrame.setAttribute(item, "1");
            });

            this.vFrame.style.width = this.width + 'px';
            this.vFrame.style.height = this.height + 'px';
        }

        opened() {
            return this.vpOpen;
        }

        setData(url, rect, width = null, height = null) {
            let delta = 0;

            this.holder.style.left = rect.left - 5 + 'px';
            this.holder.style.top = rect.top - 5 + 'px';

            width = (width !== null) ? width : this.width;
            height = (height !== null) ? height : this.height;

            let aspect = width / height;

            this.vFrame.style.width = width + 'px';
            this.vFrame.style.height = height + 'px';

            if (this.holder.offsetWidth > document.documentElement.clientWidth) {
                delta = this.holder.offsetWidth - this.vFrame.offsetWidth;
                width = document.documentElement.clientWidth - delta - 20;
                height = width / aspect;
                this.vFrame.style.width = width + 'px';
                this.vFrame.style.height = height + 'px';
            }

            if (this.holder.offsetHeight > document.documentElement.clientHeight) {
                delta = this.holder.offsetHeight - this.vFrame.offsetHeight;
                height = document.documentElement.clientHeight - delta - 10;
                width = height * aspect;
                this.vFrame.style.width = width + 'px';
                this.vFrame.style.height = height + 'px';
            }

            if (this.holder.offsetLeft + this.holder.offsetWidth > document.documentElement.clientWidth) {
                this.holder.style.left = document.documentElement.clientWidth - this.holder.offsetWidth - 5 + 'px';
            }

            if (this.holder.offsetTop + this.holder.offsetHeight > document.documentElement.offsetHeight) {
                this.holder.style.top = document.documentElement.clientHeight - this.holder.offsetHeight + 'px';
            }

            this.vFrame.src = url + '?autoplay=1';
        }

        show() {
            if (!this.vpOpen) {
                this.holder.classList.remove('off');

                this.holder.zIndex = this.zIndex;
                this.holder.classList.add('on');

                this.vpOpen = true;
            }
        }

    }

    let self = new VideoProjector();

    return {
        init: (params = {}) => {
            self.init(params);
        },
        show: (url, rect) => {
            if (!self.opened()) {
                self.show();
            }

            self.setData(url, rect);
        },
    }

})();

function initVideoProjector() {
    let holder = document.createElement('div');
    holder.id = 'video_frame_pad';
    holder.className = 'off';
    holder.innerHTML = '<iframe id="video_frame"></iframe>';
    document.body.appendChild(holder);

    let params = {
        holder,
        vFrame: holder.querySelector('iframe#video_frame'),
        width: 560,
        height: 315,
        zIndex: 5,
        settings: {
            valuable: {
                autoplay: "1",
                modestbranding: "0",
                allow: "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture",
            },
            single: [
                'allowfullscreen'
            ]
        }
    };

    videoProjector.init(params);
}

function viewMovie(src, url) {
    let rect = getCoordsRect(src.closest('div.video__item__pad'));
    videoProjector.show(url, rect);

    return false;
}

__tasks.push(initVideoProjector);
