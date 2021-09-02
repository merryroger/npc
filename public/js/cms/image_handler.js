'use strict';

function reloadImageCollection(resp) {
    let response = null;
    try {
        let rsp = JSON.parse(resp);
        response = JSON.parse(rsp.contents);
        switch (response.opcode) {
            case 'TITM':
                dropErrorVeil();
                canClose = true;
                document.body.querySelector('section.data__list').outerHTML = response.view;
                break;
            case 'CFLD':
                document.body.querySelector('section.data__list__empty').outerHTML = response.view;
                break;
            case 'RITM':
                dropErrorVeil();
                canClose = true;
            case 'CRLD':
                document.body.querySelector('section.page__band').innerHTML = response.view;
                break;
        }
    } catch (e) {

    } finally {
        rq_sent = false;
    }

}

function imageViewReady(src) {
    src.closest('.image__collection__pad').classList.remove('non__loaded');
}

function editImageItem(src) {
    if (!formPadOn) {
        let control = src.closest('div#item_control_panel');
        let itemId = +control.getAttribute('data-id');

        let pms = [
            `opcode=EDIM`,
            `recId=${itemId}`,
            `section=images`,
        ];

        raiseVeil(5, true);
        buildFormPad();

        formPadLR.className = 'wait__form';
        formPadLR.style.top = '50px';
        formPadLR.style.right = (document.body.clientWidth - formPadLR.offsetWidth) / 2 + 'px';
        formPadLR.style.zIndex = 6;
        formPadLR.classList.add('on');

        sendPOSTRequest(imgURL, pms, buildImageEditForm);

        formPadOn = true;
    }

    hideItemControlPanel();

    return false;
}

function buildImageEditForm(resp) {
    let rsp = null;
    try {
        rsp = JSON.parse(resp);
        if (rsp.success == 0) {
            setError(rsp);
        } else {
            let contents = JSON.parse(rsp.contents);
            formPadLR.className = '';
            formPadLR.innerHTML = contents.view;
            formPadLR.style.right = (document.body.clientWidth - formPadLR.offsetWidth) / 2 + 'px';
        }
    } catch (e) {

    } finally {
        rq_sent = false;
    }
}

function closeEditForm(src) {
    if (formPadOn && canClose) {
        enableSelection = true;
        imageSelectedCount = 0;
        formPadLR.className = 'off';
        formPadLR.innerHTML = '';
        formPadOn = false;
        canSend = true;
        pwLI = null;

        dropVeil();
    }
}

function deleteImageItem(src) {
    let control = src.closest('div#item_control_panel');
    let itemId = +control.getAttribute('data-id');
    hideItemControlPanel();

    let errorset = {
        errorcode: 0xd0,
        section: 'images',
        options: {
            id: itemId
        }
    };

    setError(errorset);

    return false;
}

function executeImageDelete(url, id, page = 1, section, wcbf) {
    let opcode = (document.body.querySelector('section.page__band').childElementCount > 1) ? 'RITM' : 'TITM';
    let pms = [
        `opcode=${opcode}`,
        `recId=${id}`,
        `page=${page}`,
        `section=${section}`,
    ];

    sendPOSTRequest(url, pms, wcbf);
}
