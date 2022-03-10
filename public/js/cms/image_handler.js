'use strict';

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
                itemControlPanel = null;
                document.body.querySelector('section.data__list__empty').outerHTML = response.view;
                break;
            case 'RITM':
                dropErrorVeil();
                canClose = true;
            case 'CRLD':
                document.body.querySelector('section.page__band').innerHTML = response.view;
                break;
            case 'PWRM':
                dropErrorVeil();
            case 'PRLD':
                document.body.querySelector('div.preview__location').innerHTML = response.view;
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

function previewReady(src) {
    src.closest('.image__preview__pad').classList.remove('non__loaded');
}

function editImageTagSet(src) {
    if (!formPadOn) {
        let control = src.closest('div#item_control_panel');
        let itemId = +control.getAttribute('data-id');

        let pms = [
            `opcode=ETAG`,
            `recId=${itemId}`,
            `section=images`,
        ];

        raiseVeil(5, true);
        buildFormPad();

        formPadLR.className = 'wait__form';
        formPadLR.style.top = '50px';
        formPadLR.style.right = (document.body.clientWidth - formPadLR.offsetWidth) / 2 + 'px';
        formPadLR.style.zIndex = 6;
        formPadLR.classList.add('on');

        sendPOSTRequest(imgURL, pms, buildImageTagSetEditForm);

        formPadOn = true;
    }

    hideItemControlPanel();

    return false;
}

function buildImageTagSetEditForm(resp) {
    let rsp = null;
    try {
        rsp = JSON.parse(resp);
        if (rsp.success == 0) {
            setError(rsp);
        } else {
            let contents = JSON.parse(rsp.contents);
            formPadLR.className = '';
            formPadLR.innerHTML = contents.view;
            formPadLR.style.right = (document.body.clientWidth - formPadLR.offsetWidth) / 2 + 'px';
            updateVeilWaitState(veilLR);
        }
    } catch (e) {

    } finally {
        rq_sent = false;
    }
}

function editImageItem(src) {
    if (!formPadOn) {
        let control = src.closest('div#item_control_panel');
        let itemId = +control.getAttribute('data-id');

        let pms = [
            `opcode=EDIM`,
            `recId=${itemId}`,
            `section=images`,
        ];

        raiseVeil(5, true);
        buildFormPad();

        formPadLR.className = 'wait__form';
        formPadLR.style.top = '50px';
        formPadLR.style.right = (document.body.clientWidth - formPadLR.offsetWidth) / 2 + 'px';
        formPadLR.style.zIndex = 6;
        formPadLR.classList.add('on');

        sendPOSTRequest(imgURL, pms, buildImageEditForm);

        formPadOn = true;
    }

    hideItemControlPanel();

    return false;
}

function buildImageEditForm(resp) {
    let rsp = null;
    try {
        rsp = JSON.parse(resp);
        if (rsp.success == 0) {
            setError(rsp);
        } else {
            let contents = JSON.parse(rsp.contents);
            formPadLR.className = '';
            formPadLR.innerHTML = contents.view;
            formPadLR.style.right = (document.body.clientWidth - formPadLR.offsetWidth) / 2 + 'px';
            updateVeilWaitState(veilLR);
        }
    } catch (e) {

    } finally {
        rq_sent = false;
    }
}

function closeEditForm(src) {
    if (formPadOn && canClose) {
        enableSelection = true;
        imageSelectedCount = 0;
        formPadLR.className = 'off';
        formPadLR.innerHTML = '';
        formPadOn = false;
        canSend = true;
        pwLI = null;

        dropVeil();
    }
}

