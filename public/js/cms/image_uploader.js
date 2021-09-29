'use strict';

const imgURL = '/cms/images';
const imgMaxSize = 1024;
const previewMaxSize = 20;

let imageSelectedCount, fId = 0;
let enableSelection = true;
let canSend = false;
let canClose = true;
let pwLI = null;
let uWDT = 0;
let uth = 0;

function getImageAddForm(src) {
    if (!formPadOn) {
        raiseVeil(5, true);
        buildFormPad();

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
        updateVeilWaitState(veilLR);
        rq_sent = false;
    }
}

function closeForm(src) {
    if (formPadOn && canClose) {
        enableSelection = true;
        imageSelectedCount = 0;
        formPadLR.querySelector('ul').removeEventListener('click', selectImage, false);
        formPadLR.className = 'off';
        formPadLR.innerHTML = '';
        formPadOn = false;
        canSend = true;
        pwLI = null;

        dropVeil();
    }
}

function selectImage(e) {
    if (e.target.closest('.no__file__selected') != null || e.target.className == 'h') {
    } else if (e.target.closest('li.image__upload__elem__pad') != null && e.target.closest('li.image__upload__elem__pad').tagName == 'LI') {
        if (enableSelection) {
            pwLI = e.target.closest('li.image__upload__elem__pad');
            let fs = pwLI.querySelector('input[type="file"]');
            fs.click();
            e.preventDefault();
        }
    } else if (e.target.tagName == 'BUTTON' && e.target.getAttribute('name') == 'another_image') {
        addAnotherImagePlace(e.target);
    }
}

function specifyImage(fs) {
    let ic = pwLI.querySelector('.img__ld__pad');
    let ds = pwLI.querySelector('.no__file__selected');
    let dc = pwLI.querySelector('.img__status');
    const img = document.createElement("img");
    img.src = URL.createObjectURL(fs.files[0]);

    if (ic.hasChildNodes()) {
        resetImagePad(pwLI);
    }

    img.onload = function () {
        URL.revokeObjectURL(img.src);
        recalcImageSizes(ic.offsetWidth, ic.offsetHeight, img);

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
                    'data': `${Math.round(imgMaxSize / 1024)}MB`
                }
            };

            setError(errorset);
        }
    }
}

