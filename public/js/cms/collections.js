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

function buildFormPad() {
    if (formPadLR == null) {
        formPadLR = document.createElement('div');
        formPadLR.id = 'form_pad';
        formPadLR.className = 'off';

        document.body.insertAdjacentElement('beforeEnd', formPadLR);
    }
}
