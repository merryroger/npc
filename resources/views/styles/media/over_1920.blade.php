/**** Styles for screen over 1920px width ****/

@media screen and (min-width: 1920px) {

    body {
        width: 1920px;
    }

    section#title, a#title {
        padding-left: 156px;
        margin-bottom: 30px;
        height: 130px;
        background: transparent url("/images/logo_lt.png") no-repeat left center;
        background-size: auto 70px;
    }

    .hdr__holder h1 {
        font-size: 23pt;
    }

    .hdr__holder h6 {
        font-size: 12pt;
    }

    form#search {
        position: absolute;
        top: 10px;
        right: 5%;
    }

    nav.mainmenu {
        padding: 10px 0;
        width: 100%;
        justify-content: center;
        font-size: 15pt;
        font-family: "Roboto Condensed", sans-serif;
    }

    div.extra__menu {
        display: none;
    }

    .mainmenu > a {
        margin: 0 25pt;
        color: var(--mmnu-clr);
        border-bottom: 1px dotted var(--mmnu-clr);
    }

    .mainmenu > p {
        margin: 0 25pt;
        color: var(--ftr-clr);
    }

    .mainmenu > p.menu__node {
        border-bottom: 1px dotted var(--ftr-clr);
    }

    div.subpanel {
        padding: 10px 0;
        background-color: var(--def-bgr);
        border: 1px solid var(--subpn-brd);
        border-radius: 5px;
        box-shadow: 6px 6px 8px rgba(0,0,0,0.75);
        opacity: .9;
    }

    .subpanel > a {
        margin: 1px 0;
        padding: 2px 12pt 3px;
        color: var(--mmnu-clr);
        text-decoration: none;
    }

    .subpanel > a:hover {
        color: var(--mmnu-clr);
        background-color: var(--ftr-clr);
        text-decoration: underline;
    }

    nav.sq__ctrls {
        display: none;
    }

    section.main__sheet {
        margin-bottom: 120px;
        flex-basis: 800px;
    }

    .main__sheet article {
        padding: 35px 25pt;
    }

    .main__sheet section.zwei__spalte {
        padding: 15px 20pt;
    }

    aside.page__aside {
        padding: 35px 10pt 80px 10pt;
        flex-basis: 20%;
    }

    .aside__left {
        display: flex;
    }

    .aside__right {
        display: flex;
    }

    section#news {
        padding: 0 10pt 35px;
    }

    div.list__container {
        flex-direction: column;
    }

    a.extra__news {
        display: none !important;
    }

    div.news__band__control__frame, div.news__preview__pad {
        min-width: calc(800px - 50pt);
        max-width: calc(800px - 50pt);
    }

    a.news__band__cell, div.news__band__cell {
        min-width: calc((800px - 50pt) / var(--visible-items) - 16pt - 1px);
        max-width: calc((800px - 50pt) / var(--visible-items) - 16pt - 1px);
    }

    section#banners {
        width: calc(800px - 50pt);
    }

    nav.video__pad {
        min-width: calc(800px - 50pt);
        justify-content: space-between;
    }

    div.video__item__pad {
        margin: 0 10pt 20px;
        width: calc((800px - 50pt) / 3 - 21pt);
    }

    .video__item__pad a {
        height: calc(((800px - 50pt) / 3 - 21pt) / 1.78);
        max-height: calc(((800px - 50pt) / 3 - 21pt) / 1.78);
    }

    footer {
        padding: 50px 0 35px;
        justify-content: center;
    }

    article.footer {
        margin: 0 1% 10px;
    }

    .footer__logotype {
        margin-right: 16px;
        width: 99px;
        height: 56px;
        background: transparent url("/images/logo_dk.png") no-repeat left top;
        background-size: 96% auto;
    }

    article.foot__links {
        flex-direction: column;
        display: flex;
    }

}

