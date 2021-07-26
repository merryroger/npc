'use strict';

let veilLR = null;
let veilOn = false;

let errVeilLR = null;
let errVeilOn = false;

function raiseVeil(level = 5, waitstate = false) {
    if (veilLR == null) {
        veilLR = document.createElement('div');
        veilLR.id = 'veil';
        veilLR.className = 'off';

        document.body.insertAdjacentElement('beforeEnd', veilLR);
    }

    if (!veilOn) {
        veilLR.className = '';
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

function raiseErrorVeil(level = 20, waitstate = false) {
    if (errVeilLR == null) {
        errVeilLR = document.createElement('div');
        errVeilLR.id = 'error_veil';
        errVeilLR.className = 'off';

        document.body.insertAdjacentElement('beforeEnd', errVeilLR);
    }

    if (!errVeilOn) {
        errVeilLR.className = '';
        if (waitstate) {
            errVeilLR.classList.add('error__veil__await');
        }

        errVeilLR.style.top = 0;
        errVeilLR.style.right = 0;
        errVeilLR.style.bottom = 0;
        errVeilLR.style.left = 0;
        errVeilLR.style.zIndex = level;

        errVeilLR.classList.add('on');

        errVeilOn = true;
    }
}

function dropErrorVeil() {
    if (errVeilOn && errVeilLR != null) {
        errVeilLR.className = 'off';
        errVeilOn = false;
    }
}

