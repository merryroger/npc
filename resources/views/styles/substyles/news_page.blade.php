
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

div.news__preview_pad {
    max-width: 1024px;
    overflow-x: hidden;
}

nav.news__preview__band {
    position: relative;
    flex-wrap: nowrap;
    display: flex;
}

a.news__band__cell, div.news__band__cell {
    margin: 0 5pt 5px;
    padding: 3px 3pt;
    width: calc(800px / 3 - 16pt);
    min-width: calc(800px / 3 - 24pt);
    max-width: calc(800px / 3 - 16pt);
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

.news__band__cell p {
    margin-bottom: 5px;
    margin-left: 4px;
    color: var(--prg-clr);
    line-height: 1.5;
    font-size: 10pt;
    font-family: "Roboto Condensed", sans-serif;
}

/**** End of news band block ****/
