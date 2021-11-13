'use strict';

let popupMessenger = (() => {

    class PopupMessenger {

        constructor() {
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
                this.shiftOtherFlashes(getCoordsRect(flash));
                this.flashes.set(flash.id, flash);
            }
        }

        shiftOtherFlashes(rect) {
            let shift = rect.height + 24;
            this.flashes.forEach((value, key, map) => {
                value.style.bottom = value.offsetHeight + shift + 'px';
            });
        }

        makeFlash(msg) {
            let flash = document.createElement('div');
            flash.id = MD5(Date.now());
            flash.className = 'flash__message off';
            flash.innerHTML = `<p>${msg}</p>`;

            return flash;
        }

    }

    let self = new PopupMessenger();

    return {
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
