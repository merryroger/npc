'use strict';

let tabConf = {
    defCol: 'id',
    defSort: 'asc',
    headers: {
        'id': {'class_list': 'lb la sortable'},
        'name': {'class_list': 'lb sortable'},
        'rel_path': {'class_list': 'lb la sortable'},
        'hidden': {'class_list': 'lb sortable'},
        'controls': {}
    },
    rows: {
        header: {
            render(headers, defCol = 'id', sort = 'asc') {
                let row = document.createElement('tr');
                row.className = 'df__header__row';

//                for (let [key, data] of Object.entries(headers)) {
//                    let th = document.createElement('th');
//                    th.name = key;
//                    th.className = (data['class_list']) ? data['class_list'] : '';
//                    let sort_sign = (sort == 'asc') ? '▲' : '▼';
//                    th.innerHTML = (key == defCol) ? `${getVocabulary(key)}&nbsp;${sort_sign}` : getVocabulary(key);
//                    row.appendChild(th);
//                }

                return row;
            }
        },
/*        body: {
            render(headers, cells, data) {
                let row = document.createElement('tr');
                row.setAttribute('data-id', data['id']);
                for (let key of Object.keys(headers)) {
                    switch (key) {
                        case 'controls':
                            row.appendChild(cells[key].render(getVocabulary('delete')));
                            break;
                        default:
                            row.appendChild(cells[key].render(data));
                    }
                }

                return row;
            }
        } */
    },
    cells: {
/*        id: {
            render(data) {
                let td = document.createElement('td');
                td.className = (data['hidden']) ? 'style__hidden' : '';
                td.innerHTML = data['id'];
                return td;
            },
            getValue(cells) {
                return +cells[0].innerHTML;
            },
            compare(value1, value2) {
                return value1 - value2;
            },
        },
        short_name: {
            render(data) {
                let td = document.createElement('td');
                td.className = (data['hidden']) ? 'style__hidden' : '';
                td.innerHTML = data['short_name'];
                return td;
            },
            getValue(cells) {
                return cells[1].innerHTML;
            },
            compare(value1, value2) {
                return value1 > value2 ? 1 :
                    value1 == value2 ? 0 :
                        -1;
            },
        },
        full_name: {
            render(data) {
                let td = document.createElement('td');
                td.className = (data['hidden']) ? 'style__hidden' : '';
                td.innerHTML = data['full_name'];
                return td;
            },
            getValue(cells) {
                return cells[2].innerHTML;
            },
            compare(value1, value2) {
                return value1 > value2 ? 1 :
                    value1 == value2 ? 0 :
                        -1;
            },
        },
        controls: {
            render(title) {
                let td = document.createElement('td');
                td.className = 'ca ctrl__cell';
                td.style.cursor = 'default';

                let span = document.createElement('span');
                span.className = 'red delete__ctrl';
                span.title = title;
                span.innerHTML = '✖';

                td.appendChild(span);

                return td;
            }
        },*/
    },
};

/*
function listRepaint(rsp) {
    let root = document.body.querySelector("div#root");
    let table = root.querySelector('table');
    takeOffTableListeners(table);

    ts = rsp.timestamp;
    setDataSet(rsp.dataset, ts);

    if (+rsp.records == 0) {
        root.classList.add('jcc');
        root.innerHTML = getView('empty');
    } else {
        if (root.classList.contains('jcc')) {
            root.classList.remove('jcc');
        }

        root.innerHTML = getView('default');
        table = root.querySelector('table');
        renderTableHeader(getDataSet(), table);
        renderDataSet(getDataSet(), table);
    }

    hangTableListeners(table);
}

function renderList(rsp) {
    if (rsp.success == 0) {
        setError(rsp);
    } else {
        window.parent.handleForeignEvents(rsp);
        listRepaint(rsp);

        if (addFmPulled) {
            let fm = document.getElementById('add_rec');
            fm.reset();
            pullAddForm(fm);
        }

        dropVeil();
    }
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

    renderTableHeader(getDataSet(), table);
    rows = resortTable(rows);

    table.querySelector('tbody').append(...rows);
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

function renderDataSet(ds, table) {
    let rows = [];
    for (let i = 0; i < ds.length; i++) {
        rows[rows.length] = tabConf.rows.body.render(tabConf.headers, tabConf.cells, ds[i]);
    }

    rows = resortTable(rows);
    table.querySelector('tbody').append(...rows);
}
*/
