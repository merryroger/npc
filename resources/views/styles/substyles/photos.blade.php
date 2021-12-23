
/**** Photogallery page block ****/

nav.photo__pad {
    margin: 0 auto;
    flex-wrap: wrap;
    flex-grow: 1;
    display: flex;
}

div.photo__item__pad {
    flex-direction: column;
    flex-wrap: nowrap;
    display: flex;
}

.photo__item__pad p {
    margin: 16px 3px;
    color: var(--prg-clr);
    line-height: 1.4;
    font-size: 9pt;
    font-family: "Roboto Condensed", sans-serif;
}

.photo__item__pad a {
    border: 1px solid var(--blk-clr);
    background-position: center center;
    background-repeat: no-repeat;
    background-size: contain;
    background-color: var(--blk-clr);
}

div.empty {
    background-color: transparent;
}

/**** End of photogallery band block ****/
