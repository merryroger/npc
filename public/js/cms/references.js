'use strict';

let formPadLR = null;
let formPadOn = false;
let canClose = true;
let sectionVocabulary = {};

function deployDataset(dataset, vocabulary = {}) {
    setVocabulary(vocabulary);
    raiseVeil(5, true);
    renderDataTable(dataset);
    dropVeil();
}

function setVocabulary(voc) {
    sectionVocabulary = voc;
}

function getVocabulary(key) {
    return sectionVocabulary[key];
}

function closeForm(src = null) {
    if (formPadOn && canClose) {
        formPadLR.className = 'off';
        formPadLR.innerHTML = '';
        formPadOn = false;

        dropVeil();
    }
}
