'use strict';

const imgURL = '/cms/images';

let formPadLR = null;
let formPadOn = false;
let pwLI = null;

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
            setError(rsp);
        } else {
            formPadLR.className = '';
            formPadLR.innerHTML = rsp.contents;
            formPadLR.addEventListener('click', selectImage, false);
        }
    } catch (e) {

    } finally {
        rq_sent = false;
    }
}

function closeForm(src) {
    if (formPadOn) {
        formPadLR.removeEventListener('click', selectImage, false);
        formPadLR.className = 'off';
        formPadLR.innerHTML = '';
        formPadOn = false;
        pwLI = null;

        dropVeil();
    }
}

function selectImage(e) {
    if (e.target.closest('li.image__upload__elem__pad').tagName == 'LI') {
        pwLI = e.target;
        let fm = e.target.closest('form.image__load__form');
        let fs = fm.querySelector('input[type="file"]');
        fs.click();
        e.preventDefault();
    }
}

function specifyImage(fs) {
    const img = document.createElement("img");
    img.src = URL.createObjectURL(fs.files[0]);
    img.width = 96;
    img.onload = function() {
        URL.revokeObjectURL(img.src);
    }

    pwLI.appendChild(img);
   /*
    const info = document.createElement("span");
    info.innerHTML = this.files[i].name + ": " + this.files[i].size + " bytes";
    li.appendChild(info);
    */
}
