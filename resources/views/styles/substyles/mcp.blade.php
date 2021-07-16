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

div#ucp_pad {
    position: absolute;
    padding: 10px 0;
    background-color: var(--mmnu-clr);
    box-shadow: 3px 3px 8px rgba(0,0,0,0.5);
    border-radius: 5px;
    font-size: 11pt;
    font-family: "PT Sans", sans-serif;
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

#ucp_pad a {
    padding: 5px 10pt;
    color: var(--ftr-lnk);
}

#ucp_pad a:hover {
    background-color: var(--mmnu-abg);
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
