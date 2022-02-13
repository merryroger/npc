'use strict';

function renderDataTable(dataset) {
    let table = document.body.querySelector('table#data_table');
    takeOffTableListeners(table);
    renderDataHeader(table);
    renderDataSet(dataset, table);
    hangTableListeners(table);
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

    table.querySelector('tbody').innerHTML = '';
    rows = resortTable(rows);
    table.querySelector('tbody').append(...rows);
}


function renderList(resp) {
    let rsp = JSON.parse(resp);
    let contents = JSON.parse(rsp.contents);
    if (contents.success == 0) {
        rq_sent = false;
        setError(contents);
    } else {
        if (contents.view == undefined) {
            listRepaint(contents.dataset);
        } else {
            tableRebuild(contents);
        }

        closeForm();
        dropVeil();

        rq_sent = false;
        formPadOn = false;
    }
}

function listRepaint(dataset) {
    let table = document.body.querySelector('table#data_table');

    takeOffTableListeners(table);
    renderDataSet(dataset, table);
    hangTableListeners(table);
}

function resortTable(rows) {
    let compare = tabConf.cells[tabConf.defCol].compare;
    if (compare === null)
        return;

    let getValue = tabConf.cells[tabConf.defCol].getValue;

    rows = (tabConf.defSort == 'asc') ?
        rows.sort((rowA, rowB) => compare(getValue(rowA.cells), getValue(rowB.cells))) :
        rows.sort((rowA, rowB) => compare(getValue(rowB.cells), getValue(rowA.cells)));

    return rows;
}

function sortTable(table, colId) {
    let tbody = table.querySelector('tbody');
    let rows = Array.from(tbody.rows);

    if (colId == tabConf.defCol) {
        tabConf.defSort = (tabConf.defSort == 'asc') ? 'desc' : 'asc';
    } else {
        tabConf.defCol = colId;
        tabConf.defSort = 'asc';
    }

    renderDataHeader(table);
    rows = resortTable(rows);

    table.querySelector('tbody').append(...rows);
}

function hangTableListeners(table) {
    table.addEventListener('click', tableClickEvent);
    table.addEventListener('dblclick', tableDBLClickEvent);
}

function takeOffTableListeners(table) {
    table.removeEventListener('click', tableClickEvent);
    table.removeEventListener('dblclick', tableDBLClickEvent);
}
