'use strict';

const imgURL = '/cms/tags';

function getTagsAddForm(src) {
    if (!formPadOn) {

        let pms = [
            `opcode=RAFM`,
            `section=tags`,
            `sectgroup=references`,
        ];

        raiseVeil(5, true);
        buildFormPad();

        sendPOSTRequest(imgURL, pms, buildTagsForm);

        rq_sent = true;
        formPadOn = true;
    }

    return false;
}
/*
function getLocationEditForm(itemId) {
    if (!formPadOn) {

        let pms = [
            `itemId=${itemId}`,
            `opcode=REFM`,
            `section=locations`,
            `sectgroup=references`,
        ];

        raiseVeil(5, true);
        buildFormPad();

        sendPOSTRequest(imgURL, pms, buildLocationForm);

        rq_sent = true;
        formPadOn = true;
    }

    return false;
}
*/
function buildFormPad() {
    if (formPadLR == null) {
        formPadLR = document.createElement('div');
        formPadLR.id = 'form_pad';
        formPadLR.className = 'off';

        document.body.insertAdjacentElement('beforeEnd', formPadLR);
    }

    formPadLR.className = 'wait__form';
    formPadLR.style.top = '50px';
    formPadLR.style.right = '50px';
    formPadLR.style.zIndex = 6;
    formPadLR.classList.add('on');
}

function buildTagsForm(resp) {
    console.log(rest); //!--------- Temporary line -----------------!//
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
/*
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
                } else if (field.type.toLowerCase() == 'checkbox') {
                    let state = (field.checked) ? 1 : 0;
                    pms.push(`${field.name}=${state}`);
                }

                break;
        }
    }

    sendPOSTRequest(imgURL, pms, renderList);

    return false;
}

function checkUsePreviewStatus(src) {
    if (!src.checked) {
        let errorset = {
            errorcode: 0xe0,
            section: 'locations',
            options: {}
        };

        setError(errorset);
    }
}

function requestEditItem(row) {
    let itemId = +row.getAttribute('data-id');
    if (itemId == 1) {
        let errorset = {
            errorcode: 0xd0,
            section: 'locations',
            options: {
                id: itemId
            }
        };

        setError(errorset);
    } else {
        getLocationEditForm(itemId);
    }
}

function requestDeleteItem(src) {
    let tr = src.closest('tr');
    let itemId = +tr.getAttribute('data-id');
    let errorset = {
        errorcode: ((itemId == 1) ? 0xd0 : 0xd1),
        section: 'locations',
        options: {
            id: itemId
        }
    };

    setError(errorset);
}
*/