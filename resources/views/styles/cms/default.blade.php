/**** Default stylesheet ****/

/**** General section ****/

:root {
    --blk-clr:  #000;
    --mmnu-clr: #555;
    --mmnu-abg: #666;
    --ftr-lnk: #bbccdd;
    --blue-lt: #ccddee;
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

/*** End of general section ****/
