'use strict';

let rq_sent = false;
let mm_current = null;
let mm_source = null;
let ptrOver = null;
let targets = {
    'ucp': (src) => {
        return src.closest('#ucp_pad');
    },
    'cmm_main': (src) => {
        return src.closest('#cmm_main');
    },
    'cmm_sub_lvl_1': (src) => {
        return src.closest('#cmm_sub_lvl_1');
    },
};

let menuStack = [];

function initDesktop() {
    hangListeners();
}

function hangListeners() {
    ptrOver = document.addEventListener('pointerover', dtPointerOver);
}

function getToken(selector) {
    return document.body.querySelector(selector)._token.value;
}

function sendPOSTRequest(url, params, wcbFunc) {
    if (rq_sent) {
        return false;
    }

    let pms = [
        `_token=${getToken('#cms_defaults')}`
    ];

    pms = params.concat(pms);

    AJAX.post(url, pms.join('&'), wcbFunc);
    rq_sent = true;
}

function dtPointerOver(e) {
    let target = checkTargets(e);

    if (mm_current == null && target != null) {
        mm_current = target;
        mm_source = target.src;
        handleOverState(e);
    } else if (mm_current != null && target != null) {
        if (mm_current.target != target.target) {
            handleOutState(e);
            mm_current = target;
            mm_source = target.src;
            handleOverState(e);
        } else if (mm_source != target.src) {
            mm_source = target.src;
        }
    } else if (mm_current != null && target == null) {
        handleOutState(e, true);
        mm_current = target;
        mm_source = null;
    }
}

function checkTargets(e) {
    let _tg = null;

    for (let [key, fn] of Object.entries(targets)) {
        let _tgt_ = fn(e.target);
        if (_tgt_ !== null) {
            _tg = {
                th: 0,
                name: key,
                target: _tgt_,
                src: e.target
            };

            return _tg;
        }
    }

    return _tg;
}

function handleOverState(e) {
    if (mm_current !== null) {
        let level = +mm_current.target.getAttribute('data-level');
        clearCloseIntervals(level);
    }

}

function handleOutState(e, full_stack = false) {
    if (mm_current !== null) {
        let level = (full_stack) ? 0 : +mm_current.target.getAttribute('data-level');

        closeMenuStack(level - 1);
    }
}

function closeMenuStack(floorLevel) {
    let mItem;
    for (let l = menuStack.length - 1; l > floorLevel; l--) {
        mItem = menuStack[l];
        mItem.th = setTimeout(`shutMenuLevel(${l})`, 10);
    }
}

function clearCloseIntervals(level) {
    let mItem;
    for (let l = level; l > -1; l--) {
        mItem = menuStack[l];
        clearTimeout(mItem.th);
        mItem.th = 0;
    }
}

function openMenuLevel(lvl, name, target) {
    let mItem = {
        th: 0,
        name: name,
        target: target
    }

    menuStack[lvl] = mItem;
}

function shutMenuLevel(lvl) {
    let mItem = menuStack.splice(lvl, 1)[0];
    if (mItem != undefined && mItem.target != undefined) {
        mItem.target.classList.remove('on');
        mItem.target.classList.add('off');
        mItem.th = 0;
    }

    if (lvl == 0)
        return;

    mItem.target.innerHTML = '';

}

__tasks[__tasks.length] = initDesktop;
