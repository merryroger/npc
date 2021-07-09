'use strict';

let panelVisibleState = false;
let rq_sent = false;

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
    let fm = src.closest(`form#search${idx}`);
    let _token = fm._token.value;
    let tf = fm.querySelector(`input#search__text${idx}`);
    if (tf.classList.contains('sp__hidden') || tf.value.length == 0)
        return false;

    let cd = MD5(fm._token.value + MD5(fm.search__text.value));
    AJAX.post('/auth', `cd=${cd}&_token=${fm._token.value}`, authResponse);
    rq_sent = true;

    return false;
}

function authResponse(resp) {
    console.log(resp);
}
