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
        } else if (response.retcode == 304) {
            document.location.assign(atob(response.cms_redirect));
        }
    } catch (e) {
    } finally {
    }
}

function selectMode(src) {
    let fm = src.closest("form#auth_type_selector");
    let pf = fm.querySelector("div#pass_field");
    let val = src.options[src.selectedIndex].value;
    if (val == 'login') {
        if (pf.classList.contains('h')) {
            pf.classList.remove('h');
            fm.passwd.required = true;
        }
    } else {
        if (!pf.classList.contains('h')) {
            pf.classList.add('h');
            fm.passwd.required = false;
        }
    }
}

function showResponsePanel(data) {
    if (respHolder == null) {
        respHolder = document.createElement('div');
        respHolder.id = 'resp_holder';
        respHolder.className = 'off';
        document.body.insertAdjacentElement('beforeEnd', respHolder);
    }

    respHolder.innerHTML = unamp(data);

    respHolder.classList.remove('off');
    respHolder.style.top = '10px';
    respHolder.style.right = '10px';
    respHolder.style.zIndex = 10;
    respHolder.classList.add('on');
}

function hideResponsePanel() {
    respHolder.classList.remove('on');
    respHolder.classList.add('off');
    respHolder.innerHTML = '';
}

function checkTypeSend(fm) {
    let sel = fm.auth_type;
    let pms = [
        `keyhash=${fm.keyhash.value}`,
        `_token=${fm._token.value}`,
        `auth_type=${sel.options[sel.selectedIndex].value}`
    ];

    if (sel.options[sel.selectedIndex].value == 'login') {
        pms[pms.length] = `passw=${MD5(fm.keyhash.value + MD5(fm.passwd.value))}`;
    }

    AJAX.post('/authconf', pms.join('&'), authResponse);

    return false;
}
