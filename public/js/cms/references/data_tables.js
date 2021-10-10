'use strict';

function renderDataTable(dataset) {
    let table = document.body.querySelector('table#data_table');
    renderDataHeader(table);
}

function renderDataHeader(table) {
    let row = tabConf.rows.header.render(tabConf.headers, tabConf.defCol, tabConf.defSort);
    table.querySelector('thead').innerHTML = '';
    table.querySelector('thead').append(row);
}