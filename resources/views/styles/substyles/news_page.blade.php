
/**** News page block ****/

section.main__sheet {
    margin-bottom: 0;
}

.main__sheet article {
    padding-bottom: 0;
}

div.photo__frame {
    margin: 8px 20pt 20px 0;
    display: inline-block;
    border-radius: 5px;
    background-size: contain !important;
    background: transparent var(--img-src) center top no-repeat;
}

.pf__standard {
    --frame-width: calc(80vw);
    float: left;
    max-width: var(--w-max);
    max-height: var(--h-max);
    width: var(--frame-width);
    height: calc(var(--frame-width) * 2 / 3);
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
    justify-content: center;
    flex-grow: 1;
    display: flex;
}

/**** End of news band block ****/