function buildAddPreviewForm(resp) {
    let rsp = null;
    try {
        rsp = JSON.parse(resp);
        if (rsp.success == 0) {
            setError(rsp);
        } else {
            let contents = JSON.parse(rsp.contents);
            showExtraForm(contents.view);
            extraFormPadLR.style.top = '50px';
            extraFormPadLR.style.right = '50px';
            extraFormPadLR.querySelector('ul').addEventListener('click', selectPreviewImage, false);
            extraFormPadLR.querySelector('form.preview__load__form').pwup.click();
        }
    } catch (e) {

    } finally {
        updateVeilWaitState(veilLR);
        canClose = true;
        rq_sent = false;
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

function executePreviewDelete(url, id, section, wcbf) {
    let pms = [
        `opcode=PWRM`,
        `recId=${id}`,
        `section=${section}`,
    ];

    sendPOSTRequest(url, pms, wcbf);
}

function reloadPreview(url, id, section, wcbf) {
    let pms = [
        `opcode=PRLD`,
        `recId=${id}`,
        `section=${section}`,
    ];

    sendPOSTRequest(url, pms, wcbf);
}

function uploadPreview(src) {
    let frame = src.closest('div#preview_control_panel');
    let itemId = +frame.getAttribute('data-id');
    let fm = document.body.querySelector('form.image__edit__form');

    canClose = false;
    fm.close_button.classList.add('button__disabled');
    formPadLR.style.zIndex = 4;
    hidePreviewControlPanel();
    updateVeilWaitState(veilLR, true);

    prepareExtraForm();

    let pms = [
        `opcode=PWAF`,
        `recId=${itemId}`,
        `section=images`,
    ];

    sendPOSTRequest(imgURL, pms, buildAddPreviewForm);
    rq_sent = true;

    return false;
}

function selectPreviewImage(e) {
    if (e.target.closest('div.image__preview__pad') != null && e.target.closest('div.image__preview__pad').tagName == 'DIV') {
        if (enableSelection) {
            let pwLI = e.target.closest('li.preview__upload__elem__pad');
            let fs = pwLI.querySelector('input[type="file"]');
            fs.click();
        }
    }
}

function specifyPreviewImage(fs) {
    let pwLI = fs.closest('li.preview__upload__elem__pad');
    let ic = pwLI.querySelector('.image__preview__pad');
    let ds = pwLI.querySelector('.no__file__selected');
    let dc = pwLI.querySelector('.preview__status');
    const img = document.createElement("img");
    img.src = URL.createObjectURL(fs.files[0]);

    if (ic.hasChildNodes()) {
        resetPreviewPad(pwLI);
    }

    img.onload = function () {
        URL.revokeObjectURL(img.src);
        recalcImageSizes(ic.offsetWidth, ic.offsetHeight, img);

        if (Math.floor(fs.files[0].size / 1024) < previewMaxSize) {
            ic.classList.remove('non__loaded');
            ic.appendChild(img);
            ic.title = '';
            ds.setAttribute('data-selected', '1');
            dc.innerHTML = fs.files[0].name;
        } else {
            let errorset = {
                errorcode: 0xe0,
                section: 'images',
                options: {
                    'data': `${previewMaxSize}kB`
                }
            };

            setError(errorset);
        }

        checkPreviewControls(fs);
    }
}

function closePreviewForm(src = null) {
    if (!canClose) {
        return;
    }

    let fm = document.body.querySelector('form.image__edit__form');
    extraFormPadLR.querySelector('ul').removeEventListener('click', selectPreviewImage, false);
    destroyExtraForm();
    canClose = true;
    fm.close_button.classList.remove('button__disabled');
    formPadLR.style.zIndex = 6;
}

function deletePreview(src) {
    let control = src.closest('div#preview_control_panel');
    let itemId = +control.getAttribute('data-id');
    hidePreviewControlPanel();
    updateVeilWaitState(veilLR, true);

    let errorset = {
        errorcode: 0xd1,
        section: 'images',
        options: {
            id: itemId
        }
    };

    setError(errorset);

    return false;
}

function checkLocationDataMismatch(src) {
    let mismatch = 0;
    let defVal = src.getAttribute('data-def');
    let fm = document.getElementById('edit_location');
    let fmDefSatus = +fm.getAttribute('data-def');

    switch (src.tagName.toUpperCase()) {
        case 'SELECT':
            mismatch = (+src.options[src.selectedIndex].value == +defVal) ? 0x0 : 0x2;
            mismatch = (fmDefSatus ^ mismatch) & 0x2;
            break;
        case 'INPUT':
            if (src.value.length > 0) {
                mismatch = (MD5(src.value) == defVal) ? 0x0 : 0x1;
            } else {
                mismatch = 0x1;
            }

            mismatch = (fmDefSatus ^ mismatch) & 0x1;
            break;
        default:
            return false;
    }

    fmDefSatus ^= mismatch;
    fm.setAttribute('data-def', `${fmDefSatus}`);

    if (!fm.reset_button.classList.contains('button__disabled') ^ fmDefSatus > 0) {
        fm.reset_button.classList.toggle('button__disabled');
    }

    if (!fm.replace_button.classList.contains('button__disabled') ^ fmDefSatus > 0) {
        fm.replace_button.classList.toggle('button__disabled');
    }
}

function resetImageRelocationForm(fm) {
    if (+fm.getAttribute('data-def') == 0) {
        return false;
    }

    fm.setAttribute('data-def', '0');

    if (!fm.reset_button.classList.contains('button__disabled')) {
        fm.reset_button.classList.add('button__disabled');
    }

    if (!fm.replace_button.classList.contains('button__disabled')) {
        fm.replace_button.classList.add('button__disabled');
    }

    return true;
}

function updateImageRelocationForm(resp) {
    let rsp = null;
    let contents = null;
    let fm = null;
    try {
        rsp = JSON.parse(resp);
        contents = JSON.parse(rsp.contents);
        if (contents.success == 0) {
            rq_sent = false;
            setError(contents);
            return;
        } else {
            fm = document.getElementById('edit_location');
            fm.location.setAttribute('data-def', `${contents.def_location}`);
            fm.location.querySelector('option[selected]').removeAttribute("selected");
            fm.location.querySelector(`option[value='${contents.def_location}']`).setAttribute('selected', 'selected');
            fm.file_name.setAttribute('data-def', contents.fn_hash);
            fm.file_name.defaultValue = fm.file_name.value;
            fm.setAttribute('data-def', '0');
        }
    } catch (e) {
        console.log(e);
    } finally {
        canClose = true;
        formPadLR.style.zIndex = 6;
        document.body.querySelector('form.image__edit__form').close_button.classList.remove('button__disabled');
        updateVeilWaitState(veilLR);
        rq_sent = false;
    }
}

function submitImageRelocation(fm, force_overwrite = false) {
    if (+fm.getAttribute('data-def') == 0) {
        return false;
    }

    let globForm = document.body.querySelector('form.image__edit__form');
    let pms = [
        `_token=${pickToken(globForm)}`,
        `force_overwrite=${(force_overwrite) ? 1 : 0}`,
    ];

    for (let field of Object.values(fm)) {
        if (field.getAttribute('data-type') == null || field.getAttribute('data-type') != 'form_field') {
            continue;
        }

        switch (field.tagName.toLocaleUpperCase()) {
            case 'INPUT':
                if (field.type.toLowerCase() == 'text' || field.type.toLowerCase() == 'hidden') {
                    pms.push(`${field.name}=${encodeURIComponent(field.value)}`);
                } else if (field.type.toLowerCase() == 'checkbox') {
                    let state = (field.checked) ? 1 : 0;
                    pms.push(`${field.name}=${state}`);
                }

                break;
            case 'SELECT':
                pms.push(`${field.name}=${field.options[field.selectedIndex].value}`);
                break;
        }
    }

    canClose = false;
    globForm.close_button.classList.add('button__disabled');
    fm.reset_button.classList.add('button__disabled');
    fm.replace_button.classList.add('button__disabled');
    formPadLR.style.zIndex = 4;
    updateVeilWaitState(veilLR, true);

    sendPOSTRequest(imgURL, pms, updateImageRelocationForm);

    rq_sent = true;

    return false;
}

