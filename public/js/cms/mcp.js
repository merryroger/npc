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
