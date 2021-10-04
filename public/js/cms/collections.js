'use strict';

let formPadLR = null;
let formPadOn = false;
let itemControlPanel = null;
let itemControlPanelOn = 0;
let previewControlPanel = null;
let previewControlPanelOn = false;
let extraFormPadLR = null;
let extraFormPadON = false;

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

function showPreviewControlPanel(src, itemId) {
    let frame = document.getElementById('preview_control_panel');
    let hasPreview = +src.getAttribute('data-ispreview');
    if (!previewControlPanelOn) {
        if (previewControlPanel == null) {
            previewControlPanel = frame;
        }

        let sRect = getCoordsRect(src);

        handlePreviewControlList(previewControlPanel, hasPreview, itemId);

        previewControlPanel.setAttribute('data-id', `${itemId}`);
        previewControlPanel.classList.remove('off');
        previewControlPanel.style.zIndex = 7;
        previewControlPanel.style.top = sRect.top - 2 + 'px';
        previewControlPanel.style.left = sRect.left + sRect.width + 25 - previewControlPanel.offsetWidth + 'px';
        previewControlPanel.classList.add('on');
        openMenuLevel(0, `preview_control_panel`, previewControlPanel, hidePreviewControlPanel);

        previewControlPanelOn = true;
    }
}

function hidePreviewControlPanel() {
    if (previewControlPanelOn) {
        previewControlPanel.classList.remove('on');
        previewControlPanel.classList.add('off');
        previewControlPanel.setAttribute('data-id', '0');
        previewControlPanelOn = false;
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

function handlePreviewControlList(menuPanel, hasPreview, id) {
    menuPanel.setAttribute('data-id', `${id}`);
    let list = menuPanel.querySelector('.image__item__control__list').querySelectorAll('[data-type="delete"]');
    if (list.length > 0) {
        list.forEach((item) => {
            if (hasPreview) {
                if (item.tagName == 'A') {
                    item.classList.remove('h');
                } else if (item.tagName == 'P') {
                    item.classList.add('h');
                }
            } else {
                if (item.tagName == 'A') {
                    item.classList.add('h');
                } else if (item.tagName == 'P') {
                    item.classList.remove('h');
                }
            }
        });
    }
}

function prepareExtraForm() {
    if (extraFormPadLR == null) {
        extraFormPadLR = document.createElement('div');
        extraFormPadLR.id = 'extra_form_pad';
        extraFormPadLR.className = 'off';
        document.body.insertAdjacentElement('beforeEnd', extraFormPadLR);
    }

    if (extraFormPadON) {
        destroyExtraForm();
    }
}

function showExtraForm(contents, level = 6) {
    extraFormPadLR.classList.remove('off');
    extraFormPadLR.innerHTML = contents;
    extraFormPadLR.style.zIndex = level;
    extraFormPadLR.classList.add('on');

    extraFormPadON = true;
}

function destroyExtraForm() {
    if (extraFormPadON) {
        extraFormPadLR.classList.remove('on');
        extraFormPadLR.innerHTML = '';
        extraFormPadLR.classList.add('off');

        extraFormPadON = false;
    }
}
