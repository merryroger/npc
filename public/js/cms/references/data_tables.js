'use strict';

function renderDataTable(dataset) {
    let table = document.body.querySelector('table#data_table');
    renderDataHeader(table);
    renderDataSet(dataset, table)
}

function renderDataHeader(table) {
    let row = tabConf.rows.header.render(tabConf.headers, tabConf.defCol, tabConf.defSort);
    table.querySelector('thead').innerHTML = '';
    table.querySelector('thead').append(row);
}

function renderDataSet(ds, table) {
    let rows = [];
    for (let i = 0; i < ds.length; i++) {
        rows[rows.length] = tabConf.rows.body.render(tabConf.headers, tabConf.cells, ds[i]);
    }

    //rows = resortTable(rows);
    table.querySelector('tbody').append(...rows);
}
