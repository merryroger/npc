'use strict';

let tabConf = {
    defCol: 'id',
    defSort: 'asc',
    headers: {
        'id': {'class_list': 'rb la sortable'},
        'name': {'class_list': 'rb sortable'},
        'controls': {}
    },
    rows: {
        header: {
            render(headers, defCol = 'id', sort = 'asc') {
                let row = document.createElement('tr');
                row.className = 'df__header__row';

                for (let [key, data] of Object.entries(headers)) {
                    let th = document.createElement('th');
                    th.name = key;
                    th.className = (data['class_list']) ? data['class_list'] : '';
                    let sort_sign = (sort == 'asc') ? '▲' : '▼';
                    th.innerHTML = (key == defCol) ? `${getVocabulary(key)}&nbsp;${sort_sign}` : getVocabulary(key);
                    row.appendChild(th);
                }

                return row;
            }
        },
        body: {
            render(headers, cells, data) {
                let row = document.createElement('tr');
                row.setAttribute('data-id', data['id']);
                for (let key of Object.keys(headers)) {
                    switch (key) {
                        case 'controls':
                            row.appendChild(cells[key].render(+data['id'], getVocabulary('delete_record')));
                            break;
                        default:
                            row.appendChild(cells[key].render(data));
                    }
                }

                return row;
            }
        }
    },
    cells: {
        id: {
            render(data) {
                let td = document.createElement('td');
                td.className = (data['hidden']) ? 'style__hidden ca' : 'ca';
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
        name: {
            render(data) {
                let td = document.createElement('td');
                td.className = (data['hidden']) ? 'style__hidden' : '';
                td.innerHTML = data['name'];
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
        controls: {
            render(id, title) {
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
        },
    },
};

function tableClickEvent(e) {
    switch (e.target.tagName) {
        case 'TH':
                if (e.target.classList.contains('sortable')) {
                    sortTable(e.target.closest('table'), e.target.name);
                }
            break;
        case 'SPAN':
            if (e.target.classList.contains('delete__ctrl')) {
                requestDeleteItem(e.target);
            }
            break;
    }
}

function tableDBLClickEvent(e) {
    if (e.target.tagName == 'TD' && e.target.closest('tr') != null) {
        requestEditItem(e.target.closest('tr'));
    }
}

function tableRebuild(cts) {
    let frame = document.body.querySelector('section.data__list') || document.body.querySelector('section.data__list__empty');

    if (frame !== null) {
        frame.outerHTML = cts.view;

        if (frame.classList.contains('data__list__empty')) {
            let vocabulary = JSON.parse(cts.vocabulary)
            deployDataset(cts.dataset, vocabulary);
        }
    }

}