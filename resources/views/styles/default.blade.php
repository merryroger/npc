/**** Default stylesheet ****/

/**** General section ****/

:root {
    --blk-clr:  #000;
    --smnu-bgr: #333;
    --prg-clr: #444;
    --link-clr: #3399dd;
    --mmnu-clr: #555;
    --hdr-clr: #6e6e6e;
    --shdr-clr: #888;
    --ftr-clr: #bbb;
    --ftr-lnk: #bbccdd;
    --sqmnu-brd: #ccc;
    --subpn-brd: #ddd;
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

/*** End of general section ****/

/**** Header section ****/

header {
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex-grow: 0;
    display: flex;
}

section#top__frame {
    width: 100%;
    justify-content: space-between;
    display: flex;
}

aside.haside {
    flex-grow: 1;
    flex-basis: 30%;
}

.haside__right {
    justify-content: flex-start;
    align-items: flex-end;
    flex-direction: column;
    display: flex;
}

form#search, form#search2 {
    text-align: right;
    flex-direction: row-reverse;
    justify-content: flex-end;
    display: flex;
}

input#search__text, input#search__text2 {
    position: relative;
    transition-property: width;
    transition-duration: 1s;
    outline: none;
}

.sp__hidden {
    width: 0;
    visibility: hidden;
}

.sp__visible {
    left: 13px;
    height: 31px;
    width: 150px;
    padding: 0 15pt 0 8pt;
    border-top: 1px solid var(--sqmnu-brd);
    border-bottom: 1px solid var(--sqmnu-brd);
    border-left: 1px solid var(--sqmnu-brd);
    border-right: 0px solid transparent;
    border-top-left-radius: 31px;
    border-bottom-left-radius: 31px;
    visibility: visible;
}

a.search__rq__button {
    width: 31px;
    height: 31px;
    border: 1px solid var(--sqmnu-brd);
    border-radius: 31px;
    background: var(--def-bgr) url("/images/search.png") no-repeat center center;
    z-index: 2;
    display: block;
    outline: none;
}

section#title {
    flex-grow: 0;
    flex-direction: column;
    justify-content: center;
    display: flex;
}

div.hdr__holder > * {
    text-align: center;
    white-space: nowrap;
}

.hdr__holder h1 {
    color: var(--hdr-clr);
    line-height: 1.1;
    font-family: "Roboto Condensed", "PT Sans", sans-serif;
}

.hdr__holder h6 {
    color: var(--hdr-clr);
    font-family: "Roboto Condensed", "PT Sans", sans-serif;
}

nav.mainmenu {
    margin-bottom: 20px;
    display: flex;
}

.mainmenu > * {
    text-decoration: none;
    cursor: pointer;
}

div.extra__menu {
    margin: 0;
    border-width: 0;
    flex-direction: column;
}

div.sublevels__menu {
    display: none;
}

div.subpanel {
    position: absolute;
    font-size: 12pt;
    font-family: "Roboto Condensed", sans-serif;
    white-space: nowrap;
    flex-direction: column;
    display: flex;
}

/**** End of header section ****/

/**** Main page section ****/

section#mainpad {
    justify-content: center;
    flex-grow: 1;
    display: flex;
}

section.main__sheet {
    flex-direction: column;
    display: flex;
}

section.zwei__spalte {
    flex-wrap: wrap;
    justify-content: space-between;
    flex-direction: row;
    display: flex;
}

.zwei__spalte article {
    width: 47%;
}

article.photo__collection {
    margin-bottom: 27px;
    min-width: 200px;
    padding: 0 5pt 8px !important;
}

.main__sheet h2, #news h2, .zwei__spalte > h2 {
    margin-bottom: 15px;
    color: var(--prg-clr);
    font-size: 19pt;
    font-family: "PT Sans", sans-serif;
}

.main__sheet p {
    margin-bottom: 15px;
    color: var(--prg-clr);
    font-size: 11pt;
    font-family: "Roboto", sans-serif;
}

a.centered {
    width: 100%;
    height: 153px;
    min-width: 160px;
    min-height: 100px;
    background-color: var(--blk-clr);
    text-decoration: none;
    justify-content: center;
    display: flex;
}

div.graphic__contents {
    margin: 1px auto;
    width: 100%;
    heigth: 100%;
    background-size: contain;
}

.photos {
    background: transparent url("/images/building.jpg") no-repeat center center;
}

.videos {
    background: transparent url("/images/building.jpg") no-repeat center center;
}

/**** End of main page section ****/

/**** Footer section ****/

footer {
    background-color: var(--mmnu-clr);
    flex-grow: 0;
    display: flex;
}

article.footer {
    font-size: 10pt;
    font-family: "Roboto", sans-serif;
}

article.foot__logo {
    min-height: 56px;
}

article.foot__contacts, article.foot__links {
    padding-top: 3px;
}

.footer p {
    margin-bottom: 10px;
    color: var(--ftr-clr);
    line-height: 1;
}

.footer ul {
    color: var(--ftr-clr);
}

.footer li {
    line-height: 1.3;
    margin-left: 16pt;
}

.footer a {
    line-height: 1;
    color: var(--ftr-lnk);
}

.foot__links a {
    margin-bottom: 10px;
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

/**** End of footer section ****/