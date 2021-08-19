'use strict';

let formPadLR = null;
let formPadOn = false;

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
            case 'CFLD':
                document.body.querySelector('section.data__list__empty').outerHTML = response.view;
                break;
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
