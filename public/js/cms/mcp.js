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

function showCMSSubMenu(id, lvl, src, data = null) {
    let hid = `cmm_sub_lvl_${lvl}`;
    let holder = document.body.querySelector(`#${hid}`);

    if (holder == null) {
        holder = document.createElement('div');
        holder.id = hid;
        holder.className = 'off';
        holder.setAttribute('data-level', `${lvl}`);
        document.body.appendChild(holder);
    }

    let status = holder.className;

    if (status == 'off') {
        let scr = getCoordsRect(src);
        holder.classList = 'on';
        holder.style.top = scr.top + 'px';
        holder.style.left = scr.left + scr.width - 5 + 'px';
        holder.style.zIndex = 11 + +lvl;
    }

    if (data == null) {
        holder.innerHTML = '';
        holder.classList.add('sm__await');
    } else {
        holder.innerHTML = data;
    }

    openMenuLevel(lvl, `cmm_sub_lvl_${lvl}`, holder);
}

function getSubmenu(agrp, node, mode, level, parent, src) {
    let id = `menuid_${parent}`;
    let subMenu = localStorage.getItem(id);

    if (subMenu == null) {
        let pms = [
            `opcode=RQSM`,
            `access_group=${agrp}`,
            `node=${node}`,
            `level=${level}`,
            `parent=${parent}`
        ];

        sendPOSTRequest('/cms/menu', pms, loadSubmenu);
        showCMSSubMenu(+parent, +level, src);
    } else {

    }

    //console.log(subMenu);

    return false;
}

function loadSubmenu(resp) {
    let sm = JSON.parse(resp);

    for (let i = 0; i < sm.length; i++) {
        console.log(sm[i]);
    }
}
