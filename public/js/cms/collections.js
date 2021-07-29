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
            formPadLR.querySelector('ul').addEventListener('click', selectImage, false);
        }
    } catch (e) {

    } finally {
        rq_sent = false;
    }
}

function closeForm(src) {
    if (formPadOn) {
        formPadLR.querySelector('ul').removeEventListener('click', selectImage, false);
        formPadLR.className = 'off';
        formPadLR.innerHTML = '';
        formPadOn = false;
        pwLI = null;

        dropVeil();
    }
}

function selectImage(e) {
    if (e.target.closest('.no__file__selected') != null) {
    } else if (e.target.closest('li.image__upload__elem__pad') != null && e.target.closest('li.image__upload__elem__pad').tagName == 'LI') {
        pwLI = e.target.closest('li.image__upload__elem__pad');
        let fm = e.target.closest('form.image__load__form');
        let fs = fm.querySelector('input[type="file"]');
        fs.click();
        e.preventDefault();
    } else if (e.target.tagName == 'BUTTON' && e.target.getAttribute('name') == 'another_image') {
        addAnotherImagePlace(e.target);
    }
}

function specifyImage(fs) {
    let ic = pwLI.querySelector('.img__ld__pad');
    let ds = pwLI.querySelector('.no__file__selected');
    let dc = pwLI.querySelector('.img__status')
    const img = document.createElement("img");
    img.src = URL.createObjectURL(fs.files[0]);

    if (ic.hasChildNodes()) {
        ic.removeChild(ic.childNodes[0]);
    }

    img.onload = function () {
        URL.revokeObjectURL(img.src);
        if (img.width > img.height) {
            img.width = (img.width < 160) ? img.width : 160;
        } else {
            img.height = (img.height < 120) ? img.height : 120;
        }

        ic.appendChild(img);
        ds.setAttribute('data-selected', 1);
        dc.innerHTML = 'Ок'//fs.files[0].name;
    }

    /*
     const info = document.createElement("span");
     info.innerHTML = this.files[i].name + ": " + this.files[i].size + " bytes";
     li.appendChild(info);
     */
}

function addAnotherImagePlace(src) {
    let fm = src.closest('form.image__load__form');
    let fs = fm.querySelector('input[type="file"]');
    let sample = fm.querySelector('#img_ld_struct').innerHTML;
    let ul = src.closest('ul');
    let cap = ul.querySelectorAll('li').length;
    if (cap < 9) {
        let li = document.createElement('li');
        li.className='image__upload__elem__pad';
        ul.removeChild(src);
        ul.appendChild(li);
        ul.appendChild(src);

        let container = document.createElement('div');
        container.className = 'img_ld_struct';
        container.innerHTML = sample;

        li.appendChild(container);

        if (cap == 8) {
            src.classList.add('h');
        }

        pwLI = li;

        fs.click();
    }
}

function clearImage(src) {

    return false;
}
