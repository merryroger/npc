/**** Data list ****/

body {
    flex-grow: 1;
}

section.data__list, section.data__list__empty {
    //margin: auto;
    padding: 50px 0 10px;
    //background-color: #847078;
    font-family: "Roboto Condensed", sans-serif;
    flex-direction: column;
    align-items: stretch;
    flex-grow: 1;
    display: flex;
}

section.data__list {
    overflow: hidden;
    max-height: calc(100% - 60px);
}

.data__list__empty h1, .data__list h1 {
    color: var(--mmnu-abg);
    font-size: 21pt;
}

.data__list__empty h3 {
    color: var(--mmnu-abg);
    font-size: 14pt;
    justify-content: center;
    align-items: center;
    flex-grow: 1;
    display: flex;
}

nav.collection__list__controls {
    margin-right: auto;
    padding: 2px 10pt;
    background-color: #980974;
}

section.page__band {
    width: auto;
    overflow: hidden;
    align-content: flex-start;
    flex-direction: column;
    flex-wrap: wrap;
    flex-grow: 1;
    display: flex;
}

div.image__collection__frame {
    margin: 8px;
    padding: 5px;
    width: auto;
    border: 1px solid var(--lt-gr-cl);
    border-radius: 5px;
    box-shadow: 2px 2px 3px rgba(0,0,0,.25);
    background-color: var(--def-bgr);
    display: inline-block;
}

div.image__edit__pad {
    margin: 16px 0 5px;
}

div.image__collection__pad {
    width: 200px;
    height: 150px;
    padding: 5px;
    border-radius: 5px;
    background-color: var(--blk-clr);
    justify-content: center;
    align-items: center;
    display: flex;
}

div.image__preview__pad {
    width: 100px;
    height: 75px;
    padding: 3px;
    border-radius: 5px;
    border: 1px solid var(--mid-gray);
    background-color: var(--blk-clr);
    background-size: cover;
    justify-content: center;
    align-items: center;
    display: flex;
}

.non__loaded {
    background: transparent url("/images/accessories/no_photo.png") center center no-repeat;
}

.image__collection__pad img {
}

div.image__collection__item__titlebar {
    padding: 0 5pt 4px;
    justify-content: space-between;
    display: flex;
}

span.image__item__controls {
    cursor: pointer;
}

div#item_control_panel, div#item_preview_control_panel {
    position: absolute;
    padding: 4px 0 3px;
    background-color: var(--def-bgr);
    border-width: 0;
    border-radius: 3px;
    box-shadow: 2px 2px 5px rgba(0,0,0,.75);
}

div.image__item__control__list {
    font-size: 8pt;
    font-family: "Roboto Condensed", sans-serif;
    flex-direction: column;
    display: flex;
}

.image__item__control__list > a {
    padding: 3px 5pt;
    border-bottom: 1px solid var(--def-bgr);
    color: var(--mmnu-clr);
    text-decoration: none;
}

.image__item__control__list > a:hover {
    color: var(--def-bgr);
    background-color: var(--blk-clr);
}

.image__item__control__list a:hover > span {
    border-bottom: 1px solid var(--blue-br);
}
