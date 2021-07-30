'use strict';

const imgURL = '/cms/images';
const imgMaxSize = 1024;

let formPadLR = null;
let formPadOn = false;
let imageSelectedCount = 0;
let canSend = false;
let canClose = true;
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
        imageSelectedCount = 0;
        formPadLR.querySelector('ul').removeEventListener('click', selectImage, false);
        formPadLR.className = 'off';
        formPadLR.innerHTML = '';
        formPadOn = false;
        pwLI = null;

        dropVeil();
    }
}

function selectImage(e) {
    if (e.target.closest('.no__file__selected') != null || e.target.className == 'h') {
    } else if (e.target.closest('li.image__upload__elem__pad') != null && e.target.closest('li.image__upload__elem__pad').tagName == 'LI') {
        pwLI = e.target.closest('li.image__upload__elem__pad');
        let fs = pwLI.querySelector('input[type="file"]');
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
        resetImagePad(pwLI);
    }

    img.onload = function () {
        URL.revokeObjectURL(img.src);
        if (img.width > img.height) {
            img.width = (img.width < 160) ? img.width : 160;
        } else {
            img.height = (img.height < 120) ? img.height : 120;
        }

        if (Math.floor(fs.files[0].size / 1024) < imgMaxSize) {
            ic.classList.remove('no__photo');
            ic.appendChild(img);
            ic.title = '';
            ds.setAttribute('data-selected', '1');
            dc.innerHTML = fs.files[0].name;
            imageSelectedCount++;

            checkFormControls(fs);
        } else {
            let errorset = {
                errorcode: 0xe0,
                section: 'images',
                options: {
                    'data': '1MB'
                }
            };

            setError(errorset);
        }
    }
}

function addAnotherImagePlace(src) {
    let fm = src.closest('form.image__load__form');
    let sample = fm.querySelector('#img_ld_struct').innerHTML;
    let ul = src.closest('ul');
    let cap = ul.querySelectorAll('li').length;
    if (cap < 9) {
        let li = document.createElement('li');
        li.className = 'image__upload__elem__pad';
        ul.removeChild(src);
        ul.appendChild(li);
        ul.appendChild(src);

        let container = document.createElement('div');
        container.className = 'img_ld_struct';
        container.innerHTML = sample;
        let fs = document.createElement('input');
        fs.type = 'file';
        fs.name = `fup${cap}`;
        fs.className = "h";
        fs.accept = "image/jpeg,image/jpg,image/gif,image/png,image/webp";

        li.appendChild(container);
        li.appendChild(fs);
        fs.onchange = specifyImage.bind(null, fs);

        if (cap == 8) {
            src.classList.add('h');
        }

        pwLI = li;
        fs.click();
    }
}

function clearImage(src) {
    let ul = src.closest('ul');
    let cap = ul.querySelectorAll('li').length;
    let li = src.closest('li');

    if (cap == 9) {
        ul.querySelector('button').classList.remove('h')
    }

    if (cap > 1) {
        li.innerHTML = '';
        ul.removeChild(li);
        pwLI = null;
        imageSelectedCount--;
    } else {
        resetImagePad(li);
        pwLI = li;
        imageSelectedCount = 0;
    }

    checkFormControls(ul);
    return false;
}

function checkFormControls(src) {
    let fm = src.closest('form');
    let sb = fm.send_button;
    if (imageSelectedCount == 0) {
        canSend = false;
        sb.className = 'button__disabled';
    } else {
        canSend = true;
        sb.className = '';
    }
}

function resetImagePad(li) {
    let fm = li.closest('form');
    li.querySelector('.img__ld__pad').innerHTML = '';
    li.querySelector('.img__ld__pad').classList.add('no__photo');
    li.querySelector('.img__ld__pad').title = fm.querySelector('.img__ld__pad').title;
    li.querySelector('.no__file__selected').setAttribute('data-selected', '0');
    li.querySelector('span.img__status').innerHTML = fm.querySelector('#img_ld_struct').querySelector('span.img__status').innerHTML;
}

function sendImages(src) {
    let fm = src.closest('form');
    let ul = fm.querySelector('ul');
    let lis = Array.from(ul.querySelectorAll('li'));

    if (canSend) {
        fm.send_button.className = 'button__disabled';
        fm.close_button.className = 'button__disabled';
        fm.another_image.classList.add('h');
        canClose = false;
        canSend = false;
        for (let lx = 0; lx < lis.length; lx++) {
            lis[lx].querySelector('.rm__image').classList.add('h');
        }

        fm.submit();
    }
}
