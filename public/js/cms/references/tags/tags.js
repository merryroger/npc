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

function getTagEditForm(itemId) {
    if (!formPadOn) {

        let pms = [
            `itemId=${itemId}`,
            `opcode=REFM`,
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
    let rsp;
    try {
        rsp = JSON.parse(resp);
        formPadLR.className = '';
        formPadLR.innerHTML = rsp.contents;
    } catch (e) {
        console.log(e);
    } finally {
        updateVeilWaitState(veilLR);
        setTimeout(initTagForm, 10);
        rq_sent = false;
    }
}

function initTagForm() {
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

    sendPOSTRequest(imgURL, pms, renderList);

    return false;
}

function requestEditItem(row) {
    let itemId = +row.getAttribute('data-id');
    getTagEditForm(itemId);
}

function requestDeleteItem(src) {
    let tr = src.closest('tr');
    let itemId = +tr.getAttribute('data-id');
    let errorset = {
        errorcode: 0xd1,
        section: 'tags',
        options: {
            id: itemId,
            section: 'tags',
        }
    };

    setError(errorset);
}
