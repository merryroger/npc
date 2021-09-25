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
                document.body.querySelector('section.data__list__empty').outerHTML = response.view;
                break;
            case 'RITM':
                dropErrorVeil();
                canClose = true;
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
