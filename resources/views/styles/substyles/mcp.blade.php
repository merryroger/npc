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
    align-items: center;
    display: flex;
}

#mcp_pan span {
    margin: 0 5pt;
}

#mcp_pan a {
    color: var(--ftr-lnk);
}

#mcp_tng {
    flex-direction: row;
    display: flex;
}

#mcp_tng div {
    margin: 0 5pt;
    padding: 1px 16pt;
    background-color: var(--mmnu-clr);
    box-shadow: 3px 3px 4px rgba(0,0,0,0.3);
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    cursor: pointer;
}

.tongue p {
    transition-duration: .5s;
}

.tongue p.pulled {
    transform: rotate(180deg);
}
