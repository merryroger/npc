'use strict';

let popupMessenger = (() => {

    class PopupMessenger {

        constructor() {
            this.mMargin = 10;
            this.flashes = new Map();
        }

        fire(msgGroup, msgSet, title) {
            for (let i = 0; i < msgSet.length; i++) {
                let flash = this.makeFlash(msgSet[i]);
                flash.style.bottom = '50px';

                document.body.appendChild(flash);
                flash.classList.remove('off');
                flash.style.zIndex = 10;
                flash.classList.add('on');

                this.appendFlash(flash);
            }
        }

        appendFlash(flash) {
            let shift = flash.offsetHeight + this.mMargin;
            let winHeight = document.documentElement.clientHeight;

            this.flashes.forEach((value) => {
                value.style.bottom = winHeight - (value.offsetTop + value.offsetHeight) + shift + 'px';
                shift += value.offsetHeight + this.mMargin;
            });

            this.flashes.set(flash.id, flash);
            flash.style.opacity = 0;
        }

        makeFlash(msg) {
            let flash = document.createElement('div');
            flash.id = MD5(Date.now());
            flash.className = 'flash__message off';
            flash.innerHTML = `<p>${msg}</p>`;

            return flash;
        }

        removeFlash(flash) {
            let id = flash.id;
            if (this.flashes.has(id)) {
                this.flashes.delete(id);
                document.body.removeChild(flash);
            }
        }

    }

    let self = new PopupMessenger();

    return {
        listen: (e) => {
            if (e.target.classList.contains('flash__message')) {
                if (e.propertyName == 'opacity') {
                    self.removeFlash(e.target);
                }
            }
        },
        fire: (messages, title = '') => {
            let mss;
            try {
                mss = JSON.parse(messages);
                for (let [msgKey, msgSet] of Object.entries(mss)) {
                    self.fire(msgKey, msgSet, title);
                }
            } catch (e) {
                console.log(e);
            }
        }
    }

})();

__tasks.push(setPopupListener);

function setPopupListener() {
    document.body.addEventListener('transitionend', popupMessenger.listen);
}