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
    margin: 5px;
    padding: 5px;
    width: auto;
    border: 1px solid var(--lt-gr-cl);
    border-radius: 5px;
    box-shadow: 2px 2px 3px rgba(0,0,0,.25);
    background-color: var(--def-bgr);
    display: inline-block;
}

div.image__collection__pad {
    width: 200px;
    height: 150px;
    border: 1px solid var(--lt-gr-cl);
    border-radius: 5px;
    background: transparent url("/images/accessories/no_photo.png") center center no-repeat;
}
