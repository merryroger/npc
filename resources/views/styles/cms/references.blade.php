/**** References` css list ****/

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

div.reference__header {
    flex-direction: row;
    justify-content: center;
    display: flex;
}

nav#reference_control_panel {
    position: absolute;
    margin: 0 20pt;
    right: 0;
    z-index: 2;
    flex-direction: row;
    justify-content: space-between;
    display: flex;
}

div.reference__ctrl__btn {
    margin: 0 3px;
    padding: 5px;
    width: 25px;
    height: 25px;
    text-align: center;
    color: var(--mmnu-abg);
    background-color: var(--def-bgr);
    border: 1px solid var(--xlt-gray);
    border-radius: 25px;
    box-shadow: 2px 2px 8px rgba(0,0,0,0.2);
    cursor: pointer;
}

div.reference__ctrl__btn:active {
    box-shadow: none;
}

/**** Data table part ****/

section.table__pad {
    margin: 25px auto 0;
    justify-content: center;
    align-items: flex-start;
    flex-grow: 1;
    display: flex;
}

table#data_table {
    border-collapse: collapse;
    border: 1px solid var(--mid-gray);
    font-family: "Roboto Condensed", sans-serif;
    box-shadow: 2px 2px 8px rgba(0,0,0,0.2);
}

tr.df__header__row {
    border-bottom: 1px solid var(--mid-gray);
    background-color: var(--th-bgr-cl);
}

.df__header__row th {
    padding: 3px 8pt;
    color: var(--dk-gr-cl);
    font-size: 10pt;
    cursor: default;
}

.df__header__row .rb {
    border-right: 1px solid var(--mid-gray);
}

tr:hover > td {
    color: var(--def-bgr);
    background-color: var(--mmnu-clr);
}

tr:nth-child(even) {
    background-color: var(--xlt-gray);
}

td {
    padding: 5px 8pt;
    color: var(--dk-gr-cl);
    font-size: 9pt;
    cursor: pointer;
}

td.ctrl__cell {
    cursor: default;
}

.ctrl__cell span {
    cursor: pointer;
}

.sortable {
    cursor: pointer !important;
}

.la {
    text-align: left;
}

.ca {
    text-align: center;
}

/**** Form part ****/

div#form_pad {
    position: absolute;
    background-color: var(--def-bgr);
    border-radius: 10px;
    box-shadow: 2px 2px 8px rgba(0,0,0,0.3);
}

.wait__form {
    width: 100px;
    height: 100px;
    background: var(--def-bgr) url("/images/accessories/form_await.gif") center center no-repeat;
}

form.edit__form {
    margin: 10px 10pt;
}

.edit__form fieldset {
    padding: 10px 16pt;
    border-width: 0;
    font-family: "Roboto Condensed", sans-serif;
    //font-family: "PT Sans", sans-serif;
    flex-direction: column;
    display: flex;
}

.edit__form label {
    margin-bottom: 5px;
    color: var(--mmnu-clr);
    font-size: 14pt;
}

.required label:first-letter {
    color: var(--red-cl);
}

div.form__field {
    margin: 8px 0;
    width: 99%;
    flex-direction: column;
    align-self: flex-end;
    display: flex;
}

div.form__assembly {
    width: 100%;
    justify-content: space-between;
    flex-direction: row;
    display: flex;
}

div.form__assembly {
    width: auto;
    justify-content: flex-start;
    flex-direction: row;
    display: flex;
}

.form__field label {
    margin: 0 0 2px 3pt;
    color: var(--dk-gr-cl);
    font-size: 10pt;
}

.form__field input[type="text"] {
    padding: 3px 5pt;
    border: 1px solid var(--lt-gr-cl);
    border-radius: 3px;
    color: var(--dk-gr-cl);
    font-family: Tahoma, "PT Sans", sans-serif;
    font-size: 9pt;
    outline: none;
    flex-grow: 1;
    display: flex;
}

.form__field input[type="checkbox"] {
    border: 1px solid var(--lt-gr-cl);
    border-radius: 3px;
    color: var(--dk-gr-cl);
    outline: none;
}

.form__assembly input[type="button"] {
    margin-left: 3px;
    padding: 3px 0;
    width: 25px;
    color: var(--dk-gr-cl);
    border: 1px solid var(--lt-gr-cl);
    border-radius: 3px;
    font-family: Tahoma, "PT Sans", sans-serif;
    font-size: 9pt;
    outline: none;
    cursor: pointer;
    display: flex;
}

section.form__controls {
    margin-top: 20px;
    justify-content: center;
    display: flex;
}

.form__controls button {
    margin: 0 2px;
    padding: 2px 5pt;
    min-width: 80px;
    color: var(--xlt-gray);
    border: 1px solid var(--mmnu-abg);
    border-radius: 3pt;
    background-color: var(--dk-gr-cl);
    box-shadow: 2px 2px 3px rgba(0,0,0,0.3);
    line-height: 1.3;
    font-size: 8pt;
    cursor: pointer;
}

.form__controls button:active {
    box-shadow: none;
}

.button__disabled {
    box-shadow: none !important;
    opacity: .5;
    cursor: default !important;
}
