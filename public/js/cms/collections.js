'use strict';

let formPadLR = null;
let formPadOn = false;
let itemControlPanel = null;
let itemControlPanelOn = 0;

function reloadCollection(url, section, wcbf, options = {}) {
    let isSetEmpty = document.body.querySelector('section.data__list') == null;
    let opcode = (isSetEmpty) ? 'opcode=CFLD' : 'opcode=CRLD';
    let page = (isSetEmpty && options.page == undefined) ? 'page=1' : `page=${options.page}`;
    let pms = [
        opcode,
        page,
        `section=${section}`,
    ];

    sendPOSTRequest(url, pms, wcbf);
}

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

function showItemControlPanel(src) {
    let frame = src.closest('div.image__collection__frame');
    let itemId = +frame.getAttribute('data-id');
    if (itemControlPanelOn !== itemId) {
        if (itemControlPanel == null) {
            itemControlPanel = document.getElementById('item_control_panel');
        }

        let sRect = getCoordsRect(src);

        itemControlPanel.setAttribute('data-id', `${itemId}`);
        itemControlPanel.classList.remove('off');
        itemControlPanel.style.zIndex = 3;
        itemControlPanel.style.top = sRect.top - 2 + 'px';
        itemControlPanel.style.left = sRect.left + sRect.width + 5 - itemControlPanel.offsetWidth + 'px';
        itemControlPanel.classList.add('on');

        openMenuLevel(0, `item_control_panel`, itemControlPanel, hideItemControlPanel);

        itemControlPanelOn = itemId;
    }
}

function hideItemControlPanel() {
    if (itemControlPanelOn > 0) {
        itemControlPanel.classList.remove('on');
        itemControlPanel.classList.add('off');
        itemControlPanel.setAttribute('data-id', '0');
        itemControlPanelOn = 0;
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