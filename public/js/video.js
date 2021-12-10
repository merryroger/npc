'use strict';

videoProjector = (() => {

    class VideoProjector {

        constructor() {
            this.holder = null;
            this.vFrame = null;
            this.vfTitle = null;
            this.width = 560;
            this.height = 315;
            this.zIndex = -1;
            this.settings = {};
            this.vpOpen = false;
            this.dadPanel = false;
            this.veilPanel = false;
            this.dragged = false;
            this.dragData = {mX: 0, mY: 0, dX: 0, dY: 0};
            this.example = null;
            this.toh = 0;
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

        adjustHolderPosition() {
            if (this.holder.offsetLeft < 0) {
                this.holder.style.left = '5px';
            } else if (this.holder.offsetLeft + this.holder.offsetWidth > document.documentElement.clientWidth) {
                this.holder.style.left = document.documentElement.clientWidth - this.holder.offsetWidth - 5 + 'px';
            }

            if (this.holder.offsetTop < 0) {
                this.holder.style.top = '5px';
            } else if (this.holder.offsetTop + this.holder.offsetHeight > document.documentElement.offsetHeight) {
                this.holder.style.top = document.documentElement.clientHeight - this.holder.offsetHeight - 5 + 'px';
            }
        }

        resize(width = null, height = null) {
            let delta = 0;

            width = (width !== null) ? width : this.vFrame.offsetWidth;
            height = (height !== null) ? height : this.vFrame.offsetHeight;

            let aspect = width / height;

            if (this.holder.offsetWidth > document.documentElement.clientWidth) {
                delta = this.holder.offsetWidth - this.vFrame.offsetWidth;
                width = document.documentElement.clientWidth - delta - 20;
                height = width / aspect;
                this.vFrame.style.width = width + 'px';
                this.vFrame.style.height = height + 'px';
                this.holder.style.width = width + 'px';
            }

            if (this.holder.offsetHeight > document.documentElement.clientHeight) {
                delta = this.holder.offsetHeight - this.vFrame.offsetHeight;
                height = document.documentElement.clientHeight - delta - 10;
                width = height * aspect;
                this.vFrame.style.width = width + 'px';
                this.vFrame.style.height = height + 'px';
                this.holder.style.width = width + 'px';
            }

            this.adjustHolderPosition();
        }

        setData(url, resources, width = null, height = null) {
            let yOffset = window.pageYOffset;

            this.holder.style.left = resources.rect.left - 5 + 'px';
            this.holder.style.top = resources.rect.top - yOffset - 5 + 'px';

            width = (width !== null) ? width : this.width;
            height = (height !== null) ? height : this.height;

            this.vFrame.style.width = width + 'px';
            this.vFrame.style.height = height + 'px';
            this.holder.style.width = width + 'px';

            this.resize(this.vFrame.offsetWidth, this.vFrame.offsetHeight);

            this.vfTitle.innerHTML = resources.date + resources.title;
            this.vFrame.src = url + '?autoplay=1';
        }

        show(resources) {
            if (!this.vpOpen) {
                this.holder.classList.remove('off');

                this.holder.style.zIndex = this.zIndex;
                this.holder.classList.add('on');

                this.example = resources.example;
                this.dadPanel.addEventListener('pointerdown', this.example.catchFrame.bind(this.example), {catch: true});

                this.vpOpen = true;
            }
        }

        hide() {
            this.holder.classList.remove('on');
            this.vFrame.src = 'about:blank';
            this.holder.classList.add('off');
            this.dadPanel.removeEventListener('pointerdown', this.example.catchFrame.bind(this.example), {catch: true});
            this.vpOpen = false;
        }

        setDragState(src, mX, mY, state) {
            this.dragged = state;
            src.style.cursor = (state) ? 'move' : 'pointer';
            this.holder.style.userSelect = (state) ? 'none' : 'auto';
            this.coverIFrame(state);

            if (state) {
                raiseVeil();
                this.dragData.mX = mX;
                this.dragData.mY = mY;
                this.dragData.dX = this.dragData.dY = 0;
                document.body.addEventListener('pointermove', this.example.dragFrame.bind(this.example), {catch: true});
                document.body.addEventListener('pointerup', this.example.dropFrame.bind(this.example), {catch: true});
            } else {
                if (this.toh !== 0) {
                    clearTimeout(toh);
                    this.moveFrame();
                    this.toh = 0;
                }

                this.adjustHolderPosition();
                dropVeil();
                document.body.removeEventListener('pointermove', this.example.dragFrame.bind(this.example), {catch: true});
                document.body.removeEventListener('pointerup', this.example.dropFrame.bind(this.example), {catch: true});
            }
        }

        dragFrame(e) {
            this.dragData.dX = e.clientX - this.dragData.mX;
            this.dragData.dY = e.clientY - this.dragData.mY;
            if (this.toh == 0) {
                this.toh = setTimeout(this.example.moveFrame.bind(this.example), 10);
            }
        }

        moveFrame() {
            this.holder.style.left = this.holder.offsetLeft + this.dragData.dX + 'px';
            this.holder.style.top = this.holder.offsetTop + this.dragData.dY + 'px';

            this.dragData.mX += this.dragData.dX;
            this.dragData.mY += this.dragData.dY;
            this.dragData.dX = this.dragData.dY = 0;
            this.toh = 0;
        }

        coverIFrame(state) {
            if (state) {
                this.veilPanel.classList.remove('off');
                this.veilPanel.style.left = this.vFrame.offsetLeft + 'px';
                this.veilPanel.style.top = this.vFrame.offsetTop + 'px';
                this.veilPanel.style.width = this.vFrame.offsetWidth + 'px';
                this.veilPanel.style.height = this.vFrame.offsetHeight + 'px';
                this.veilPanel.style.zIndex = this.zIndex + 1;
                this.veilPanel.classList.add('on');
            } else {
                this.veilPanel.classList.remove('on');
                this.veilPanel.style.width = 0;
                this.veilPanel.style.height = 0;
                this.veilPanel.classList.remove('off');
            }
        }

    }

    let self = new VideoProjector();

    return {
        init: (params = {}) => {
            self.init(params);
        },
        catchFrame: (e) => {
            if (!self.dragged) {
                self.setDragState(e.target, e.clientX, e.clientY, true);
            }
        },
        dragFrame: (e) => {
            if (self.dragged) {
                self.dragFrame(e);
            }
        },
        dropFrame: (e) => {
            if (self.dragged) {
                self.setDragState(self.dadPanel, 0, 0, false);
            }
        },
        moveFrame: () => {
            self.moveFrame();
        },
        show: (url, resources) => {
            if (!self.opened()) {
                self.show(resources);
            }

            self.setData(url, resources);
        },
        hide: () => {
            self.hide();
        },
        resize: () => {
            self.resize();
        }
    }

})();

function initVideoProjector() {
    let holder = document.getElementById('video_frame_pad');
    let params = {
        holder,
        vFrame: holder.querySelector('iframe#video_frame'),
        vfPanel: holder.querySelector('section#video_frame_panel'),
        vfTitle: holder.querySelector('div.vf__title'),
        dadPanel: holder.querySelector('div.dad__panel'),
        veilPanel: holder.querySelector('div.veil__panel'),
        width: 560,
        height: 315,
        zIndex: 6,
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
    let container = src.closest('div.video__item__pad');
    let resources = {
        title: container.querySelector('p').outerHTML,
        date: container.querySelector('h6').outerHTML,
        rect: getCoordsRect(container),
        example: videoProjector
    };

    videoProjector.show(url, resources);

    return false;
}

function closeMovie(src) {
    videoProjector.hide();

    return false;
}

__tasks.push(initVideoProjector);
