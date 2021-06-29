/**** Styles for screen between 890px and 1200px width ****/

@media screen and (min-width: 890px) and (max-width: 1199px) {

    body {
        width: 100%;
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
        width: calc(800px - 50pt);
        justify-content: space-between;
        font-size: 15pt;
        font-family: "Roboto", sans-serif;
    }

    div.extra__menu {
        display: none;
    }

    .mainmenu > * {
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
        margin: 1px 0pt;
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

    section#mainpad {
        flex-direction: column;
        align-items: center;
    }

    section.main__sheet {
        width: 800px;
        margin-bottom: 0;
}

    .main__sheet article {
        padding: 15px 25pt;
    }

    .main__sheet section.zwei__spalte {
        padding: 15px 20pt;
    }

    aside.page__aside {
        padding: 5px 25pt 35px;
    }

    .aside__left {
        display: none;
    }

    .aside__right {
        width: 800px;
        display: flex;
    }

    section#news {
        padding: 0 25pt 50px;
    }

    div.list__container {
        flex-direction: row;
        justify-content: space-between;
    }

    a.news {
        width: 32%;
    }

    a.extra__news {
        display: none !important;
    }

    footer {
        padding: 50px 0 35px;
        justify-content: center;
    }


    article.footer {
        margin: 0 1% 10px;
    }

    article.foot__logo {
        padding-left: 90px;
        background: transparent url("/images/logo_dk.png") no-repeat left top;
        background-size: 22% auto;
    }

    article.foot__links {
        flex-direction: column;
        display: flex;
    }

}

