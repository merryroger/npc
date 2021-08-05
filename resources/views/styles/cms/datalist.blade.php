/**** Data list ****/

body {
    flex-grow: 1;
}

section.data__list, section.data__list__empty {
    //margin: auto;
    padding: 50px 0;
    //background-color: #847078;
    font-family: "Roboto Condensed", sans-serif;
    flex-direction: column;
    align-items: stretch;
    flex-grow: 1;
    display: flex;
}

section.data__list {
    overflow: hidden;
}

/*
section.data__list__empty {
    margin: auto;
    padding: 50px 0;
    font-family: "Roboto Condensed", sans-serif;
    flex-direction: column;
    align-items: stretch;
    flex-grow: 1;
    display: flex;
}
*/
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
