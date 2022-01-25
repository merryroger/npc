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
    let scr = getCoordsRect(src);

    if (holder == null) {
        holder = document.createElement('div');
        holder.id = hid;
        holder.className = 'off';
        holder.setAttribute('data-level', `${lvl}`);
        document.body.appendChild(holder);
    }

    holder.innerHTML = '';
    holder.classList = 'on';
    holder.style.top = scr.top + 'px';
    holder.style.left = scr.left + scr.width - 5 + 'px';
    holder.style.zIndex = 11 + +lvl;

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
//    localStorage.clear();

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
        let sm = JSON.parse(subMenu);
        let smScheme = selectSubmenuScheme(sm);
        showCMSSubMenu(+parent, +level, src);
        buildSubmenu(sm, smScheme);
    }

    return false;
}

function loadSubmenu(resp) {
    try {
        let sm = JSON.parse(resp);
        let smScheme = selectSubmenuScheme(sm);
        let parent = buildSubmenu(sm, smScheme);
        let id = `menuid_${parent}`;
        localStorage.setItem(id, resp);
    } catch (e) {

    } finally {
        rq_sent = false;
    }
}

function buildSubmenu(sm, scheme) {
    let holder;
    let level;
    let parent;
    let typeLink;
    let here;
    let mItem;
    let mItems = [];
    for (let i = 0; i < sm.length; i++) {
        typeLink = (sm[i].behaviour == 'link');
        here = (document.location.pathname == sm[i].url);
        mItem = (typeLink && here) ? document.createElement('p') : document.createElement('a');
        mItem.id = `smi_id_${sm[i].id}`;
        mItem.setAttribute("data-id", sm[i].id);
        mItem.setAttribute("data-agrp", sm[i].access_group_id);
        mItem.setAttribute("data-node", sm[i].node);
        mItem.setAttribute("data-mode", sm[i].mode);
        mItem.setAttribute("data-level", sm[i].level);
        mItem.setAttribute("data-parent", sm[i].parent);
        level = +sm[i].level;
        parent = +sm[i].parent;
        if (typeLink) {
            mItem.href = sm[i].url;
        }

        mItem.innerHTML = `<span>${sm[i].mnemo}</span>`;
        mItem.style.width = (isNaN(scheme.itemWidth)) ? scheme.itemWidth : scheme.itemWidth + 'px';

        mItems[mItems.length] = mItem;
    }

    holder = document.body.querySelector(`#cmm_sub_lvl_${level}`);
    if (holder.classList.contains('sm__await')) {
        holder.classList.remove('sm__await');
        holder.style.width = 'auto';
        holder.style.height = 'auto';
    }

    holder.style.maxWidth = (isNaN(scheme.itemWidth)) ? scheme.holderMaxWidth : scheme.holderMaxWidth + 'px';
    holder.style.flexDirection = scheme.holderDirection;
    holder.style.flexWrap = scheme.holderWrap;

    holder.append(...mItems);

    return parent;
}

function selectSubmenuScheme(sm) {
    let smScheme = {};

    if (sm.length > 12) {
        smScheme.itemWidth = 200;
        smScheme.holderMaxWidth = 4 * smScheme.itemWidth + 30;
        smScheme.holderDirection = 'row';
        smScheme.holderWrap = 'wrap';
    } else if (sm.length > 6) {
        smScheme.itemWidth = 200;
        smScheme.holderMaxWidth = 3 * smScheme.itemWidth + 30;
        smScheme.holderDirection = 'row';
        smScheme.holderWrap = 'wrap';
    } else if (sm.length > 3) {
        smScheme.itemWidth = 200;
        smScheme.holderMaxWidth = 2 * smScheme.itemWidth + 30;
        smScheme.holderDirection = 'row';
        smScheme.holderWrap = 'wrap';
    } else {
        smScheme.itemWidth = 'auto';
        smScheme.holderMaxWidth = 'auto';
        smScheme.holderDirection = 'column';
        smScheme.holderWrap = 'wrap';
    }

    return smScheme;
}
