'use strict';

function mcpToggle(src) {
    let mcp = src.closest('#mcp_pad');
    let tsp = src.querySelector('p');

    let status = mcp.className;
    if (status == 'pulled') {
        mcp.className = 'pushed';
        tsp.className = 'pushed';
    } else {
        mcp.className = 'pulled';
        tsp.className = 'pulled';
    }

    return false;
}

function showUserControlPanel(src) {
    let ucp = document.body.querySelector('#ucp_pad');
    let status = ucp.className;

    if (status == 'off') {
        let scr = getCoordsRect(src);
        ucp.classList = 'on';
        ucp.style.top = scr.top + 'px';
        ucp.style.left = scr.left + scr.width + 10 - ucp.offsetWidth + 'px';
        ucp.style.zIndex = 11;

        openMenuLevel(0, 'ucp', ucp);
    }
}

function showCMSMenu(src, lvl, purpose) {
    let cp = document.body.querySelector(`#cmm_${purpose}`);
    let status = cp.className;

    if (status == 'off') {
        let scr = getCoordsRect(src);
        cp.classList = 'on';
        cp.style.top = scr.top + 'px';
        cp.style.left = scr.left + 'px';
        cp.style.zIndex = 10 + +lvl;

        openMenuLevel(+lvl, `cmm_${purpose}`, cp);
    }

}

function getSubmenu(agrp, node, mode, level, parent) {
    console.log(agrp, node, mode, level, parent);
    return false;
}
