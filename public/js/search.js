'use strict';

let panelVisibleState = false;
let rq_sent = false;
let respHolder = null;

function toggleSearchPanel(src, idx) {
	let fm = src.closest(`form#search${idx}`);
	let tf = fm.querySelector(`input#search__text${idx}`);

	if (!panelVisibleState) {
		tf.classList.remove('sp__hidden');
		tf.classList.add('sp__visible');
		tf.focus();
	}

	return false;
}

function callAuth(src, idx) {
    if (rq_sent)
        return false;

    let fm = src.closest(`form#search${idx}`);
    let tf = fm.querySelector(`input#search__text${idx}`);
    if (tf.classList.contains('sp__hidden') || tf.value.length == 0)
        return false;

    let cd = MD5(fm._token.value + MD5(fm.search__text.value));
    AJAX.post('/auth', `cd=${cd}&_token=${fm._token.value}`, authResponse);
    rq_sent = true;

    return false;
}

function authResponse(resp) {
    try {
        let response = JSON.parse(resp);
        if (response.retcode == 200) {
            showResponsePanel(response.message_panel);
        }
    } catch (e) {
    } finally {
    }
}

function showResponsePanel(data) {
    if (respHolder == null) {
        respHolder = document.createElement('div');
        respHolder.id = 'resp_holder';
        respHolder.className = 'off';
        document.body.insertAdjacentElement('beforeEnd', respHolder);
    }

    respHolder.innerHTML = data;

    respHolder.classList.remove('off');
    respHolder.style.top = '10px';
    respHolder.style.right = '10px';
    respHolder.style.zIndex = 10;
    respHolder.classList.add('on');
}
