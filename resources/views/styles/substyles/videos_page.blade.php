/**** Videos page block ****/

div#video_frame_pad {
    position: fixed;
    padding: 5px 5pt;
    border: 1px solid var(--subpn-brd);
    border-radius: 5px;
    background-color: var(--def-bgr);
    box-shadow: 4px 4px 8px rgb(0, 0, 0, .5);
}

iframe#video_frame {
    border-width: 0;
    background-color: var(--blk-clr);
}

nav.video__pad {
    justify-content: flex-start;
    flex-wrap: wrap;
    display: flex;
}

div.video__item__pad {
    margin: 0 10pt 20px;
    width: calc((800px - 50pt) / 3 - 21pt);
    flex-direction: column;
    flex-wrap: nowrap;
    display: flex;
}

.video__item__pad h6 {
    margin-bottom: 8px;
    color: var(--smnu-bgr);
    font-size: 11pt;
    font-weight: 400;
    font-family: "Roboto Condensed", sans-serif;
}

.video__item__pad a {
    width: 100%;
    height: calc(((800px - 50pt) / 3 - 21pt) / 1.78);
    max-height: calc(((800px - 50pt) / 3 - 21pt) / 1.78);
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
    flex-grow: 1;
    display: flex;
}

.video__item__pad p {
    margin: 16px 3px;
    color: var(--prg-clr);
    line-height: 1.4;
    font-size: 9pt;
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

span {
    margin: auto;
    height: 1.5em;
    font: 48px/1.5 sans-serif;
    color: #fff;
    text-shadow: 0 0 0.5em #000;
    opacity: .5;
}

/**** End of Videos page block ****/