function recalcImageSizes(reqWidth, reqHeight, img) {
    let ratio = 1;

    if (+reqWidth && +reqHeight) {
        if (img.width <= reqWidth && img.height <= reqHeight) {
            return;
        }

        let kw = img.width / +reqWidth;
        let kh = img.height / +reqHeight;

        ratio = (kh > kw) ? kh : kw;
    } else if (+reqWidth && !+reqHeight) {
        ratio = img.width / +reqWidth;
    } else if (!+reqWidth && +reqHeight) {
        ratio = img.height / +reqHeight;
    }

    img.width = Math.round(img.width / ratio);
    img.height = Math.round(img.height / ratio);
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
        fId++;
        let fs = document.createElement('input');
        fs.type = 'file';
        fs.name = `fup${fId}`;
        fs.className = "h";
        fs.accept = "image/jpeg,image/jpg,image/gif,image/png,image/webp";

        li.appendChild(container);
        li.appendChild(fs);
        fs.onchange = specifyImage.bind(null, fs);
        updateFieldList(fs.name, '+');

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
    let fs = li.querySelector('input[type="file"]');

    if (cap == 9) {
        ul.querySelector('button').classList.remove('h')
    }

    if (cap > 1) {
        li.innerHTML = '';
        ul.removeChild(li);
        updateFieldList(fs.name, '-');
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
    let ul = fm.querySelector('ul');
    let lis = Array.from(ul.querySelectorAll('li'));
    let sb = fm.send_button;

    imageSelectedCount = 0;

    for (let lx = 0; lx < lis.length; lx++) {
        if (+lis[lx].querySelector('.no__file__selected').getAttribute('data-selected') == 1) {
            imageSelectedCount++;
        }
    }

    if (imageSelectedCount == 0) {
        canSend = false;
        sb.className = 'button__disabled';
    } else {
        canSend = true;
        sb.className = '';
    }
}

function checkPreviewControls(src) {
    let fm = src.closest('form');
    let ds = fm.querySelector('div.no__file__selected');
    let sb = fm.send_button;

    if (+ds.getAttribute('data-selected')) {
        canSend = true;
        sb.className = '';
    } else {
        canSend = false;
        sb.className = 'button__disabled';
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

function resetPreviewPad(li) {
    li.querySelector('.image__preview__pad').innerHTML = '';
    li.querySelector('.image__preview__pad').classList.add('non__loaded');
    li.querySelector('.image__preview__pad').title = li.querySelector('.image__preview__pad').getAttribute('data-title');
    li.querySelector('.no__file__selected').setAttribute('data-selected', '0');
    li.querySelector('span.preview__status').innerHTML = li.querySelector('span.preview__status').getAttribute('data-defstatus');
}

function sendImages(src) {
    let fm = src.closest('form');
    let ul = fm.querySelector('ul');
    let lis = Array.from(ul.querySelectorAll('li'));

    if (canSend) {
        fm.send_button.className = 'button__disabled';
        fm.close_button.className = 'button__disabled';
        fm.another_image.classList.add('h');
        enableSelection = false;
        canClose = false;
        canSend = false;
        for (let lx = 0; lx < lis.length; lx++) {
            lis[lx].querySelector('.rm__image').classList.add('h');
            lis[lx].querySelector('.img__ld__pad').style.cursor = 'not-allowed';
            if (lis[lx].querySelector('img') != null) {
                lis[lx].querySelector('img').style.cursor = 'not-allowed';
            }
            let dataHolder = lis[lx].querySelector('.no__file__selected');
            if (+dataHolder.getAttribute('data-selected') == 0) {
                let fs = lis[lx].querySelector('input[type="file"]');
                updateFieldList(fs.name, '-');
            } else {
                dataHolder.classList.add('wait__upload');
            }
        }

        fm.submit();
        uWDT = 12;
        uth = setTimeout(checkUploads, 10);
    }
}

function updateFieldList(name, op) {
    let fm = document.body.querySelector('form.image__load__form');
    let fields = fm.fields.value.split(',');
    switch (op) {
        case '+':
            fields[fields.length] = name;
            break;
        case '-':
            let pos = fields.indexOf(name);
            if (pos > -1) {
                fields.splice(pos, 1);
            }
            break;
    }

    fm.fields.value = fields.join(',');
}

function checkUploads() {
    let fm = document.body.querySelector('form.image__load__form');
    let ul = fm.querySelector('ul');
    let lis = Array.from(ul.querySelectorAll('li'));
    let fnames = {};
    let fsizes = {};
    let ftypes = {};
    let cap = 0;
    let pms = [
        'opcode=CFUP',
        `pack_id=${fm.pack_id.value}`
    ];

    for (let lx = 0; lx < lis.length; lx++) {
        let dataHolder = lis[lx].querySelector('.no__file__selected');
        if (+dataHolder.getAttribute('data-selected') == 1) {
            let fs = lis[lx].querySelector('input[type="file"]');
            fnames[lx] = fs.name;
            fsizes[lx] = fs.files[0].size;
            ftypes[lx] = fs.files[0].name.split('.').splice(-1, 1)[0];
            cap++;
        }
    }

    if (cap > 0) {
        pms[pms.length] = 'fnames=' + JSON.stringify(fnames);
        pms[pms.length] = 'fsizes=' + JSON.stringify(fsizes);
        pms[pms.length] = 'ftypes=' + JSON.stringify(ftypes);
        sendPOSTRequest(imgURL, pms, uploadResults);
    }

}

function walkImages(files, final_pass = false) {
    let fm = document.body.querySelector('form.image__load__form');
    let ul = fm.querySelector('ul');
    let lis = Array.from(ul.querySelectorAll('li'));
    let needReload = false;
    let cap = 0;

    for (let lx = 0; lx < lis.length; lx++) {
        let dataHolder = lis[lx].querySelector('.no__file__selected');
        if (+dataHolder.getAttribute('data-selected') == 1) {
            let fs = lis[lx].querySelector('input[type="file"]');
            let state = +files[fs.name];
            if (state == 1) {
                dataHolder.setAttribute('data-selected', '0');
                dataHolder.classList.remove('wait__upload');
                dataHolder.querySelector('.upload__ok').classList.remove('h');
                needReload = true;
            } else if (final_pass) {
                dataHolder.classList.remove('wait__upload');
                dataHolder.querySelector('.upload__failed').classList.remove('h');
            } else {
                cap++;
            }
        }
    }

    if (needReload || final_pass) {
        reloadCollection(imgURL, 'images', reloadImageCollection, {'page': 1});
    }

    return cap;
}

function uploadResults(resp) {
    let files;
    try {
        let rsp = JSON.parse(resp);
        files = JSON.parse(rsp.contents);
    } catch (e) {
    } finally {
        uWDT--;
        rq_sent = false;
        if (uWDT == 0) {
            walkImages(files, true);
            clearTimeout(uth);
            uth = 0;

            let errorset = {
                errorcode: 0xe1,
                section: 'images',
                options: {}
            };
            setError(errorset);
            return;
        }

        if (walkImages(files) == 0) {
            setTimeout(finishUpload, 1500);
        } else {
            uth = setTimeout(checkUploads, 5000);
        }
    }
}

function finishUpload() {
    canClose = true;
    closeForm();
}

function finishPreviewUpload() {
    canClose = true;
    closePreviewForm();
}

function sendPreviewImage(src) {
    let fm = src.closest('form');
    let li = fm.querySelector('li.preview__upload__elem__pad');

    if (canSend) {
        fm.send_button.className = 'button__disabled';
        fm.close_button.className = 'button__disabled';
        enableSelection = false;
        canClose = false;
        canSend = false;

        li.querySelector('.like__rm__image').classList.add('h');
        li.querySelector('.image__preview__pad').style.cursor = 'not-allowed';
        if (li.querySelector('img') != null) {
            li.querySelector('img').style.cursor = 'not-allowed';
        }

        let dataHolder = li.querySelector('.no__file__selected');
        dataHolder.classList.add('wait__upload');

        fm.submit();
        uWDT = 12;
        uth = setTimeout(checkPreviewUpload, 10);
    }
}

function checkPreviewUpload() {
    let fm = document.body.querySelector('form.preview__load__form');
    let dataHolder = fm.querySelector('.no__file__selected');
    let fs = fm.querySelector('input[type="file"]');

    let pms = [
        'opcode=PWUP',
        `recId=${fm.recId.value}`
    ];

    if (+dataHolder.getAttribute('data-selected') == 1) {
        pms[pms.length] = 'fname=' + fs.name;
        pms[pms.length] = 'fsize=' + fs.files[0].size;
        pms[pms.length] = 'ftype=' + fs.files[0].name.split('.').splice(-1, 1)[0];
        sendPOSTRequest(imgURL, pms, previewUploadResult);
    }

}

function ifPreviewUploaded(preview, final_pass = false) {
    let fm = document.body.querySelector('form.preview__load__form');
    let dataHolder = fm.querySelector('.no__file__selected');
    let fs = fm.querySelector('input[type="file"]');
//    let needReload = false;
    let cap = 0;

    if (+dataHolder.getAttribute('data-selected') == 1) {
        if (+preview == 1) {
            dataHolder.setAttribute('data-selected', '0');
            dataHolder.classList.remove('wait__upload');
            dataHolder.querySelector('.upload__ok').classList.remove('h');
//                needReload = true;
        } else if (final_pass) {
            dataHolder.classList.remove('wait__upload');
            dataHolder.querySelector('.upload__failed').classList.remove('h');
        } else {
            cap++;
        }
    }

//    if (needReload || final_pass) {
//        reloadCollection(imgURL, 'images', reloadImageCollection, {'page': 1});
//    }

    return cap;
}

function previewUploadResult(resp) {
    let preview;
    try {
        let rsp = JSON.parse(resp);
        preview = JSON.parse(rsp.contents);
    } catch (e) {
    } finally {
        uWDT--;
        rq_sent = false;
        if (uWDT == 0) {
            ifPreviewUploaded(preview, true);
            clearTimeout(uth);
            uth = 0;

            let errorset = {
                errorcode: 0xe2,
                section: 'images',
                options: {}
            };
            setError(errorset);
            return;
        }

        if (ifPreviewUploaded(preview) == 0) {
            setTimeout(finishPreviewUpload, 1500);
        } else {
            uth = setTimeout(checkPreviewUpload, 5000);
        }
    }
}
