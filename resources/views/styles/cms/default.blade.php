/**** Default stylesheet ****/

/**** General section ****/

:root {
    --blk-clr:  #000;
    --dk-gr-cl: #333;
    --mmnu-clr: #555;
    --mmnu-abg: #666;
    --blue-br: #3399ff;
    --gk-green-cl: #009900;
    --ftr-lnk: #bbccdd;
    --blue-lt: #ccddee;
    --red-cl: #cc0000;
    --lt-gr-cl: #ccc;
    --xlt-gray: #eee;
    --def-bgr: #fff;
}

* {
    margin: 0;
    padding: 0;
    font-weight: 400;
    line-height: 1.5;
}

html, body {
    height: 100%;
    background-color: var(--def-bgr);
    display: flex;
}

body {
    margin: auto;
    flex-direction: column;
}

.on {
    visibility: visible;
}

.off {
    left: 0;
    top: 0;
    z-index: -1;
    visibility: hidden;
}

.h {
    display: none;
}

.red {
    color: var(--red-cl);
}

.dk__green {
    color: var(--gk-green-cl);
}

/**** End of general section ****/

/**** Veil section ****/

div#veil {
    position: absolute;
    background-color: var(--xlt-gray);
    opacity: .92;
}

.veil__await {
    background: var(--xlt-gray) url("/images/accessories/veil_await.gif") center center no-repeat;
}

div#error_veil {
    position: absolute;
    background-color: var(--blk-clr);
    opacity: .85;
}

.error__veil__await {
    background: var(--blk-clr) url("/images/accessories/error_veil_await.gif") center center no-repeat;
}

/**** End of Veil section ****/

/**** Error panel section ****/

div#error_pad {
    position: absolute;
    justify-content: center;
    align-items: center;
    display: flex;
}

div#error_panel {
    max-width: 480px;
    box-shadow: 5px 5px 8px rgba(0,0,0,0.75);
    border-radius: 10px;
}

div.error__panel__header {
    padding: 2px 25pt;
    color: var(--xlt-gray);
    background-color: var(--dk-gr-cl);
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.error__panel__header h2 {
    line-height: 1.7;
    font-size: 11pt;
    font-family: "PT Sans", sans-serif;
}

form#error_form {
    padding: 20px 25pt;
    background-color: var(--xlt-gray);
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    font-family: "PT Sans", sans-serif;
}

section.error__controls {
    flex-direction: row;
    justify-content: center;
    display: flex;
}

.error__controls button {
    padding: 1px 5pt;
    min-width: 60px;
    border: 1px solid var(--mmnu-clr);
    border-radius: 5px;
    font-size: 8pt;
    cursor: pointer;
}

section.error__description {
    margin-bottom: 15px;
}

.error__description p {
    margin-bottom: 10px;
    color: var(--dk-gr-cl);
    font-size: 9pt;
}

/**** End of Error panel section ****/
