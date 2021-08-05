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
    let rsp;
    try {
        rsp = JSON.parse(resp);
        console.log(rsp);
    } catch (e) {

    } finally {
        rq_sent = false;
    }

}
