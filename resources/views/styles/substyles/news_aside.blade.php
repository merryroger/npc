/**** News aside block ****/

a.news {
    margin-bottom: 25px;
    text-decoration: none;
    display: block;
}

a.news:hover > p {
    text-decoration: underline;
}

.news p {
    margin-bottom: 5px;
    margin-left: 4px;
    color: var(--prg-clr);
    line-height: 1.3;
    font-size: 11pt;
    font-family: "Roboto Condensed", sans-serif;
}

.news__image {
    width:  100%;
    margin-bottom: 3px;
}

.news__image img {
    margin: 0 5px;
    height: 56px;
    border-radius: 3px;
}

.news__image h6 {
    margin-bottom: 8px;
    color: var(--smnu-bgr);
    font-size: 11pt;
    font-weight: 400;
    font-family: "Roboto Condensed", sans-serif;
}

div.list__container {
    margin: 5px 0 20px;
    display: flex;
}

a.all__news {
    margin-left: 4px;
    color: var(--link-clr);
    font-size: 12pt;
    font-weight: 400;
    font-family: "Roboto Condensed", sans-serif;
}

div.empty__line {
    margin: 5px auto 20px;
    color: var(--hdr-clr);
    font-size: 13pt;
    font-weight: 400;
    font-family: "Roboto Condensed", sans-serif;
    justify-content: center;
    display: flex;
}

/**** End of news aside block ****/

/**** News band block ****/

section#news_band {
    justify-content: center;
    flex-grow: 1;
    display: flex;
}

/**** End of news band block ****/
