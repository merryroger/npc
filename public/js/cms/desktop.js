'use strict';

const errURL = '/cms/errors';

let rq_sent = false;
let mm_current = null;
let mm_source = null;
let ptrOver = null;
let errLR = null;
let errOn = false;
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
    'item_ctrl_list': (src) => {
        return src.closest('#item_control_panel');
    }
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

function doAction(src, handler) {
    let fm = src.closest("#error_form");
    if (!handler(fm))
        return;

    dropErrorVeil();
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

function openMenuLevel(lvl, name, target, postFn = null) {
    let mItem = {
        th: 0,
        name: name,
        target: target,
        post_function: postFn
    }

    menuStack[lvl] = mItem;
}

function shutMenuLevel(lvl) {
    let mItem = menuStack.splice(lvl, 1)[0];
    if (mItem != undefined && mItem.target != undefined) {
        mItem.target.classList.remove('on');
        mItem.target.classList.add('off');
        mItem.th = 0;
        if (mItem.post_function !== null) {
            mItem.post_function();
        }
    }

    if (lvl == 0)
        return;

    mItem.target.innerHTML = '';

}

function raiseFlashError(msg) {
    alert(msg);
}

function setError(data) {
    if (!errVeilOn) {
        raiseErrorVeil(20, true);

        let pms = [
            `errorcode=${data.errorcode}`,
            `section=${data.section}`,
            `options=${JSON.stringify(data.options)}`,
        ];

        sendPOSTRequest(errURL, pms, showErrors);
    }
}

function showErrors(resp) {
    let rsp;
    try {
        rsp = JSON.parse(resp);

        if (errLR == null) {
            errLR = document.createElement('div');
            errLR.id = 'error_pad';
            errLR.className = 'off';

            document.body.insertAdjacentElement('beforeEnd', errLR);
        }

        if (!errOn) {
            errLR.innerHTML = rsp.view;
            errLR.style.top = 0;
            errLR.style.right = 0;
            errLR.style.bottom = 0;
            errLR.style.left = 0;
            errLR.style.zIndex = +errVeilLR.style.zIndex + 1;
            errLR.className = 'on';

            errOn = true;
        }
    } catch (e) {

    } finally {
        rq_sent = false;
    }
}

function hideError() {
    if (errOn) {
        errLR.className = 'off';
        errLR.innerHTML = '';
        errOn = false;
    }
}

__tasks[__tasks.length] = initDesktop;
