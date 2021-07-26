'use strict';

const imgURL = '/cms/images';

let formPadLR = null;
let formPadOn = false;

function getImageAddForm(src) {
    if (!formPadOn) {
        raiseVeil(5, true);

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

        let pms = [
            'opcode=RIAF',
        ];

        sendPOSTRequest(imgURL, pms, buildImageAddForm);

        formPadOn = true;
    }
}

function buildImageAddForm(resp) {
    let rsp = null;
    try {
        rsp = JSON.parse(resp);
        if (rsp.success == 0) {
            rq_sent = false;
            setError(rsp);
        } else {
            
        }
    } catch (e) {

    } finally {

    }
}
