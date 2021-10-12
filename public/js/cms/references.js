'use strict';

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

function getVocabulary($key) {
    return sectionVocabulary[$key];
}
