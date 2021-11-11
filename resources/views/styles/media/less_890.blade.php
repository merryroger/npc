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

    footer {
        padding: 90px 35pt 35px;
        justify-content: space-evenly;
        flex-wrap: wrap;
        background: transparent url("/images/logo_dk.png") no-repeat center 30px;
        background-size: auto 40px;
    }

    article.footer {
        width: 290px;
        margin: 3px 5pt 10px;
        justify-content: flex-start;
    }

}
