'use strict';

let panelVisibleState = false;

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
