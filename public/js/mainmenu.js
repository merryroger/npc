'use strict';

const treshold = 890;
let menuDepth = -1;
let isRootMenuFloated = 0;
let toh = 0;

let ptrMove = null;
let ptrOver = null;
let deferredEvt = null;

let menuLayers = {}

function initMenu() {
    checkRootMenuStatus();
    hangListenersOn();
}

function call_root_menu(sender) {
    let mainPanel = document.body.querySelector('nav.mainmenu');
    menuLayers[-1] = {
        panel: mainPanel,
        hidden: false
    }

    mainPanel.style.visibility = 'visible';
    mainPanel.style.zIndex = 10;

    menuDepth = 0;

    return 0;
}

function checkRootMenuStatus() {
    isRootMenuFloated = window.innerWidth < treshold;

    let mainMenu = document.body.querySelector('nav.mainmenu');

    if (isRootMenuFloated) {
        mainMenu.setAttribute('data-level', 0);
        mainMenu.style.visibility = 'hidden';
        mainMenu.style.zIndex = -1;
    } else {
        mainMenu.style.zIndex = 'inherit';
        mainMenu.style.visibility = 'inherit';
        mainMenu.setAttribute('data-level', -1);
    }
}

function rebuildMenu() {
    hideSubpanels(-1);

    if (isRootMenuFloated ^ window.innerWidth < treshold) {
        menuLayers = {};
        //console.log('rebuilding');
    } else {
        //console.log('skip rebuilding');
    }

    checkRootMenuStatus();
}

function pointerMove(e) {
    switch (e.target.tagName.toUpperCase()) {
        case 'NAV':
        case 'A':
            if (e.target.closest('nav.mainmenu') !== null || e.target.closest('div.subpanel') !== null) {
                let parent = +e.target.getAttribute('data-item');
                let level = +e.target.getAttribute('data-level');
                let node = +e.target.getAttribute('data-node');

                let subpanel = pickSubmenuPanel(node, level, parent);
                if (subpanel !== null)
                    showSubpanel(subpanel, level, e.target);
                else if (level < menuDepth) {
                    hideSubpanels(level);
                }
            }
            return;
        case 'SECTION':
        case 'IMG':
        case 'DIV':
            if (e.target.closest('section#banners') !== null && typeof(bannerCarousel) == 'function') {
                bannerCarousel(e.target, e);
            } else if (e.target.closest('nav.mainmenu') !== null || e.target.closest('div.subpanel') !== null)
                return;
        default:
    }

    hideSubpanels(-1);
}

function pointerMoveDelay() {
    pointerMove(deferredEvt);
    toh = 0;
}

function hangListenersOn() {
    ptrOver = document.body.addEventListener("pointerover", pointerMove);
    ptrMove = document.body.addEventListener("pointermove", (e) => {
        deferredEvt = e;
        if (toh == 0) {
            toh = setTimeout(pointerMoveDelay, 100);
        }
    });
}

function pickSubmenuPanel(node, level, parent) {
    let subpanel = document.body.querySelector(`div.subpanel[data-node="${node}"][data-level="${level}"][data-parent="${parent}"]`);

    if (subpanel == null) {
        let subitems = pickSubitems(node, level + 1, parent);

        if (subitems.length == 0)
            return subpanel;

        subpanel = document.createElement('div');
        subpanel.className = "subpanel off";
        subpanel.setAttribute('data-node', node);
        subpanel.setAttribute('data-level', level);
        subpanel.setAttribute('data-parent', parent);

        subpanel.append(...subitems);

        document.body.insertAdjacentElement('beforeEnd', subpanel);
    }

    return subpanel;
}

function pickSubitems(node, level, parent) {
    let SUL = document.body.querySelector('.sublevels__menu');
    return Array.from(SUL.querySelectorAll(`a[data-node="${node}"][data-level="${level}"][data-parent="${parent}"]`));
}

function showSubpanel(subpanel, level, sender) {
    if (menuLayers[level] === undefined || menuLayers[level] === null) {
        menuLayers[level] = {
            panel: subpanel,
            hidden: true
        }
    } else if (menuLayers[level].panel !== subpanel) {
        hideSubpanels(level);
        menuLayers[level] = {
            panel: subpanel,
            hidden: true
        }
    } else {
        return;
    }

    let cr = getCoordsRect(sender);

    subpanel.classList.remove('off');

    subpanel.style.top = cr.top + 'px';
    if (isRootMenuFloated) {
        subpanel.style.left = cr.width - 30 + 'px';
        if (subpanel.offsetLeft + subpanel.offsetWidth >= document.body.clientWidth) {
            subpanel.style.left = document.body.clientWidth - subpanel.offsetWidth - 10 + 'px';
        }
    } else {
        subpanel.style.left = cr.left + 30 + 'px';
    }

    subpanel.style.zIndex = 10 + level + 1;
    subpanel.classList.add('on');
    menuLayers[level].hidden = false;
    menuDepth = level + 1;
}

function hideSubpanels(level) {
    for (let l = menuDepth; l >= level; l--) {
        if (menuLayers[l] === undefined || menuLayers[l] === null)
            continue;

        if (isRootMenuFloated && l == -1) {
            menuLayers[l].panel.style.visibility = 'hidden';
            menuLayers[l].panel.style.zIndex = -1;
            menuLayers[l].hidden = true;
        } else {
            menuLayers[l].panel.classList.remove('on');
            menuLayers[l].panel.classList.add('off');
            menuLayers[l].hidden = true;
            menuLayers[l] = null;
        }
    }

    menuDepth = level - 1;
}

onresize = rebuildMenu;

__tasks[__tasks.length] = initMenu;
