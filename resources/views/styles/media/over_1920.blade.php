/**** Styles for screen over 1920px width ****/

@media screen and (min-width: 1920px) {

    body {
        width: 1920px;
    }

    section#title {
        padding-left: 196px;
        margin-bottom: 30px;
        height: 130px;
        background: transparent url("/images/logo_lt.png") no-repeat left center;
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

    .mainmenu > * {
        margin: 0 25pt;
        color: var(--mmnu-clr);
        border-bottom: 1px dotted var(--mmnu-clr);
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

    section#banners {
        width: calc(800px - 50pt);
    }

    footer {
        padding: 50px 0 35px;
        justify-content: center;
    }

    article.footer {
        margin: 0 1% 10px;
    }

    article.foot__logo {
        padding-left: 124px;
        background: transparent url("/images/logo_dk.png") no-repeat left top;
    }

    article.foot__links {
        flex-direction: column;
        display: flex;
    }

}

