'use strict';

let veilLR = null;
let veilOn = false;

function raiseVeil(level = 5, waitstate = false) {
    if (veilLR == null) {
        veilLR = document.createElement('div');
        veilLR.id = 'veil';
        veilLR.className = 'off';

        document.body.insertAdjacentElement('beforeEnd', veilLR);
    }

    if (!veilOn) {
        veilLR.classList.remove('off');
        if (waitstate) {
            veilLR.classList.add('veil__await');
        }

        veilLR.style.top = 0;
        veilLR.style.right = 0;
        veilLR.style.bottom = 0;
        veilLR.style.left = 0;
        veilLR.style.zIndex = level;

        veilLR.classList.add('on');

        veilOn = true;
    }
}

function dropVeil() {
    if (veilOn && veilLR != null) {
        veilLR.className = 'off';
        veilOn = false;
    }
}
