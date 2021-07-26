/**** Main Control panel ****/

div#mcp_pad {
    position: absolute;
    left: 0;
    width: 100%;
    z-index: 10;
    transition-property: top;
    transition-duration: .5s;
    flex-direction: column;
    display: flex;
}

#mcp_pad.pushed {
    top: -35px;
}

#mcp_pad.pulled {
    top: 0;
}

div#mcp_pan {
    height: 35px;
    background-color: var(--mmnu-clr);
    box-shadow: 0px 3px 8px rgba(0,0,0,0.5);
    line-height: 1;
    font-size: 11pt;
    font-family: "PT Sans", sans-serif;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    display: flex;
}

nav.cms__mmnu {
    margin: 0 10pt;
    flex-grow: 1;
    display: flex;
}

div.mcp__ctrls {
    justify-content: center;
    flex-basis: 200px;
    flex-grow: 0;
    display: flex;
}

div#ucp_pad, div#cmm_main, div#cmm_sub_lvl_1 {
    position: absolute;
    padding: 10px 0;
    background-color: var(--mmnu-clr);
    box-shadow: 3px 3px 8px rgba(0,0,0,0.5);
    border-radius: 5px;
    font-size: 11pt;
    font-family: "PT Sans", sans-serif;
    flex-direction: column;
    display: flex;
}

div#cmm_sub_lvl_1.sm__await {
    padding: 10px;
    width: 41px;
    height: 41px;
    background: var(--mmnu-clr) url("/images/accessories/menu_await.gif") center center no-repeat;
}

#mcp_pan p {
    margin: 0 5pt;
    color: var(--def-bgr);
    cursor: default;
}

.mcp__ctrls p {
    border-bottom: 1px dotted var(--blue-lt);
    cursor: pointer !important;
}

#cmm_main a {
    margin-bottom: 1px;
    padding: 5px 15pt;
    color: var(--mmnu-clr);
    text-decoration: none;
    background-color: var(--def-bgr);
}

#cmm_main a:hover {
    background-color: var(--xlt-gray);
}

#cmm_sub_lvl_1 p {
    padding: 5px 10pt;
    color: var(--xlt-gray);
    background-color: var(--mmnu-abg);
    cursor: default;
}

#ucp_pad a, #cmm_sub_lvl_1 a {
    padding: 5px 10pt;
    color: var(--ftr-lnk);
}

#ucp_pad a, #cmm_sub_lvl_1 a {
    text-decoration: none;
}

#cmm_sub_lvl_1 a:hover > span, #ucp_pad a:hover > span {
    border-bottom: 1px solid var(--blue-br);
}

#cmm_sub_lvl_1 a:hover, #ucp_pad a:hover {
    color: var(--def-bgr);
    background-color: var(--blk-clr);
}

#mcp_pan a {
    margin: 0 5pt;
    color: var(--ftr-lnk);
}

#mcp_tng {
    flex-direction: row;
    display: flex;
}

#mcp_tng div {
    margin: 0 5pt;
    padding: 0 16pt;
    background-color: var(--mmnu-clr);
    box-shadow: 3px 3px 4px rgba(0,0,0,0.3);
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    cursor: pointer;
}

.tongue p {
    color: var(--def-bgr);
    transition-duration: .5s;
    font-size: 12pt;
    font-family: sans-serif;
}

.tongue p.pushed {
    transform: rotate(180deg);
}
