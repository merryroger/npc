
/**** News page block ****/

section.main__sheet {
    margin-bottom: 0;
}

.main__sheet article {
    padding-bottom: 0;
}

div.photo__frame {
    margin: 8px 20pt 20px 0;
    border-radius: 5px;
    background-size: contain !important;
    background: transparent var(--img-src) center top no-repeat;
    justify-content: center;
    align-items: flex-end;
    display: flex; //inline-block;
}

.pf__standard {
    --frame-width: calc(80vw);
    float: left;
    max-width: var(--w-max);
    max-height: var(--h-max);
    width: var(--frame-width);
    height: calc(var(--frame-width) * 2 / 3);
}

.pf__long {
    --frame-width: calc(80vw);
    max-width: var(--w-max);
    max-height: var(--h-max);
    width: var(--frame-width);
    height: calc(var(--frame-width) * 7 / 20);
}

.photo__frame h6 {
    position: relative;
    top: var(--top);
    color: var(--hdr-clr);
    font-size: 9pt;
    font-family: "PT Sans", sans-serif;
}

h6 ~ div {
    margin-bottom: 50px !important;
}

.news__article h2 {
    margin-bottom: 36px;
    line-height: 1.2;
}

.news__article h5 {
    margin: 30px 0;
    color: var(--prg-clr);
    font-size: 11pt;
    font-family: "Roboto Condensed", "PT Sans", sans-serif;
}

address {
    margin-top: 30px;
    color: var(--hdr-clr);
    font-size: 11pt;
    font-family: "Roboto Condensed", "PT Sans", sans-serif;
}

/**** End of news page block ****/

/**** News band block ****/

section#news_band {
    margin-bottom: 50px;
    justify-content: center;
    flex-grow: 1;
    display: flex;
}

div.news__band__control__frame {
    justify-content: flex-start;
    align-items: center;
    flex-wrap: nowrap;
    flex-grow: 1;
    display: flex;
}

div.news__preview__pad {
    overflow: hidden;
    flex-grow: 1;
    display: flex;
}

nav.news__preview__band {
    position: relative;
    left: 0;
    width: auto;
    justify-content: flex-start;
    flex-wrap: nowrap;
    display: flex;
    transition: left .25s ease-out;
}

a.news__band__cell, div.news__band__cell {
    margin: 0 5pt 5px;
    padding: 3px 3pt;
    text-decoration: none;
    display: block;
}

div.news__band__cell {
    border-radius: 5px;
    background-color: #f0f0f0;
}

a.news__band__cell:hover > p {
    text-decoration: underline;
}

.await__preview__data {
    border-radius: 5px;
    background: #f0f0f0 url("/images/accessories/news_preview_await.gif") center center no-repeat;
}

.news__band__cell p {
    margin-bottom: 5px;
    margin-left: 4px;
    color: var(--prg-clr);
    line-height: 1.5;
    font-size: 10pt;
    font-family: "Roboto Condensed", sans-serif;
}

div.news__band__ctrls {
    position: relative;
    width: 17px;
    min-width: 17px;
    height: 56px;
    max-height: 56px;
    border-radius: 3px;
    box-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    visibility: hidden;
    z-index: -1;
    cursor: pointer;
    opacity: .75;
}

div.news__band__ctrls:active {
    box-shadow: none;
}

.scroll__left {
    left: calc(15px - 15pt);
    background: transparent url("/images/accessories/scroll_left.png") center center no-repeat;
}

.scroll__right {
    left: calc(-15px + 12pt);
    background: transparent url("/images/accessories/scroll_right.png") center center no-repeat;
}

/**** End of news band block ****/
