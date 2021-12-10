/**** Styles for screen less 890px width ****/

@media screen and (max-width: 889px) {

    body {
        width: 100%;
    }

    section#title, a#title {
        padding-top: 40px;
        height: 130px;
        background: transparent url("/images/logo_lt.png") no-repeat center 25px;
        background-size: 20% auto;
    }

    .hdr__holder h1 {
        font-size: 19pt;
    }

    .hdr__holder h6 {
        font-size: 10pt;
    }

    nav.mainmenu {
        position: absolute;
        top: 140px;
        left: 8%;
        padding: 12px 0;
        flex-direction: column;
        visibility: hidden;
        font-size: 13pt;
        font-family: "Roboto", sans-serif;
        background-color: var(--blk-clr);
        border-radius: 8px;
        box-shadow: 6px 6px 8px rgba(0,0,0,0.75);
        opacity: .9;
    }

    .mainmenu > a, .extra__menu > a, .subpanel > a {
        margin: 5px 0;
        padding: 2px 20pt;
        color: var(--link-clr);
        text-decoration: none;
    }

    .extra__menu > p {
        margin: 5px 0;
        padding: 2px 20pt;
        color: var(--subpn-brd);
        text-decoration: none;
    }

    .mainmenu > a:hover, .extra__menu > a:hover, .subpanel > a:hover {
        background-color: var(--smnu-bgr);
        text-decoration: underline;
    }

    div.subpanel {
        padding: 12px 0;
        background-color: var(--blk-clr);
        border-radius: 8px;
        box-shadow: 6px 6px 8px rgba(0,0,0,0.75);
        opacity: .9;
    }

    div.extra__menu {
        display: flex;
    }

    div#top__controls {
        display: none;
    }

    nav.sq__ctrls {
        margin-bottom: 10px;
        width: 84%;
        justify-content: flex-start;
        align-items: center;
        display: flex;
    }

    div.sq__mmnu {
        margin: 0 2pt;
        width: 31px;
        height: 31px;
        border: 1px solid var(--sqmnu-brd);
        border-radius: 31px;
        background: transparent url("/images/mnu.gif") no-repeat center center;
        cursor: pointer;
    }

    section#mainpad {
        flex-direction: column;
        align-items: center;
    }

    section.main__sheet {
        width: 100%;
        margin-bottom: 0;
    }

    .main__sheet article {
        padding: 15px 9%;
    }

    .main__sheet section.zwei__spalte {
        padding: 15px 8%;
    }

    article.photo__collection {
        width: 90% !important;
    }

    .centered {
        margin: auto;
        width: 55% !important;
        min-width: 320px !important;
    }

    aside.page__aside {
        padding: 5px 9% 80px;
    }

    .aside__left {
        display: none;
    }

    .aside__right {
        display: flex;
    }

    div.list__container {
        flex-direction: row;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    a.news {
        width: 47%;
    }

    a.extra__news {
        display: block;
    }

    div.news__band__control__frame {
        position: relative;
        left: -10px;
    }

    div.news__band__control__frame, div.news__preview__pad {
        min-width: calc(75vw + 8px);
        max-width: 100%;
    }

    a.news__band__cell, div.news__band__cell {
        min-width: calc(75vw / var(--visible-items) - 14pt);
        max-width: calc(75vw / var(--visible-items) - 14pt);
        overflow-x: hidden;
    }

    .news__image img {
        min-width: 50px;
        width: calc(74vw / var(--visible-items) - 25px);
        max-width: 100px;
        height: calc((74vw / var(--visible-items) - 25px) * 0.75) !important;
        max-height: 75px;
    }

    .news__band__cell p {
        font-size: calc(8pt + .12vw) !important;
    }

    article.foot__logo {
        flex-direction: column;
        align-self: flex-start;
        display: flex;
    }

    article.foot__links {
        display: none;
    }

    section#banners {
        width: 82%;
    }

    nav.video__pad {
        min-width: calc(100vw - 20%);
        justify-content: center;
    }

    div.video__item__pad {
        margin: 0 5% 20px;
        width: calc((100vw - 20%) / 3 - 21pt);
        min-width: 225px;
    }

    .video__item__pad a {
        height: calc(((100vw - 20%) / 3 - 21pt) / 1.78);
        min-height: calc(225px / 1.78);
        max-height: calc(225px / 1.78);
    }

    footer {
        padding: 35px 35pt 35px;
        justify-content: space-evenly;
        flex-wrap: wrap;
    }

    .footer__logotype {
        margin-bottom: 20px;
        width: calc(99px * .75);
        height: calc(56px * .75);
        background: transparent url("/images/logo_dk.png") no-repeat center top;
        background-size: contain;
        flex-basis: 100%;
        flex-grow: 1;
    }

    article.footer {
        width: 290px;
        margin: 3px 5pt 10px;
        justify-content: flex-start;
    }

}
