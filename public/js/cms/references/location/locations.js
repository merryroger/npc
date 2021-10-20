'use strict';

const imgURL = '/cms/locations';

function getLocationAddForm(src) {
    if (!formPadOn) {

        let pms = [
            `opcode=RAFM`,
            `section=locations`,
            `sectgroup=references`,
        ];

        raiseVeil(5, true);
        buildFormPad();

        formPadLR.className = 'wait__form';
        formPadLR.style.top = '50px';
        formPadLR.style.right = '50px';
        formPadLR.style.zIndex = 6;
        formPadLR.classList.add('on');

        sendPOSTRequest(imgURL, pms, buildLocationAddForm);

        rq_sent = true;
        formPadOn = true;
    }

    return false;
}

function buildFormPad() {
    if (formPadLR == null) {
        formPadLR = document.createElement('div');
        formPadLR.id = 'form_pad';
        formPadLR.className = 'off';

        document.body.insertAdjacentElement('beforeEnd', formPadLR);
    }
}

function buildLocationAddForm(resp) {
    let rsp;
    try {
        rsp = JSON.parse(resp);
        formPadLR.className = '';
        formPadLR.innerHTML = rsp.contents;
    } catch (e) {
        console.log(e);
    } finally {
        updateVeilWaitState(veilLR);
        setTimeout(initLocationForm, 10);
        rq_sent = false;
    }
}

function initLocationForm() {
    let fm = document.body.querySelector('form.edit__form');
    fm.name.focus();
}

function checkFormControls(fm) {
    let pms = [
        `_token=${pickToken(fm)}`,
    ];

    for (let field of Object.values(fm)) {
        if (field.getAttribute('data-type') == null || field.getAttribute('data-type') != 'form_field') {
            continue;
        }

        switch (field.tagName.toLocaleUpperCase()) {
            case 'INPUT':
                if (field.type.toLowerCase() == 'text' || field.type.toLowerCase() == 'hidden') {
                    pms.push(`${field.name}=${encodeURIComponent(field.value)}`);
                }
                break;
        }
    }

    sendPOSTRequest(imgURL, pms, buildLocationAddForm);

    return false;
}
